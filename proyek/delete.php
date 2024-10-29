<?php
require '../config.php';

if (isset($_GET['id'])) {
    $project_id = $_GET['id'];

    // Query untuk menghapus proyek
    $sql = "DELETE FROM projects WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    // Eksekusi query
    if ($stmt->execute([':id' => $project_id])) {
        header("Location: show_projects.php?message=deleted");
        exit();
    } else {
        echo "Gagal menghapus proyek.";
    }
} else {
    echo "ID proyek tidak ditemukan.";
}
?>
