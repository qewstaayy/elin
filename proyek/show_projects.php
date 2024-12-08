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
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .back-button {
            display: inline-flex; 
            align-items: center; 
            background-color: #3C5B6F;
            padding: 10px 16px; 
            margin: 15px;
            border-radius: 5px; 
            font-size: 16px; 
            font-weight: bold; 
            transition: background-color 0.3s; 
            cursor: pointer;
        }

        .back-button a {
            color: #DFD0B8;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: red; 
            color: #000;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 40px;
        }

        .project-container {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            margin: 30px;
            margin-bottom: 40px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 50px;
        }

        .year-card {
            background-color: #fff;
            border-radius: 25px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            text-decoration: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 30px solid #153448;
            width: 330px;
            height: 300px;
            justify-content: center;
        }

        .year-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .year-card img {
            width: 210px;
            margin-left: 60px;
        }

        .year-card .year-info {
            display: flex;
            text-align: center;
            padding: 10px 1px;
            font-size: 18px;
            font-weight: bold;
            background-color: #153448;
            color: #DFD0B8;
            margin-top: 20px;
            margin-bottom: 0;
        }

        .year-card .year-info:hover{
            color: #000;
            
        }

        .info{
            padding-left: 36px;
        }

        .year-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
<?php include '../components/header.php' ?>

    <div class="back-button">
        <a href="../admin.php"><span class="arrow">&larr;</span> Back</a>
    </div>

    <h1>ALL PROJECT</h1>
    <div class="project-container">
        <?php foreach ($years as $year): ?>
            <a href="projects_by_year.php?year=<?= $year['year'] ?>" class="year-card">
                <img src="../asset/logo.jpeg" alt="Project Image">
                <div class="year-info">
                    <p class="info">Proyek Tahun <?= $year['year'] ?></p>
                    <p class="info">Next ></p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>

</body>
</html>
