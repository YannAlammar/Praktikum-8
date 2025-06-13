<?php
// users/auth_check.php
if (session_status() == PHP_SESSION_NONE) { // Mulai session jika belum aktif
session_start();
}
if (!isset($_SESSION['user_id'])) {
$_SESSION['error_message'] = "Anda harus login untuk mengakses halaman
ini.";
header("Location: ../auth/login.php"); 
exit();
}
?>