<?php
require '../config.php';

if (isset($_GET['name']) && !empty($_GET['name'])) {
    $project_name = $_GET['name'];

    $sql = "DELETE FROM projects WHERE project_name = :project_name";
    $stmt = $pdo->prepare($sql);
} else {
    echo "Project tidak ditemukan.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Deleted</title>

    <script>
        function confirmDelete() {
        return confirm("Apakah Anda yakin ingin menghapus project ini?");
        }
    </script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
        }

        .message {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            color: #333;
        }

        .back-button {
            background-color: #3C5B6F;
            color: #DFD0B8;
            border: none;
            padding: 1rem 2rem;
            font-size: 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #153448;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <p class="message">Project berhasil dihapus.</p>
        <a href="show_projects.php" class="back-button">← Back</a>
    </div>
</body>
</html>
