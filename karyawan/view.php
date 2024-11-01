<?php
require '../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM employees WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Pandawa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
        
    <style>
        body{
            color: #fff;
            background-color: #fff;
            font-family: 'Poppins';
        }

        h1{
            text-align: center;
            color: #000;
            margin: 10px;
            font-size: 35px;
        }

        .detail{
            display: flex;
        }

        hr{
            height: 2px;
            background-color: #FFFFFF;
        }

        .data{
            background-color: #3C5B6F;
            border-radius: 10px;
            padding: 10px 20px;
            width: 500px;
            margin: 10px auto;
            margin-right: 10px;
            justify-content: space-between;
        }

        .foto{
            background-color: #3C5B6F;
            border-radius: 10px;
            padding: 10px 20px;
            width: 400px;
            margin: 10px auto;
            margin-left: 10px;
            justify-content: space-between;
            text-align: center;
        }

        .foto p img{
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .kembali {
            background-color: #153448;
            color: #fff;
            padding: 10px 20px;
            margin-top: 20px;
            float: left;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }

        .kembali:hover {
            background-color: #D10C0C;
            color: #fff;
        }

        .download-btn {
            font-family: 'Poppins';
            background-color: #153448;
            color: #fff;
            padding: 10px 20px;
            margin-top: 20px;
            float: right;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .download-btn:hover {
            background-color: #2988F8;
            color: #fff;
        }
    </style>

</head>
<body>
    <h1>Detail Pandawa</h1>

    <?php if ($employee): ?>
    <div class="detail">
        <div class="data">
            <p><strong>ID:</strong> <?php echo $employee['id']; ?></p>
            <hr>
            <p><strong>Nama:</strong> <?php echo $employee['name']; ?></p>
            <hr>
            <p><strong>Email:</strong> <?php echo $employee['email']; ?></p>
            <hr>
            <p><strong>No HP:</strong> <?php echo $employee['no_hp']; ?></p>
            <hr>
            <p><strong>Alamat:</strong> <?php echo $employee['alamat']; ?></p>
            <hr>
            <p><strong>Tanggal Masuk:</strong> <?php echo $employee['tgl_masuk']; ?></p>
            <hr>
            <p><strong>Nama Bank:</strong> <?php echo $employee['nama_bank']; ?></p>
            <hr>
            <p><strong>No Rek:</strong> <?php echo $employee['no_rek']; ?></p>
            <hr>
            <p><strong>No BPJS:</strong> <?php echo $employee['no_bpjs']; ?></p>
            <hr>
            <p><strong>Gender:</strong> <?php echo $employee['gender']; ?></p>
            <hr>
            <p><strong>Ukuran Baju:</strong> <?php echo $employee['uk_baju']; ?></p>
            <hr>
            <p><strong>Ukuran Celana:</strong> <?php echo $employee['uk_celana']; ?></p>
            <hr>
            <p><strong>Ukuran Sepatu:</strong> <?php echo $employee['uk_sepatu']; ?></p>

            <a href="../karyawan/show_employees.php" class="kembali">Kembali</a>
            
            <button class="download-btn">Download</button>

            <script src="main.js"></script>

        </div>
        <div class="foto">
            <p><strong>KTP:</strong><br> <img src="../uploads/employees/<?php echo $employee['name'] . '/' . $employee['ktp_photo']; ?>" width="300">
            <hr>
            <p><strong>KK:</strong><br> <img src="../uploads/employees/<?php echo $employee['name'] . '/' . $employee['kk_photo']; ?>" width="300">
            <hr>
            <p><strong>Ijazah:</strong><br> <img src="../uploads/employees/<?php echo $employee['name'] . '/' . $employee['ijazah_photo']; ?>" width="300">
        </div>
    </div>

    <?php else: ?>
        <p>Data tidak ditemukan.</p>
    <?php endif; ?>

</body>
</html>
