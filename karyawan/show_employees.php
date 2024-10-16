<?php
require '../config.php';

$sql = "SELECT * FROM employees";
$stmt = $pdo->query($sql);
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Karyawan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>

        body{
            margin: 0;
            padding: 0;
            font-family: 'Poppins';
        }

        h1{
            text-align: center;
            padding: 10px;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #000;
            text-align: left;
        }

        table th {
            background-color: #3C5B6F;
            color: #DFD0B8;
        }

        table tr:nth-child(even) {
            background-color: #fff;
        }

        table a {
            text-decoration: none;
            color: #000;
            font-weight: bold;
        }

        table a:hover {
            color: #0029FF;
        }

        .tambah{
            background-color: #3C5B6F;
            text-decoration: none;
            color: #DFD0B8;
            padding: 10px 20px;
            margin-top: 30px;
            margin: 20px;
            float: right;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .tambah:hover{
            background-color: #153448;
        }

        .download-btn {
            font-family: 'Poppins';
            background-color: #3C5B6F;
            color: #DFD0B8;
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
            color: #000;
        }
    </style>

</head>
<body>
    
    <?php if (isset($_GET['success'])): ?>
        <div style="color: green;">Data berhasil disimpan!</div>
    <?php endif; ?>

        <h1>Data Karyawan</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Tanggal Masuk</th>
                <th>Gender</th>
                <th>KTP</th>
                <th>KK</th>
                <th>Ijazah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?php echo $employee['name']; ?></td>
                    <td><?php echo $employee['email']; ?></td>
                    <td><?php echo $employee['no_hp']; ?></td>
                    <td><?php echo $employee['alamat']; ?></td>
                    <td><?php echo $employee['tgl_masuk']; ?></td>
                    <td><?php echo $employee['gender']; ?></td>
                    <td><img src="../uploads/employees<?php echo $employee['ktp_photo']; ?>" width="100"></td>
                    <td><img src="../uploads/employees<?php echo $employee['kk_photo']; ?>" width="100"></td>
                    <td><img src="../uploads/employees<?php echo $employee['ijazah_photo']; ?>" width="100"></td>
                    <td>
                        <a href="view.php?id=<?php echo $employee['id']; ?>">View</a> |
                        <a href="edit.php?id=<?php echo $employee['id']; ?>">Edit</a> |
                        <a href="delete.php?id=<?php echo $employee['id']; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="../karyawan/form_employee.php" class="tambah">Tambah Karyawan Baru</a>

    <button class="download-btn">Download</button>
    <script src="main.js"></script>

    <?php require '../components/back_button.php'; ?>

</body>
</html>
