<?php
require_once 'includes/auth-check.php';
require_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$query = "SELECT COUNT(*) as total_tasks FROM tasks WHERE user_id = ?";
$stmt = $db->prepare($query);
$stmt->execute([$user_id]);
$task_count = $stmt->fetch(PDO::FETCH_ASSOC)['total_tasks'];

$query_pending = "SELECT COUNT(*) as pending_tasks FROM tasks WHERE user_id = ? AND status = 'pending'";
$stmt_pending = $db->prepare($query_pending);
$stmt_pending->execute([$user_id]);
$pending_count = $stmt_pending->fetch(PDO::FETCH_ASSOC)['pending_tasks'];
?>
<?php include 'includes/header.php'; ?>
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0">Dashboard Todo App</h1>
                <p class="text-muted">Selamat datang, <strong><?php echo htmlspecialchars($username); ?></strong>!</p>
            </div>
            <div>
                <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
            </div>
        </div>
    </div>
</div>
<div class="row mb-4"> 
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5>Total Tasks</h5>
                <h2><?php echo $task_count; ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <h5>Pending</h5>
                <h2><?php echo $pending_count; ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5>Completed</h5>
                <h2><?php echo $task_count - $pending_count; ?></h2>
            </div>
        </div>
    </div>
</div>
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-grid gap-2 d-md-flex">
                    <a href="add-task.php" class="btn btn-primary me-2">Tambah Task</a>
                    <a href="tasks.php" class="btn btn-outline-primary me-2">Lihat Tasks</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php if ($task_count == 0): ?>
                    <div class="text-center py-5">
                        <h5>Belum ada tasks</h5>
                        <a href="add-task.php" class="btn btn-primary">Buat Task Pertama</a>
                    </div>
                <?php else: ?>
                    <p>Anda memiliki <?php echo $task_count; ?> task</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>