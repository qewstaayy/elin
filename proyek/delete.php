<?php
require '../config.php';

// Periksa apakah ada ID proyek yang akan dihapus
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $project_id = $_GET['id'];

    // Ambil data proyek untuk mengetahui file yang ada
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->execute([$project_id]);
    $project = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($project) {
        // Tentukan direktori proyek berdasarkan nama proyek
        $clean_project_name = preg_replace('/[^a-zA-Z0-9_\-]/', '_', strtolower($project['project_name']));
        $upload_dir = "../uploads/projects/" . $clean_project_name . "/";

        // Fungsi rekursif untuk menghapus folder dan semua isinya
        function deleteDirectory($dir) {
            if (!is_dir($dir)) return;
            $files = scandir($dir);
            foreach ($files as $file) {
                if ($file === '.' || $file === '..') continue;
                $filePath = $dir . '/' . $file;
                is_dir($filePath) ? deleteDirectory($filePath) : unlink($filePath);
            }
            rmdir($dir);
        }

        // Panggil fungsi untuk menghapus folder proyek dan isinya
        deleteDirectory($upload_dir);

        // Hapus data proyek dari database
        $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
        $stmt->execute([$project_id]);

        // Pesan setelah penghapusan berhasil
        echo "<h2>Proyek berhasil dihapus, termasuk semua file terkait.</h2>";
    } else {
        echo "<h2>Proyek tidak ditemukan.</h2>";
    }
} else {
    echo "<h2>ID proyek tidak ditemukan.</h2>";
}
?>

<?php include '../components/back_button.php'; ?>
