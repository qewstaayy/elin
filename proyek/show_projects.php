<?php
require '../config.php';

// Mengambil data tahun proyek yang unik
$sql = "SELECT DISTINCT YEAR(start_date) as year FROM projects ORDER BY year DESC";
$stmt = $pdo->query($sql);
$years = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Proyek</title>
    <style>
        body {
            font-family: 'Poppins';
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 70px;
        }
        .project-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 150px 350px;
        }
        .year-card {
            width: 300px;
            height: 70px;
            background-color: #DFD0B8;
            color: #000;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size: 20px;
            border-radius: 5px;
            box-shadow: 0 0 0 15px #153448;
            transition: transform 0.2s ease;
            text-decoration: none;
        }
        .year-card:hover {
            transform: scale(1.05);
            box-shadow: 0 0 0 17px #3C5B6F;
            font-weight: bold;
        }
    </style>
</head>
<body>
        <?php include '../components/header.php'?>
        <?php include '../components/back_button.php'?>

    <h1>Semua Proyek</h1>
    <div class="project-container">
        <?php foreach ($years as $year): ?>
            <a href="projects_by_year.php?year=<?= $year['year'] ?>" class="year-card">
                Proyek Tahun <?= $year['year'] ?>
            </a>
        <?php endforeach; ?>
    </div>

</body>
</html>
