<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Document</title>

    <style>
        .body{
            font-family: 'Poppins';
            margin: 0;
            padding: 0;
        }

        .back-button {
            display: inline-flex; 
            align-items: center; 
            background-color: #3C5B6F;
            color: #DFD0B8;
            padding: 10px 16px; 
            margin: 15px;
            border-radius: 5px; 
            text-decoration: none;
            font-size: 16px; 
            font-weight: bold; 
            transition: background-color 0.3s; 
            cursor: pointer;
        }

        .back-button:hover {
            background-color: red; 
            color: #000;
        }
    </style>
</head>
<body>
<?php $base_url = '/elin'; ?>

    <div onclick="customBack()" class="back-button">
        <span class="arrow">&larr;</span> Back
    </div>

    <script>
        function customBack() {
            const hierarchy = JSON.parse(localStorage.getItem('hierarchy')) || [];
            hierarchy.pop(); // Hapus halaman saat ini
            const previousPage = hierarchy.pop(); // Ambil halaman sebelumnya
            
            if (previousPage) {
                // Arahkan ke halaman sebelumnya
                localStorage.setItem('hierarchy', JSON.stringify(hierarchy));
                window.location.href = previousPage;
            } else {
                // Jika tidak ada halaman sebelumnya, fallback
                window.location.href = '/semuaproyek.php';
            }
        }
    </script>


</body>
</html>
