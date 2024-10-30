<?php
require '../config.php';

// Retrieve project data for form display
$project = null;
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $project_id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->execute([$project_id]);
    $project = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$project) die("Proyek dengan ID $project_id tidak ditemukan.");
} else {
    die("ID proyek tidak ditemukan.");
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $project_id = $_POST['id'];
    $project_name = $_POST['project_name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Set upload directory
    $upload_dir = "../uploads/projects/" . rawurlencode($project_name) . "/";
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

    // Function to handle file upload and fallback to existing file if no new file is uploaded
    function handleUpload($field, $upload_dir) {
        if (!empty($_FILES[$field]['name'])) {
            $filename = $_FILES[$field]['name'];
            if (move_uploaded_file($_FILES[$field]['tmp_name'], $upload_dir . $filename)) {
                return $filename;
            } else {
                echo "Error uploading $field file.";
            }
        }
        return $_POST["existing_$field"] ?? null;
    }

    // Handle main project files
    $file_po = handleUpload('file_po', $upload_dir);
    $file_daily_report = handleUpload('file_daily_report', $upload_dir);
    $file_k3 = handleUpload('file_k3', $upload_dir);
    $file_invoice = handleUpload('file_invoice', $upload_dir);
    $file_sat = handleUpload('file_sat', $upload_dir);
    $file_ba = handleUpload('file_ba', $upload_dir);
    $file_serah_terima = handleUpload('file_serah_terima', $upload_dir);
    $file_sat_2 = handleUpload('file_sa_2t', $upload_dir);
    $file_ba_2 = handleUpload('file_ba_2', $upload_dir);
    $file_serah_terima_2 = handleUpload('file_serah_terima_2', $upload_dir);

    // Update project details in database for main files
    $sql = "UPDATE projects SET project_name = ?, start_date = ?, end_date = ?, file_po = ?, file_daily_report = ?, file_k3 = ?, file_invoice = ?, file_sat = ?, file_ba = ?, file_serah_terima = ?, file_sat_2 = ?, file_ba_2 = ?, file_serah_terima_2 = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$project_name, $start_date, $end_date, $file_po, $file_daily_report, $file_k3, $file_invoice, $file_sat, $file_ba, $file_serah_terima, $file_sat_2, $file_ba_2, $file_serah_terima_2, $project_id]);

    // Handle SAT, BA, and Serah Terima files up to a maximum of 10
    for ($i = 1; $i <= 10; $i++) {
        $file_sat = handleUpload("file_sat_$i", $upload_dir);
        $file_ba = handleUpload("file_ba_$i", $upload_dir);
        $file_serah_terima = handleUpload("file_serah_terima_$i", $upload_dir);

        // Only update the database if files were uploaded or existed previously
        if ($file_sat || $file_ba || $file_serah_terima) {
            $sql = "UPDATE projects SET file_sat_$i = ?, file_ba_$i = ?, file_serah_terima_$i = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$file_sat, $file_ba, $file_serah_terima, $project_id]);
        }
    }

    header("Location: project_by_name.php?success=1");
    exit();
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
        * {
            box-sizing: border-box;
            font-family: "Poppins";
            color: #f5f5f5;
        }
        body {
            background-color: #f0f0f5;
            justify-content: center;
            align-items: center;
            height: 100%;
            padding: 0;
            margin: 0;
        }
        .container {
            background-color: #31465f;
            padding: 20px 40px;
            margin: 10px auto;
            border-radius: 10px;
            width: 600px;
            justify-content: space-between;
        }
        h1 {
            font-size: 24px;
            text-align: center;
            color: #fff;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="date"], input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            background-color: #f5f5f5;
            color: #333;
        }
        .view-button {
            display: block;
            background-color: #4b8ba5;
            color: white;
            text-align: center;
            padding: 8px;
            border-radius: 5px;
            text-decoration: none;
            margin-bottom: 10px;
        }
        .view-button:hover {
            background-color: #61a2c1;
        }
        .update-button, .tambah-button {
            width: 48%;
            padding: 15px;
            background-color: #1c6d96;
            border: none;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            font-size: 18px;
            margin-top: 15px;
        }
        .update-button:hover, .tambah-button:hover {
            background-color: #14557e;
        }
    </style>

    <script>
        let counter = document.querySelectorAll('.field-group').length + 1;
        const maxCounter = 10;

        function addFields() {
            if (counter > maxCounter) {
                alert("Sudah mencapai batas maksimal.");
                return;
            }
        
            const container = document.createElement('div');
            container.className = 'field-group';
            container.innerHTML = `
                <label for="file_sat_${counter}">SAT ${counter}:</label>
                <input type="file" id="file_sat_${counter}" name="file_sat_${counter}" accept="application/pdf">
        
                <label for="file_ba_${counter}">BA ${counter}:</label>
                <input type="file" id="file_ba_${counter}" name="file_ba_${counter}" accept="application/pdf">
        
                <label for="file_serah_terima_${counter}">Serah Terima ${counter}:</label>
                <input type="file" id="file_serah_terima_${counter}" name="file_serah_terima_${counter}" accept="application/pdf">
            `;
        
            document.getElementById('dynamic-fields').appendChild(container);
            counter++;
        }

    </script>

</head>
<body>
    <div class="container">
        <h1>Edit Proyek: <?php echo htmlspecialchars($project['project_name']); ?></h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $project['id']; ?>">

            <!-- Project Info -->
            <label for="project_name">Nama Proyek:</label>
            <input type="text" name="project_name" value="<?php echo $project['project_name']; ?>" required>

            <!-- Date Fields -->
            <label for="start_date">Tanggal Mulai:</label>
            <input type="date" name="start_date" value="<?php echo $project['start_date']; ?>" required>
            <label for="end_date">Tanggal Selesai:</label>
            <input type="date" name="end_date" value="<?php echo $project['end_date']; ?>" required>

            <label>File PO:</label>
            <?php if ($project['file_po']): ?>
                <?php 
                    $file_po_path = "../uploads/projects/" . rawurlencode($project['project_name']) . '/' . rawurlencode($project['file_po']); 
                    echo "<!-- Debug: File path is $file_po_path -->"; // Ini untuk debugging
                ?>
                <a href="<?php echo $file_po_path; ?>" target="_blank" class="view-button">View PO</a>
            <?php endif; ?>
            <input type="file" name="file_po">

            <!-- Repeat for each file type -->
            <label>Daily Report:</label>
            <?php if ($project['file_daily_report']): ?>
                <?php 
                    $file_daily_report_path = "../uploads/projects/" . rawurlencode($project['project_name']) . '/' . rawurlencode($project['file_daily_report']); 
                    echo "<!-- Debug: File path is $file_daily_report_path -->"; // Ini untuk debugging
                ?>
                <a href="<?php echo $file_daily_report_path; ?>" target="_blank" class="view-button">View Daily Report</a>
            <?php endif; ?>
            <input type="file" name="file_daily_report">

            <label>K3:</label>
            <?php if ($project['file_k3']): ?>
                <a href="../uploads/projects/<?php echo rawurlencode($project['project_name']) . '/' . $project['file_k3']; ?>" target="_blank" class="view-button">View K3</a>
            <?php endif; ?>
            <input type="file" name="file_k3">

            <label>Invoice:</label>
            <?php if ($project['file_invoice']): ?>
                <a href="../uploads/projects/<?php echo rawurlencode($project['project_name']) . '/' . $project['file_invoice']; ?>" target="_blank" class="view-button">View Invoice</a>
            <?php endif; ?>
            <input type="file" name="file_invoice">

            <label>SAT:</label>
            <?php if ($project['file_sat']): ?>
                <a href="../uploads/projects/<?php echo rawurlencode($project['project_name']) . '/' . $project['file_sat']; ?>" target="_blank" class="view-button">View SAT</a>
            <?php endif; ?>
            <input type="file" name="file_sat">

            <label>BA:</label>
            <?php if ($project['file_ba']): ?>
                <a href="../uploads/projects/<?php echo rawurlencode($project['project_name']) . '/' . $project['file_ba']; ?>" target="_blank" class="view-button">View BA</a>
            <?php endif; ?>
            <input type="file" name="file_ba">

            <label>Serah Terima:</label>
            <?php if ($project['file_serah_terima']): ?>
                <a href="../uploads/projects/<?php echo rawurlencode($project['project_name']) . '/' . $project['file_serah_terima']; ?>" target="_blank" class="view-button">View Serah Terima</a>
            <?php endif; ?>
            <input type="file" name="file_serah_terima">


            <!-- Dynamic SAT, BA, and Serah Terima Fields -->
            <div id="dynamic-fields">
            <?php for ($i = 2; $i <= 10; $i++): ?>
                <?php if (!empty($project["file_sat_$i"]) || !empty($project["file_ba_$i"]) || !empty($project["file_serah_terima_$i"])): ?>
                
                    <label for="file_sat_<?php echo $i; ?>">SAT <?php echo $i; ?>:</label>
                    <?php if (!empty($project["file_sat_$i"])): ?>
                        <a href="../uploads/projects/<?php echo rawurlencode($project['project_name']) . '/' . rawurlencode($project["file_sat_$i"]); ?>"
                           target="_blank" class="view-button">View SAT <?php echo $i; ?></a>
                    <?php endif; ?>
                    <input type="file" name="file_sat_<?php echo $i; ?>" accept="application/pdf">
                    
                    <label for="file_ba_<?php echo $i; ?>">BA <?php echo $i; ?>:</label>
                    <?php if (!empty($project["file_ba_$i"])): ?>
                        <a href="../uploads/projects/<?php echo rawurlencode($project['project_name']) . '/' . rawurlencode($project["file_ba_$i"]); ?>"
                           target="_blank" class="view-button">View BA <?php echo $i; ?></a>
                    <?php endif; ?>
                    <input type="file" name="file_ba_<?php echo $i; ?>" accept="application/pdf">
                    
                    <label for="file_serah_terima_<?php echo $i; ?>">Serah Terima <?php echo $i; ?>:</label>
                    <?php if (!empty($project["file_serah_terima_$i"])): ?>
                        <a href="../uploads/projects/<?php echo rawurlencode($project['project_name']) . '/' . rawurlencode($project["file_serah_terima_$i"]); ?>"
                           target="_blank" class="view-button">View Serah Terima <?php echo $i; ?></a>
                    <?php endif; ?>
                    <input type="file" name="file_serah_terima_<?php echo $i; ?>" accept="application/pdf">
                    
                <?php endif; ?>
            <?php endfor; ?>
            </div>


            <!-- Dynamic Fields Container -->

            <div id="dynamic-fields"></div>

            <!-- Add More Fields Button -->
            <button type="button" class="tambah-button" onclick="addFields()">Tambah SAT, BA, Serah Terima</button>
            <button type="submit" name="update" class="update-button">Update Project</button>
        </form>
    </div>
</body>
</html>