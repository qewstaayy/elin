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

        // Looping untuk SAT, BA, dan Serah Terima dari 2 hingga 10
        $sat_files = [];
        $ba_files = [];
        $serah_terima_files = [];

        for ($i = 2; $i <= 10; $i++) {
            $sat_files[$i] = getFilePath($project_name, $project['file_sat_' . $i]);
            $ba_files[$i] = getFilePath($project_name, $project['file_ba_' . $i]);
            $serah_terima_files[$i] = getFilePath($project_name, $project['file_serah_terima_' . $i]);
        }
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
            height: auto;
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
                    <button <?= $file_po ? '' : 'style="display:none"' ?>>PO</button>
                </a>
                <a href="<?= htmlspecialchars($file_sat) ?>" target="_blank">
                    <button <?= $file_sat ? '' : 'style="display:none"' ?>>SAT</button>
                </a>
                <a href="<?= htmlspecialchars($file_daily_report) ?>" target="_blank">
                    <button <?= $file_daily_report ? '' : 'style="display:none"' ?>>Daily Report</button>
                </a>
                <a href="<?= htmlspecialchars($file_ba) ?>" target="_blank">
                    <button <?= $file_ba ? '' : 'style="display:none"' ?>>Berita Acara</button>
                </a>
                <a href="<?= htmlspecialchars($file_k3) ?>" target="_blank">
                    <button <?= $file_k3 ? '' : 'style="display:none"' ?>>Daily K3</button>
                </a>
                <a href="<?= htmlspecialchars($file_serah_terima) ?>" target="_blank">
                    <button <?= $file_serah_terima ? '' : 'style="display:none"' ?>>Serah Terima Barang</button>
                </a>
                <a href="<?= htmlspecialchars($file_invoice) ?>" target="_blank">
                    <button <?= $file_invoice ? '' : 'style="display:none"' ?>>Invoice</button>
                </a>

                <!-- Tampilkan SAT2 hingga SAT10 -->
                <?php for ($i = 2; $i <= 10; $i++): ?>
                    <?php if ($sat_files[$i]): ?>
                        <a href="<?= htmlspecialchars($sat_files[$i]) ?>" target="_blank">
                            <button>SAT <?= $i ?></button>
                        </a>
                    <?php endif; ?>

                    <?php if ($ba_files[$i]): ?>
                        <a href="<?= htmlspecialchars($ba_files[$i]) ?>" target="_blank">
                            <button>Berita Acara <?= $i ?></button>
                        </a>
                    <?php endif; ?>

                    <?php if ($serah_terima_files[$i]): ?>
                        <a href="<?= htmlspecialchars($serah_terima_files[$i]) ?>" target="_blank">
                            <button>Serah Terima <?= $i ?></button>
                        </a>
                    <?php endif; ?>
                <?php endfor; ?>
            <?php else: ?>
                <p>Project details not available. Please select a valid project.</p>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
