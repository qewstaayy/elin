<?php
// Mulai session
session_start();

// Hancurkan semua data session
session_unset();
session_destroy();

// Redirect ke halaman login atau halaman utama
header("Location: index.php");
exit;
?>
