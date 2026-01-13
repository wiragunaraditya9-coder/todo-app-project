<?php
session_start();
$timeout_duration = 1800;

if (isset($_SESSION['login_time'])) {
    if (time() - $_SESSION['login_time'] > $timeout_duration) {
        session_unset();
        session_destroy();
        header("Location: login.php?expired=1");
        exit();
    } else {
        $_SESSION['login_time'] = time();
    }
}
 
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?auth=required");
    exit();
}
?>