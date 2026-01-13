<?php
require_once 'includes/auth-check.php';
require_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();
$user_id = $_SESSION['user_id'];
$error = "";
$success = "";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: tasks.php");
    exit();
}
$task_id = $_GET['id'];

$query = "SELECT * FROM tasks WHERE id = ? AND user_id = ?";
$stmt = $db->prepare($query);
$stmt->execute([$task_id, $user_id]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$task) {
    header("Location: tasks.php");
    exit();
}
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];
    
    if (empty($title)) {
        $error = "Judul task harus diisi!";
    } else {
        try {
            $updateQuery = "UPDATE tasks SET title = ?, description = ?, due_date = ?, status = ? WHERE id = ?";
            $updateStmt = $db->prepare($updateQuery);
            if ($updateStmt->execute([$title, $description, $due_date, $status, $task_id])) {
                $success = "Task berhasil diperbarui!";
            }
        } catch(PDOException $e) {
            $error = "Error: " . $e->getMessage();
        }
    }
}
?>
<?php include 'includes/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-warning">
                <h4 class="mb-0">Edit Task</h4>
            </div>
            <div class="card-body">
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                    <div class="alert alert-success">
                        <?php echo $success; ?>
                        <br>
                        <a href="tasks.php" class="btn btn-sm btn-success mt-2">Lihat Daftar Tasks</a>
                    </div>
                <?php endif; ?>
                
                <form method="POST">
                    <div class="mb-3">
                        <label>Judul Task *</label>
                        <input type="text" class="form-control" name="title" 
                               value="<?php echo htmlspecialchars($task['title']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea class="form-control" name="description" rows="3"><?php echo htmlspecialchars($task['description']); ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Deadline</label>
                            <input type="date" class="form-control" name="due_date" 
                                   value="<?php echo $task['due_date']; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="pending" <?php echo $task['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                <option value="completed" <?php echo $task['status'] == 'completed' ? 'selected' : ''; ?>>Completed</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning">Update Task</button>
                    <a href="tasks.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
        <div class="row mt-3 mb-3">
            <div class="col-12 text-center">
                <a href="tasks.php" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Tasks
                </a>
            </div>
        </div>
        
<?php include 'includes/footer.php'; ?>