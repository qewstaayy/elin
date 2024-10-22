<?php
require '../config.php';


// Periksa apakah parameter 'name' ada di URL
if (isset($_GET['name']) && !empty($_GET['name'])) {
    $project_name = $_GET['name'];

    // Ambil proyek berdasarkan nama dari database
    $sql = "SELECT * FROM projects WHERE project_name = :project_name";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':project_name' => $project_name]);
    $project = $stmt->fetch();

    if ($project) {
        $title = htmlspecialchars($project['project_name']);

        // Fungsi untuk menggabungkan path folder dengan nama file PDF di dalam subfolder
        function getFilePath($project_name, $folder_name, $file_name) {
            $file_path = "../uploads/projects/" . rawurlencode($project_name) . "/" . rawurlencode($folder_name) . "/" . rawurlencode($file_name);
            return file_exists($file_path) ? $file_path : null;
        }

        // Dapatkan file PDF sesuai nama proyek, dari subfolder
        $file_po = getFilePath($project_name, 'po', 'po.pdf');
        $file_sat = getFilePath($project_name, 'sat', 'sat.pdf');
        $file_daily_report = getFilePath($project_name, 'daily_report', 'daily_report.pdf');
        $file_ba = getFilePath($project_name, 'ba', 'ba.pdf');
        $file_k3 = getFilePath($project_name, 'k3', 'k3.pdf');
        $file_serah_terima = getFilePath($project_name, 'serah_terima', 'serah_terima.pdf');
        $file_invoice = getFilePath($project_name, 'invoice', 'invoice.pdf');
    } else {
        $title = "Project not found";
        $description = "The project you are looking for does not exist.";
    }
} else {
    $title = "No project selected";
    $description = "Please select a project from the list.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: 'Poppins';
            background-color: white;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 70px;
        }

        .container {
            margin: 2rem auto;
            height: 350px;
            width: 80%;
            max-width: 900px;
            background-color: #153448;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .grid a {
            text-decoration: none;
        }

        .grid button {
            background-color: #3C5B6F;
            color: #DFD0B8;
            padding: 1.5rem;
            font-size: 1.2rem;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
            width: 100%;
        }

        .grid button:hover {
            background-color: #153448;
            box-shadow: 0 0 0 2px #DFD0B8;
        }

        .grid button:disabled {
            background-color: #888;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <?php include '../components/header.php'; ?>
    <?php include '../components/back_button.php'; ?>

    <h1><?= $title ?></h1>

    <div class="container">
        <div class="grid">
            <?php if (isset($project)): ?>
                <a href="<?= $file_po ?>" target="_blank">
                    <button <?= $file_po ? '' : 'disabled' ?>>PO</button>
                </a>
                <a href="<?= $file_sat ?>" target="_blank">
                    <button <?= $file_sat ? '' : 'disabled' ?>>SAT</button>
                </a>
                <a href="<?= $file_daily_report ?>" target="_blank">
                    <button <?= $file_daily_report ? '' : 'disabled' ?>>Daily Report</button>
                </a>
                <a href="<?= $file_ba ?>" target="_blank">
                    <button <?= $file_ba ? '' : 'disabled' ?>>Berita Acara</button>
                </a>
                <a href="<?= $file_k3 ?>" target="_blank">
                    <button <?= $file_k3 ? '' : 'disabled' ?>>Daily K3</button>
                </a>
                <a href="<?= $file_serah_terima ?>" target="_blank">
                    <button <?= $file_serah_terima ? '' : 'disabled' ?>>Serah Terima Barang</button>
                </a>
                <a href="<?= $file_invoice ?>" target="_blank">
                    <button <?= $file_invoice ? '' : 'disabled' ?>>Invoice</button>
                </a>
            <?php else: ?>
                <p><?= $description ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

