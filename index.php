<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<?php include 'includes/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6 text-center">
        <h1 class="display-4 mb-4">Todo App</h1>
        <p class="lead mb-5">Aplikasi manajemen tugas sederhana</p>
        <div class="d-grid gap-3">
            <a href="register.php" class="btn btn-primary btn-lg">Daftar</a>
            <a href="login.php" class="btn btn-success btn-lg">Login</a>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>