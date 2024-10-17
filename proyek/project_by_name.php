<?php
require '../config.php';

// Periksa apakah parameter 'name' ada di URL
if (isset($_GET['name']) && !empty($_GET['name'])) {
    $project_name = $_GET['name'];

    // Mengambil proyek berdasarkan nama yang dipilih
    $sql = "SELECT * FROM projects WHERE project_name = :project_name";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':project_name' => $project_name]);
    $project = $stmt->fetch();

    if ($project) {
        // Jika proyek ditemukan, tampilkan judul dan data proyek
        $title = htmlspecialchars($project['project_name']);
    } else {
        $title = "Project not found";
        $description = "The project you are looking for does not exist.";
    }
} else {
    // Jika parameter 'name' tidak ditemukan di URL
    $title = "No project selected";
    $description = "Please select a project from the list.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects from <?= htmlspecialchars($project_name) ?></title>
    <style>
        body {
            font-family: 'Poppins';
            background-color: white;
            margin: 0;
            padding: 0;
        }

        h1{
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
        .grid button {
            background-color: #3C5B6F;
            color: #DFD0B8;
            padding: 1.5rem;
            font-size: 1.2rem;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
        }
        .grid button:hover {
            background-color: #153448;
            box-shadow: 0 0 0 2px #DFD0B8;
        }
    </style>
</head>
<body>
    <?php include '../components/header.php'?>
    <?php include '../components/back_button.php'?>

    <h1>Projects from <?= htmlspecialchars($project_name) ?></h1>

    <div class="container">
        <div class="grid">
            <button>PO</button>
            <button>SAT</button>
            <button>Daily Report</button>
            <button>Berita Acara</button>
            <button>Daily K3</button>
            <button>Serah Terima Barang</button>
            <button>Invoice</button>
        </div>
    </div>
</body>
</html>