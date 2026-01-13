<?php
require_once 'includes/auth-check.php';
require_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $due_date = $_POST['due_date'];
    $user_id = $_SESSION['user_id'];
    
    if (empty($title)) {
        $error = "Judul task harus diisi!";
    } else {
        try {
            $query = "INSERT INTO tasks (user_id, title, description, due_date) VALUES (?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            if ($stmt->execute([$user_id, $title, $description, $due_date])) {
                $success = "Task berhasil ditambahkan!";
            }
        } catch(PDOException $e) {
            $error = "Error: " . $e->getMessage();
        }
    }
} 
?>
<?php include 'includes/header.php'; ?>

<div class="row mb-3">
    <div class="col-12">
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Tambah Task Baru</h4>
            </div>
            <div class="card-body">
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                    <div class="alert alert-success">
                        <?php echo $success; ?>
                        <br>
                        <a href="tasks.php" class="btn btn-sm btn-success mt-2">Lihat Tasks</a>
                        <a href="add-task.php" class="btn btn-sm btn-primary mt-2">Tambah Lagi</a>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="mb-3">
                        <label>Judul Task *</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi (optional)</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Deadline (optional)</label>
                        <input type="date" class="form-control" name="due_date">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Task</button>
                    <a href="dashboard.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
        <div class="row mt-3">
            <div class="col-12 text-center">
                <a href="dashboard.php" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
        
<?php include 'includes/footer.php'; ?>