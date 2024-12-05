<?php
require 'config.php';

// Password yang ingin di-hash
$password = 'abcde'; 
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Update password di database untuk user tertentu
$stmt = $pdo->prepare("UPDATE users SET password = :password WHERE username = :username");
$stmt->execute(['password' => $hashedPassword, 'username' => 'user']);

// Password berhasil diperbarui
?>
