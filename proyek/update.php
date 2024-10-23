<?php
if (isset($_POST['update_project'])) {
    $project_name = $_GET['name']; // Ambil nama proyek dari URL

    // Loop untuk memproses SAT, BA, dan Serah Terima files
    for ($i = 1; $i <= 10; $i++) {
        // Proses file SAT
        if (isset($_FILES["file_sat_$i"]) && $_FILES["file_sat_$i"]['size'] > 0) {
            $file_name = $_FILES["file_sat_$i"]['name'];
            $file_path = "../uploads/projects/$project_name/" . basename($file_name);
            move_uploaded_file($_FILES["file_sat_$i"]['tmp_name'], $file_path);

            // Update database
            $sql = "UPDATE projects SET file_sat_$i = :file_name WHERE project_name = :project_name";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':file_name' => $file_name, ':project_name' => $project_name]);
        }

        // Proses file BA
        if (isset($_FILES["file_ba_$i"]) && $_FILES["file_ba_$i"]['size'] > 0) {
            $file_name = $_FILES["file_ba_$i"]['name'];
            $file_path = "../uploads/projects/$project_name/" . basename($file_name);
            move_uploaded_file($_FILES["file_ba_$i"]['tmp_name'], $file_path);

            // Update database
            $sql = "UPDATE projects SET file_ba_$i = :file_name WHERE project_name = :project_name";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':file_name' => $file_name, ':project_name' => $project_name]);
        }

        // Proses file Serah Terima
        if (isset($_FILES["file_serah_terima_$i"]) && $_FILES["file_serah_terima_$i"]['size'] > 0) {
            $file_name = $_FILES["file_serah_terima_$i"]['name'];
            $file_path = "../uploads/projects/$project_name/" . basename($file_name);
            move_uploaded_file($_FILES["file_serah_terima_$i"]['tmp_name'], $file_path);

            // Update database
            $sql = "UPDATE projects SET file_serah_terima_$i = :file_name WHERE project_name = :project_name";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':file_name' => $file_name, ':project_name' => $project_name]);
        }
    }

    echo "Project updated successfully!";
}



require '../config.php';

// Ambil nama proyek dari URL
if (isset($_GET['name']) && !empty($_GET['name'])) {
    $project_name = $_GET['name'];

    // Ambil proyek berdasarkan nama dari database
    $sql = "SELECT * FROM projects WHERE project_name = :project_name";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':project_name' => $project_name]);
    $project = $stmt->fetch();

    if ($project) {
        // Tampilkan form update jika proyek ditemukan
        echo "<h1>Update Project: " . htmlspecialchars($project_name) . "</h1>";

        // Fungsi untuk menampilkan file yang sudah ada dan opsi untuk menambah file baru
        function displayFileUpload($type, $currentCount, $maxCount = 10) {
            for ($i = 1; $i <= $maxCount; $i++) {
                $fileKey = "file_" . strtolower($type) . "_$i";
                if (!empty($GLOBALS['project'][$fileKey])) {
                    // Jika file sudah ada, tampilkan link
                    echo "<p><a href='../uploads/projects/{$GLOBALS['project'][$fileKey]}' target='_blank'>$type $i</a></p>";
                } elseif ($i == $currentCount + 1) {
                    // Jika file belum ada, tampilkan opsi untuk upload
                    echo "<label for='$fileKey'>Upload $type $i:</label>";
                    echo "<input type='file' name='$fileKey' id='$fileKey'><br>";
                }
            }
        }

        // Tentukan berapa file SAT, BA, dan Serah Terima yang sudah ada
        $current_sat_count = 0;
        $current_ba_count = 0;
        $current_serah_terima_count = 0;

        for ($i = 1; $i <= 10; $i++) {
            if (!empty($project["file_sat_$i"])) $current_sat_count = $i;
            if (!empty($project["file_ba_$i"])) $current_ba_count = $i;
            if (!empty($project["file_serah_terima_$i"])) $current_serah_terima_count = $i;
        }

        // Tampilkan form update untuk SAT, BA, Serah Terima
        echo "<form action='' method='POST' enctype='multipart/form-data'>";
        echo "<h3>Update SAT Files</h3>";
        displayFileUpload('SAT', $current_sat_count);

        echo "<h3>Update BA Files</h3>";
        displayFileUpload('BA', $current_ba_count);

        echo "<h3>Update Serah Terima Files</h3>";
        displayFileUpload('Serah Terima', $current_serah_terima_count);

        // Tombol submit untuk menyimpan update
        echo "<button type='submit' name='update_project'>Update Project</button>";
        echo "</form>";

    } else {
        echo "Project not found.";
    }
} else {
    echo "No project selected.";
}

