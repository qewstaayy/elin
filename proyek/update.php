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
        // Hapus file yang terkait dengan proyek jika ada
        $upload_dir = "../uploads/projects/" . rawurlencode($project['project_name']) . "/";

        $files_to_delete = [
            'file_po', 'file_daily_report', 'file_k3', 'file_invoice',
            'file_sat', 'file_ba', 'file_serah_terima'
        ];

        // Hapus file SAT, BA, dan Serah Terima tambahan (maksimal 10)
        for ($i = 1; $i <= 10; $i++) {
            $files_to_delete[] = "file_sat_$i";
            $files_to_delete[] = "file_ba_$i";
            $files_to_delete[] = "file_serah_terima_$i";
        }

        // Loop untuk menghapus file
        foreach ($files_to_delete as $file_column) {
            if (!empty($project[$file_column]) && file_exists($upload_dir . $project[$file_column])) {
                unlink($upload_dir . $project[$file_column]);
            }
        }

        // Hapus folder proyek jika kosong
        if (is_dir($upload_dir) && count(glob("$upload_dir/*")) === 0) {
            rmdir($upload_dir);
        }

        // Hapus data proyek dari database
        $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
        $stmt->execute([$project_id]);

        // Redirect setelah penghapusan berhasil
        echo "<h2>Project berhasil dihapus.</h2>";
    } else {
        echo "<h2>Project tidak ditemukan.</h2>";
    }
} else {
    echo "<h2>ID proyek tidak ditemukan.</h2>";
}
?>
