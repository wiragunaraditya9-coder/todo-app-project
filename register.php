<?php
session_start();
require_once 'config/database.php';
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    if (empty($username) || empty($email) || empty($password)) {
        $error = "Semua field harus diisi!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $database = new Database();
        $db = $database->getConnection();
        
        try {
            $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $db->prepare($query);
            if ($stmt->execute([$username, $email, $hashed_password])) {
                header("Location: login.php?registered=1");
                exit();
            }
        } catch(PDOException $e) {
            $error = "Username atau email sudah terdaftar!";
        } 
    }
}
?>
<?php include 'includes/header.php'; ?>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row justify-content-center w-100">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow px-4 py-5">
                <div class="card-header bg-primary text-white text-center mb-4">
                    <h4 class="mb-0">Registrasi</h4>
                </div>

                <div class="card-body">
                    <?php if ($error): ?><div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">Daftar</button>
                        <a href="login.php" class="btn btn-link w-100">Sudah punya akun? Login</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>