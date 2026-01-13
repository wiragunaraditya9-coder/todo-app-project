<?php
require_once 'includes/auth-check.php';
require_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();
$user_id = $_SESSION['user_id'];

if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $task_id = $_GET['delete'];
    $checkQuery = "SELECT id FROM tasks WHERE id = ? AND user_id = ?";
    $checkStmt = $db->prepare($checkQuery);
    $checkStmt->execute([$task_id, $user_id]);
    if ($checkStmt->rowCount() == 1) {
        $deleteQuery = "DELETE FROM tasks WHERE id = ?";
        $deleteStmt = $db->prepare($deleteQuery);
        $deleteStmt->execute([$task_id]);
    }
}
 
if (isset($_GET['toggle']) && is_numeric($_GET['toggle'])) {
    $task_id = $_GET['toggle'];
    $checkQuery = "SELECT status FROM tasks WHERE id = ? AND user_id = ?";
    $checkStmt = $db->prepare($checkQuery);
    $checkStmt->execute([$task_id, $user_id]);
    if ($checkStmt->rowCount() == 1) {
        $task = $checkStmt->fetch(PDO::FETCH_ASSOC);
        $new_status = ($task['status'] == 'completed') ? 'pending' : 'completed';
        $updateQuery = "UPDATE tasks SET status = ? WHERE id = ?";
        $updateStmt = $db->prepare($updateQuery);
        $updateStmt->execute([$new_status, $task_id]);
    }
}

$query = "SELECT * FROM tasks WHERE user_id = ? ORDER BY 
          CASE WHEN status = 'pending' THEN 1 ELSE 2 END,
          due_date ASC";
$stmt = $db->prepare($query);
$stmt->execute([$user_id]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include 'includes/header.php'; ?>

<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0">
                    <i class="bi bi-list-task text-primary"></i> Daftar Tasks
                </h1>
                <p class="text-muted">Total: <?php echo count($tasks); ?> task</p>
            </div>
            <div>
                <a href="add-task.php" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Task
                </a>
            </div>
        </div>
    </div>
</div>

<?php if (count($tasks) == 0): ?>
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="bi bi-inbox" style="font-size: 3rem; color: #6c757d;"></i>
            <h4 class="mt-3">Belum ada tasks</h4>
            <p class="text-muted">Mulai dengan membuat task pertama Anda!</p>
            <a href="add-task.php" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Buat Task Pertama
            </a>
        </div>
    </div>
<?php else: ?>
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="50">Status</th>
                        <th>Task</th>
                        <th width="120">Deadline</th>
                        <th width="150">Dibuat</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $task): ?>
                        <tr class="<?php echo $task['status'] == 'completed' ? 'table-success' : ''; ?>">
                            <td class="text-center">
                                <a href="tasks.php?toggle=<?php echo $task['id']; ?>" 
                                   class="btn btn-sm <?php echo $task['status'] == 'completed' ? 'btn-success' : 'btn-outline-secondary'; ?>">
                                    <i class="bi bi-<?php echo $task['status'] == 'completed' ? 'check-circle' : 'circle'; ?>"></i>
                                </a>
                            </td>
                            <td>
                                <strong><?php echo htmlspecialchars($task['title']); ?></strong>
                                <?php if (!empty($task['description'])): ?>
                                    <p class="text-muted small mb-0"><?php echo nl2br(htmlspecialchars(substr($task['description'], 0, 100))); ?>...</p>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($task['due_date']): ?>
                                    <?php 
                                    $due_date = new DateTime($task['due_date']);
                                    $today = new DateTime();
                                    
                                    if ($task['status'] == 'completed') {
                                        echo '<span class="badge bg-success">' . $due_date->format('d/m/Y') . '</span>';
                                    } elseif ($due_date < $today) {
                                        echo '<span class="badge bg-danger">' . $due_date->format('d/m/Y') . ' (Terlambat)</span>';
                                    } elseif ($due_date->diff($today)->days <= 3) {
                                        echo '<span class="badge bg-warning">' . $due_date->format('d/m/Y') . ' (Mendekati)</span>';
                                    } else {
                                        echo '<span class="badge bg-info">' . $due_date->format('d/m/Y') . '</span>';
                                    }
                                    ?>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Tidak ada</span>
                                <?php endif; ?>
                            </td>
                            <td class="small">
                                <?php echo date('d/m/Y', strtotime($task['created_at'])); ?>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="edit-task.php?id=<?php echo $task['id']; ?>" 
                                       class="btn btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="tasks.php?delete=<?php echo $task['id']; ?>" 
                                       class="btn btn-outline-danger" 
                                       onclick="return confirm('Yakin hapus task ini?')" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="row mt-3">
        <div class="col-12 text-center">
            <a href="dashboard.php" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>