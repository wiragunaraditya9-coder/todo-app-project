<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
require_once 'config/database.php';
$error = "";
$success = "";

if (isset($_GET['logout']) && $_GET['logout'] == 1) $success = "Anda telah logout!";
if (isset($_GET['registered']) && $_GET['registered'] == 1) $success = "Registrasi berhasil!";
if (isset($_GET['expired']) && $_GET['expired'] == 1) $error = "Session expired!";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    if (empty($username) || empty($password)) {
        $error = "Username dan password harus diisi!";
    } else {
        $database = new Database();
        $db = $database->getConnection();
        $query = "SELECT id, username, password FROM users WHERE username = ? OR email = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$username, $username]);
         
        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['login_time'] = time();
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Password salah!";
            }
        } else {
            $error = "Username/email tidak ditemukan!";
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
                    <h4 class="mb-0">Login</h4>
                </div>

                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <?php if ($success): ?>
                        <div class="alert alert-success"><?php echo $success; ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-4">
                            <label class="form-label">Username atau Email</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            Login
                        </button>

                        <a href="register.php" class="btn btn-link w-100 text-center">
                            Belum punya akun? Daftar
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>