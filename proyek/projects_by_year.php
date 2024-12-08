<?php
require '../config.php';

$year = $_GET['year'];

// Mengambil proyek berdasarkan tahun yang dipilih
$sql = "SELECT * FROM projects WHERE YEAR(start_date) = :year ORDER BY start_date DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute([':year' => $year]);
$projects = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects from <?= htmlspecialchars($year) ?></title>
    <style>
        body {
            font-family: 'Poppins';
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

        .back-button a{
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
            margin-bottom: 70px;
        }
        .project-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 50px;
        }
        .project-card {
            width: 350px;
            height: 320px;
            background-color: #153448;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transition: transform 0.2s ease;
            text-decoration: none;
        }
        .project-card h2 {
            height: 50px;
            margin: 20px;
            padding: 10px;
            margin-top: 60%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            background-color: white;
            box-shadow: 0 0 0 2px black;
            color: black;
        }
        .project-card:hover {
            transform: scale(1.05);
        }
        @media screen and (max-width: 768px) {
            .project-card {
                width: 250px;
                height: 250px;
            }
        }
    </style>
</head>
<body>
<?php include '../components/header.php' ?>

    <div class="back-button">
        <a href="../proyek/show_projects.php"><span class="arrow">&larr;</span> Back</a>
    </div>  

    <h1>Projects from <?= htmlspecialchars($year) ?></h1>

    <div class="project-container">
        <?php foreach ($projects as $project): ?> 
            <a href="project_by_name.php?name=<?= urlencode($project['project_name']) ?>" class="project-card">
                <h2><?= htmlspecialchars($project['project_name']) ?></h2>
            </a>
        <?php endforeach; ?>
    </div>

</body>
</html>