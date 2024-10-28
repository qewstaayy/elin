<?php
require '../config.php';

// Cek apakah form di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $project_id = $_POST['id'];
    $project_name = $_POST['project_name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Pastikan folder proyek ada atau buat folder baru
    $upload_dir = "../uploads/projects/" . rawurlencode($project_name) . "/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Handle file PO, Daily Report, K3, Invoice
    $file_po = !empty($_FILES['file_po']['name']) ? $_FILES['file_po']['name'] : $_POST['existing_file_po'];
    $file_daily_report = !empty($_FILES['file_daily_report']['name']) ? $_FILES['file_daily_report']['name'] : $_POST['existing_file_daily_report'];
    $file_k3 = !empty($_FILES['file_k3']['name']) ? $_FILES['file_k3']['name'] : $_POST['existing_file_k3'];
    $file_invoice = !empty($_FILES['file_invoice']['name']) ? $_FILES['file_invoice']['name'] : $_POST['existing_file_invoice'];

    if (!empty($_FILES['file_po']['name'])) {
        move_uploaded_file($_FILES['file_po']['tmp_name'], $upload_dir . $file_po);
    }
    if (!empty($_FILES['file_daily_report']['name'])) {
        move_uploaded_file($_FILES['file_daily_report']['tmp_name'], $upload_dir . $file_daily_report);
    }
    if (!empty($_FILES['file_k3']['name'])) {
        move_uploaded_file($_FILES['file_k3']['tmp_name'], $upload_dir . $file_k3);
    }
    if (!empty($_FILES['file_invoice']['name'])) {
        move_uploaded_file($_FILES['file_invoice']['tmp_name'], $upload_dir . $file_invoice);
    }

    // Handle SAT, BA, Serah Terima (Loop untuk maksimal 10 file)
    for ($i = 1; $i <= 10; $i++) {
        $sat_file = !empty($_FILES["file_sat_$i"]['name']) ? $_FILES["file_sat_$i"]['name'] : $_POST["existing_file_sat_$i"];
        $ba_file = !empty($_FILES["file_ba_$i"]['name']) ? $_FILES["file_ba_$i"]['name'] : $_POST["existing_file_ba_$i"];
        $serah_terima_file = !empty($_FILES["file_serah_terima_$i"]['name']) ? $_FILES["file_serah_terima_$i"]['name'] : $_POST["existing_file_serah_terima_$i"];

        if (!empty($_FILES["file_sat_$i"]['name'])) {
            move_uploaded_file($_FILES["file_sat_$i"]['tmp_name'], $upload_dir . $sat_file);
        }
        if (!empty($_FILES["file_ba_$i"]['name'])) {
            move_uploaded_file($_FILES["file_ba_$i"]['tmp_name'], $upload_dir . $ba_file);
        }
        if (!empty($_FILES["file_serah_terima_$i"]['name'])) {
            move_uploaded_file($_FILES["file_serah_terima_$i"]['tmp_name'], $upload_dir . $serah_terima_file);
        }

        // Update database untuk file-file SAT, BA, Serah Terima
        $sql = "UPDATE projects SET project_name = ?, start_date = ?, end_date = ?, file_po = ?, file_daily_report = ?, file_k3 = ?, file_invoice = ?, file_sat_$i = ?, file_ba_$i = ?, file_serah_terima_$i = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$project_name, $start_date, $end_date, $file_po, $file_daily_report, $file_k3, $file_invoice, $sat_file, $ba_file, $serah_terima_file, $project_id]);
    }

    header("Location: show_projects.php?success=1");
    exit();
}

// Ambil data proyek untuk ditampilkan di form
if (isset($_GET['id'])) {
    $project_id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->execute([$project_id]);
    $project = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Proyek</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        form {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        form label {
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
            font-weight: 600;
        }
        form input[type="text"],
        form input[type="date"],
        form input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        form button {
            padding: 10px 15px;
            background-color: #3C5B6F;
            color: #DFD0B8;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        form button:hover {
            background-color: #153448;
        }
        .file-section {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $project['id']; ?>">

    <!-- Input untuk nama proyek dan tanggal -->
    <label for="project_name">Nama Proyek:</label>
    <input type="text" name="project_name" value="<?php echo $project['project_name']; ?>" required>

    <label for="start_date">Tanggal Mulai:</label>
    <input type="date" name="start_date" value="<?php echo $project['start_date']; ?>" required>

    <label for="end_date">Tanggal Selesai:</label>
    <input type="date" name="end_date" value="<?php echo $project['end_date']; ?>" required>

    <!-- Input untuk file PO, Daily Report, K3, Invoice -->
    <div class="file-section">
        <label for="file_po">File PO (Existing):</label>
        <?php if (!empty($project['file_po'])): ?>
            <a href="../uploads/projects/<?php echo htmlspecialchars($project['file_po']); ?>" target="_blank">View PO</a>
        <?php else: ?>
            <p>Belum ada file PO</p>
        <?php endif; ?>
        <input type="file" name="file_po">

        <label for="file_daily_report">Daily Report (Existing):</label>
        <?php if (!empty($project['file_daily_report'])): ?>
            <a href="../uploads/projects/<?php echo htmlspecialchars($project['file_daily_report']); ?>" target="_blank">View Daily Report</a>
        <?php else: ?>
            <p>Belum ada file Daily Report</p>
        <?php endif; ?>
        <input type="file" name="file_daily_report">

        <label for="file_k3">File K3 (Existing):</label>
        <?php if (!empty($project['file_k3'])): ?>
            <a href="../uploads/projects/<?php echo htmlspecialchars($project['file_k3']); ?>" target="_blank">View K3</a>
        <?php else: ?>
            <p>Belum ada file K3</p>
        <?php endif; ?>
        <input type="file" name="file_k3">

        <label for="file_invoice">Invoice (Existing):</label>
        <?php if (!empty($project['file_invoice'])): ?>
            <a href="../uploads/projects/<?php echo htmlspecialchars($project['file_invoice']); ?>" target="_blank">View Invoice</a>
        <?php else: ?>
            <p>Belum ada file Invoice</p>
        <?php endif; ?>
        <input type="file" name="file_invoice">
    </div>

    <!-- Input dinamis untuk file SAT, BA, Serah Terima -->
    <?php for ($i = 1; $i <= 10; $i++): ?>
        <div class="file-section">
            <h3>SAT <?php echo $i; ?>, BA <?php echo $i; ?>, Serah Terima <?php echo $i; ?></h3>

            <!-- SAT file -->
            <?php if (!empty($project["file_sat_$i"])): ?>
                <label for="file_sat_<?php echo $i; ?>">SAT <?php echo $i; ?> (Existing):</label>
                <a href="../uploads/projects/<?php echo htmlspecialchars($project["file_sat_$i"]); ?>" target="_blank">View SAT <?php echo $i; ?></a>
            <?php else: ?>
                <p>Belum ada file SAT <?php echo $i; ?></p>
            <?php endif; ?>
            <input type="file" name="file_sat_<?php echo $i; ?>">

            <!-- BA file -->
            <?php if (!empty($project["file_ba_$i"])): ?>
                <label for="file_ba_<?php echo $i; ?>">BA <?php echo $i; ?> (Existing):</label>
                <a href="../uploads/projects/<?php echo htmlspecialchars($project["file_ba_$i"]); ?>" target="_blank">View BA <?php echo $i; ?></a>
            <?php else: ?>
                <p>Belum ada file BA <?php echo $i; ?></p>
            <?php endif; ?>
            <input type="file" name="file_ba_<?php echo $i; ?>">

            <!-- Serah Terima file -->
            <?php if (!empty($project["file_serah_terima_$i"])): ?>
                <label for="file_serah_terima_<?php echo $i; ?>">Serah Terima <?php echo $i; ?> (Existing):</label>
                <a href="../uploads/projects/<?php echo htmlspecialchars($project["file_serah_terima_$i"]); ?>" target="_blank">View Serah Terima <?php echo $i; ?></a>
            <?php else: ?>
                <p>Belum ada file Serah Terima <?php echo $i; ?></p>
            <?php endif; ?>
            <input type="file" name="file_serah_terima_<?php echo $i; ?>">
        </div>
    <?php endfor; ?>

    <!-- Tombol Update -->
    <button type="submit" name="update">Update Project</button>
</form>

</body>
</html>
