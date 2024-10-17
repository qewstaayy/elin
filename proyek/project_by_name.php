<?php
require '../config.php';

// Ambil parameter project_name dari URL
$project_name = $_GET['project_name'] ?? '';

// Debug: Cek apakah parameter diterima dengan benar
var_dump($project_name);  // Pastikan ini mencetak nama project yang dikirimkan

// Cek apakah parameter ada dan valid di database
$sql = "SELECT * FROM projects WHERE LOWER(project_name) = LOWER(:project_name)";   
$stmt = $pdo->prepare($sql);
$stmt->execute([':project_name' => $project_name]);

// Debug: Cek hasil query
$projects = $stmt->fetch();
var_dump($projects);  // Pastikan ini mencetak hasil query

// Jika project_name tidak valid, redirect ke halaman error
if (!$projects) {
    header('Location: ../proyek/eror.php');
    exit;
}

// Ambil nama project dari hasil query
$display_name = $projects['project_name'];
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects from <?= htmlspecialchars($display_name) ?></title>
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

    <h1>
            Projects from <?= htmlspecialchars($display_name) ?>
    </h1>


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