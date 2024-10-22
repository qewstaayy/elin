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
        // Jika proyek ditemukan, ambil nama proyek dan path PDF terkait
        $title = htmlspecialchars($project['project_name']);

        // Gabungkan path folder uploads dengan nama proyek dan nama file dari database
        function getFilePath($project_name, $file) {
            return !empty($file) ? '../uploads/projects/' . rawurlencode(str_replace(' ', '_', $project_name)) . '/' . rawurlencode($file) : null;
        }

        $file_po = getFilePath($project_name, $project['file_po']);
        $file_sat = getFilePath($project_name, $project['file_sat']);
        $file_daily_report = getFilePath($project_name, $project['file_daily_report']);
        $file_ba = getFilePath($project_name, $project['file_ba']);
        $file_k3 = getFilePath($project_name, $project['file_k3']);
        $file_serah_terima = getFilePath($project_name, $project['file_serah_terima']);
        $file_invoice = getFilePath($project_name, $project['file_invoice']);
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
                <a href="<?= htmlspecialchars($file_po) ?>" target="_blank">
                    <button <?= $file_po ? '' : 'disabled' ?>>PO</button>
                </a>
                <a href="<?= htmlspecialchars($file_sat) ?>" target="_blank">
                    <button <?= $file_sat ? '' : 'disabled' ?>>SAT</button>
                </a>
                <a href="<?= htmlspecialchars($file_daily_report) ?>" target="_blank">
                    <button <?= $file_daily_report ? '' : 'disabled' ?>>Daily Report</button>
                </a>
                <a href="<?= htmlspecialchars($file_ba) ?>" target="_blank">
                    <button <?= $file_ba ? '' : 'disabled' ?>>Berita Acara</button>
                </a>
                <a href="<?= htmlspecialchars($file_k3) ?>" target="_blank">
                    <button <?= $file_k3 ? '' : 'disabled' ?>>Daily K3</button>
                </a>
                <a href="<?= htmlspecialchars($file_serah_terima) ?>" target="_blank">
                    <button <?= $file_serah_terima ? '' : 'disabled' ?>>Serah Terima Barang</button>
                </a>
                <a href="<?= htmlspecialchars($file_invoice) ?>" target="_blank">
                    <button <?= $file_invoice ? '' : 'disabled' ?>>Invoice</button>
                </a>
            <?php else: ?>
                <p>Project details not available. Please select a valid project.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
