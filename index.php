<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@400;700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include 'components/header.php'; ?>

    <h1>Pandawa</h1>

    <p>Program ini berfungsi untuk menambahkan dan menyimpan data-data karyawan dan proyek PT. Sandika Kurnia Permata.</p>
    <br><br>

    <div class="btn">
        <a href="<?= $base_url ?>/karyawan/form_employee.php" class="btn-form">Tambah Karyawan</a>
        <a href="<?= $base_url ?>/proyek/form_project.php" class="btn-form">Tambah Project</a>
    </div>
</body>
<style>
    body{
        font-family: 'Poppins';
        background-image: url('asset/bg.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100%;
        background-color: #fff;
    }

    h1{
        text-align: center;
        color: #000;
        -webkit-text-stroke: 0.5px #fff;
        margin-top: 100px;
        font-size: 50px;
        font-family: 'MuseoModerno';
    }

    p{
        text-align: center;
        padding: 0px 250px;
        margin: 10px;
        font-size: 18px;
        color: #000 ;
        -webkit-text-stroke: 0.5px #000;
    }

    .btn{
        align-items: center;
        text-align: center;
    }

    .btn-form{
        background-color: #153448;
        color: #DFD0B8;
        padding: 25px 40px;
        border: none;
        margin: 0px 20px;
        border-radius: 15px;
        cursor: pointer;
        box-shadow: 8px 8px 3px rgba(0, 0, 0, 0.5);
        font-size: 17px;
        text-decoration: none;
    }

    .btn-form:hover{
        background-color: #3C5B6F;
        font-weight: bold;
    }
</style>
</html>