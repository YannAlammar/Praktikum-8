<?php
require_once 'auth_check.php';
// requireAdmin(); // Aktifkan jika hanya admin yang boleh menghapus
require_once '../config/database.php';
$user_id_to_delete = $_GET['id'] ?? null;
if (!$user_id_to_delete || !filter_var($user_id_to_delete,
FILTER_VALIDATE_INT)) {
$_SESSION['message'] = "ID User tidak valid untuk dihapus.";
$_SESSION['message_type'] = "error";
header("Location: index.php");
exit();
}
// Sangat penting: Jangan biarkan user menghapus dirinya sendiri!
if (isset($_SESSION['user_id']) && $_SESSION['user_id'] ==
$user_id_to_delete) {
$_SESSION['message'] = "Anda tidak dapat menghapus akun Anda sendiri.";
$_SESSION['message_type'] = "warning"; // atau "error"
header("Location: index.php");
exit();
}
try {$stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
$stmt->bindParam(':id', $user_id_to_delete, PDO::PARAM_INT);
if ($stmt->execute()) {
if ($stmt->rowCount() > 0) {
$_SESSION['message'] = "User berhasil dihapus!";
$_SESSION['message_type'] = "success";
} else {
$_SESSION['message'] = "User tidak ditemukan atau sudah
dihapus.";
$_SESSION['message_type'] = "warning";
}
} else {
$_SESSION['message'] = "Gagal menghapus user.";
$_SESSION['message_type'] = "error";
}
} catch (PDOException $e) {
$_SESSION['message'] = "Error database: " . $e->getMessage();
$_SESSION['message_type'] = "error";
}
header("Location: index.php");
exit();
?>