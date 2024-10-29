<?php
require '../config.php';

// Ambil data proyek untuk ditampilkan di form
$project = null; // Inisialisasi variabel $project

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $project_id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->execute([$project_id]);
    $project = $stmt->fetch(PDO::FETCH_ASSOC);

    // Pengecekan jika data proyek tidak ditemukan
    if (!$project) {
        die("Proyek dengan ID $project_id tidak ditemukan.");
    }
} else {
    die("ID proyek tidak ditemukan.");
}

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

    $file_sat = !empty($_FILES['file_sat']['name']) ? $_FILES['file_sat']['name'] : $_POST['existing_file_sat'];
    $file_ba = !empty($_FILES['file_ba']['name']) ? $_FILES['file_ba']['name'] : $_POST['existing_file_ba'];
    $file_serah_terima = !empty($_FILES['file_serah_terima']['name']) ? $_FILES['file_serah_terima']['name'] : $_POST['existing_file_serah_terima'];
    

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

    if (!empty($_FILES['file_sat']['name'])) {
        move_uploaded_file($_FILES['file_sat']['tmp_name'], $upload_dir . $file_sat);
    }
    if (!empty($_FILES['file_ba']['name'])) {
        move_uploaded_file($_FILES['file_ba']['tmp_name'], $upload_dir . $file_ba);
    }
    if (!empty($_FILES['file_serah_terima']['name'])) {
        move_uploaded_file($_FILES['file_serah_terima']['tmp_name'], $upload_dir . $file_serah_terima);
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
        $sql = "UPDATE projects SET project_name = ?, start_date = ?, end_date = ?, file_po = ?, file_daily_report = ?, file_k3 = ?, file_invoice = ?, file_sat = ?, file_ba = ?, file_serah_terima = ?, file_sat_$i = ?, file_ba_$i = ?, file_serah_terima_$i = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$project_name, $start_date, $end_date, $file_po, $file_daily_report, $file_k3, $file_invoice, $file_sat, $file_ba, $file_serah_terima, $sat_file, $ba_file, $serah_terima_file, $project_id]);
    }

    header("Location: show_projects.php?success=1");
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
       
        body {
            background-color: #f4f4f9;
            font-family: 'Poppins', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Header styling */
        h1 {
            text-align: center;
            color: #3C5B6F;
            margin-top: 20px;
            font-size: 32px;
        }

        /* Form styling */
        form {
            background-color: #3C5B6F;
            padding: 20px 30px;
            width: 80%;
            max-width: 700px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }

        label {
            color: #DFD0B8;
            font-weight: 500;
            margin-top: 15px;
            display: inline-block;
        }

        .date{
            display: flex;
        }

        .date label{
            width: 236px;
        }

        .mulai{
            margin: 0 2px;
        }

        .selesai{
            margin: 0 15px;
            margin-right: 10px;
            padding: 0 10px;
        }

        input[type="text"],
        input[type="date"] {
            width: calc(100% - 10px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-family: 'Arial', sans-serif;
            background-color: #fff;
        }

        input[type="file"] {
            background-color: #eee;
            border: 2px dashed #ddd;
            cursor: pointer;
            color: #666;
            text-align: center;
        }

        input[type="file"]:hover {
            background-color: #e2e6e9;
        }

        /* Styling untuk kotak file */
        .file-box {
            display: inline-block;
            background-color: #f0f0f5;
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            text-align: center;
            width: 150px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
        }

        .file-box a {
            text-decoration: none;
            color: #3C5B6F;
            font-weight: 500;
            transition: color 0.3s;
        }

        .file-box:hover {
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
            transform: translateY(-3px);
            background-color: #e6e9f0;
        }

        .file-box:hover a {
            color: #153448;
        }


        /* Dynamic field section */
        #dynamic-fields {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }

       /* Container untuk tombol di bawah form */
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        button[type="button"], button[type="submit"] {
            background-color: #3C5B6F;
            color: #DFD0B8;
            padding: 12px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        button[type="button"]:hover, button[type="submit"]:hover {
            background-color: #153448;
        }

    </style>

    <script>
        let counter = 1;
        const maxCounter = 10;

        function addFields() {
            if (counter >= maxCounter) {
                alert("Sudah mencapai batas maksimal SAT, BA, dan Serah Terima.");
                return;
            }

            counter++;

            const container = document.createElement('div');
            container.classList.add('form-group');
            container.setAttribute('id', `set-${counter}`);
            container.innerHTML = `
                <label for="file_sat_${counter}">SAT ${counter}:</label>
                <input type="file" id="file_sat_${counter}" name="file_sat_${counter}" accept="application/pdf" class="pdf">

                <label for="file_ba_${counter}">BA ${counter}:</label>
                <input type="file" id="file_ba_${counter}" name="file_ba_${counter}" accept="application/pdf" class="pdf2">

                <label for="file_serah_terima_${counter}">Serah Terima Barang ${counter}:</label>
                <input type="file" id="file_serah_terima_${counter}" name="file_serah_terima_${counter}" accept="application/pdf" class="pdf2">
            `;

            document.getElementById('dynamic-fields').appendChild(container);
        }

        function hideEmptyFields() {
            for (let i = 1; i <= maxCounter; i++) {
                if (!document.getElementById(`file_sat_${i}`) && !document.getElementById(`file_ba_${i}`) && !document.getElementById(`file_serah_terima_${i}`)) {
                    const set = document.getElementById(`set-${i}`);
                    if (set) set.classList.add('hidden');
                }
            }
        }

        window.onload = hideEmptyFields;
    </script>
</head>
<body>

<h1>Edit Proyek: <?php echo htmlspecialchars($project['project_name']); ?></h1>

<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $project['id']; ?>">

    <!-- Input untuk nama proyek dan tanggal -->
    <label for="project_name">Nama Proyek:</label>
    <input type="text" name="project_name" value="<?php echo $project['project_name']; ?>" required>
    
    <div class="date">
        <div class="mulai">
            <label for="start_date">Tanggal Mulai:</label>
            <input type="date" name="start_date" value="<?php echo $project['start_date']; ?>" required>
        </div>

        <div class="selesai">
            <label for="end_date">Tanggal Selesai:</label>
            <input type="date" name="end_date" value="<?php echo $project['end_date']; ?>" required>
        </div>
    </div>
    
    <div class="file-section">
        <label for="file_po">File PO (Existing):</label>
        <br>
        <?php if (!empty($project['file_po'])): ?>
            <div class="file-box"><a href="../uploads/projects/<?php echo htmlspecialchars($project['file_po']); ?>" target="_blank">View PO</a></div>
        <?php else: ?>
            <p>Belum ada file PO</p>
        <?php endif; ?>
        <br>
        <input type="file" name="file_po">
        <br>
        
        <label for="file_daily_report">File Daily Report (Existing):</label>
        <br>
        <?php if (!empty($project['file_daily_report'])): ?>
            <div class="file-box"><a href="../uploads/projects/<?php echo htmlspecialchars($project['file_daily_report']); ?>" target="_blank">View Daily Report</a></div>
        <?php else: ?>
            <p>Belum ada file Daily Report</p>
        <?php endif; ?>
        <br>
        <input type="file" name="file_daily_report">
        <br>

        <label for="file_k3">File K3 (Existing):</label>
        <br>
        <?php if (!empty($project['file_k3'])): ?>
            <div class="file-box"><a href="../uploads/projects/<?php echo htmlspecialchars($project['file_k3']); ?>" target="_blank">View K3</a></div>
        <?php else: ?>
            <p>Belum ada file K3</p>
        <?php endif; ?>
        <br>
        <input type="file" name="file_k3">
        <br>

        <label for="file_invoice">File Invoice (Existing):</label>
        <br>
        <?php if (!empty($project['file_invoice'])): ?>
            <div class="file-box"><a href="../uploads/projects/<?php echo htmlspecialchars($project['file_invoice']); ?>" target="_blank">View Invoice</a></div>
        <?php else: ?>
            <p>Belum ada file Invoice</p>
        <?php endif; ?>
        <br>
        <input type="file" name="file_invoice">
        <br>
    

        <label for="file_sat">File SAT (Existing):</label>
        <br>
        <?php if (!empty($project['file_sat'])): ?>
            <div class="file-box"><a href="../uploads/projects/<?php echo htmlspecialchars($project['file_sat']); ?>" target="_blank">View SAT</a></div>
        <?php else: ?>
            <p>Belum ada file SAT</p>
        <?php endif; ?>
        <br>
        <input type="file" name="file_sat">
        <br>

        <label for="file_ba">File BA (Existing):</label>
        <br>
        <?php if (!empty($project['file_ba'])): ?>
            <div class="file-box"><a href="../uploads/projects/<?php echo htmlspecialchars($project['file_ba']); ?>" target="_blank">View BA</a></div>
        <?php else: ?>
            <p>Belum ada file BA</p>
        <?php endif; ?>
        <br>
        <input type="file" name="file_ba">
        <br>

        <label for="file_serah_terima">File Serah Terima (Existing):</label>
        <br>
        <?php if (!empty($project['file_serah_terima'])): ?>
            <div class="file-box"><a href="../uploads/projects/<?php echo htmlspecialchars($project['file_serah_terima']); ?>" target="_blank">View Serah Terima</a></div>
        <?php else: ?>
            <p>Belum ada file Serah Terima</p>
        <?php endif; ?>
        <br>
        <input type="file" name="file_serah_terima">
        <br>
    </div>
        <div id="dynamic-fields"></div> <!-- Kontainer untuk elemen dinamis -->

    <div class="button-container">
        <button type="button" onclick="addFields()">Tambah SAT, BA, dan Serah Terima</button>
        <button type="submit" name="update">Update Project</button>
    </div>
</form>

</body>
</html>
