<?php
require '../config.php';

$project_name = $_GET['project_name'] ?? '';

// Mengambil proyek berdasarkan tahun yang dipilih
$sql = "SELECT * FROM projects WHERE project_name = :project_name ORDER BY project_name DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute([':project_name' => $project_name]);
$projects = $stmt->fetchAll();
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
        }
        .back-button {
            display: inline-flex; 
            align-items: center; 
            background-color: #3C5B6F;
            color: #DFD0B8;
            padding: 5px 10px; 
            margin: 10px;
            border-radius: 10px; 
            text-decoration: none;
            font-size: 16px; 
            font-weight: bold; 
            transition: background-color 0.3s; 
        }
        .back-button:hover {
            background-color: red; 
            color: #000;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 70px;
        }

        .container{
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 600px;
        }
        /* Buttons inside container */
        .menu-button {
            width: 200px;
            height: 80px;
            background-color: #3c5162;
            color: #ddd;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .menu-button:hover {
            background-color: #4a6a83;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <?php include '../components/header.php'?>
    <?php include '../components/back_button.php'?>

    <h1>Projects from <?= htmlspecialchars($project_name) ?></h1>
    <div class="project-container">
        <?php foreach ($projects as $project): ?>
            <div class="project-card">
                <h2><?= htmlspecialchars($project['project_name']) ?></h2>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="container">
        <div class="menu-button">
        <button class="menu-button">PO</button>
        <button class="menu-button">SAT</button>
        <button class="menu-button">Daily Report</button>
        <button class="menu-button">Berita Acara</button>
        <button class="menu-button">Daily K3</button>
        <button class="menu-button">Serah Terima Barang</button>
        <button class="menu-button">Invoice</button>
        </div>
    </div>

</body>
</html>
