<?php

$host = "localhost"; 
$db_name = "db_app_user5710"; 
$username_db = "root"; 
$password_db = ""; 
try {
    $conn = new PDO("mysql:host={$host};dbname={$db_name}", $username_db,$password_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch(PDOException $exception) {
die("Koneksi error: " . $exception->getMessage());
}
?>