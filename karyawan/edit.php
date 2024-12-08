<?php
require '../config.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $old_name = $_POST['old_name']; // Nama lama
    $name = $_POST['name']; // Nama baru

    // Direktori lama dan baru
    $old_dir = "../uploads/employees/" . str_replace(' ', '_', $old_name);
    $new_dir = "../uploads/employees/" . str_replace(' ', '_', $name);

    // Pindahkan folder jika nama diubah
    if ($old_name !== $name && file_exists($old_dir)) {
        if (!rename($old_dir, $new_dir)) {
            echo "Gagal mengganti nama folder. Pastikan izin direktori sudah sesuai.";
            exit;
        }
    }

    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $tgl_masuk = $_POST['tgl_masuk'];
    $nama_bank = $_POST['nama_bank'];
    $no_rek = $_POST['no_rek'];
    $no_bpjs = $_POST['no_bpjs'];
    $uk_baju = $_POST['uk_baju'];
    $uk_celana = $_POST['uk_celana'];
    $uk_sepatu = $_POST['uk_sepatu'];

    // Handle file uploads
    $ktp_photo = !empty($_FILES['ktp_photo']['name']) ? $_FILES['ktp_photo']['name'] : $_POST['existing_ktp_photo'];
    $kk_photo = !empty($_FILES['kk_photo']['name']) ? $_FILES['kk_photo']['name'] : $_POST['existing_kk_photo'];
    $ijazah_photo = !empty($_FILES['ijazah_photo']['name']) ? $_FILES['ijazah_photo']['name'] : $_POST['existing_ijazah_photo'];

      $upload_dir = $new_dir; // Gunakan folder baru jika nama berubah

    // Upload file baru (sesuai logika Anda sebelumnya)
    if (!empty($_FILES['ktp_photo']['name'])) {
        if (move_uploaded_file($_FILES['ktp_photo']['tmp_name'], $upload_dir . '/' . $_FILES['ktp_photo']['name'])) {
            $ktp_photo = $_FILES['ktp_photo']['name'];
        } else {
            echo "Error uploading KTP photo.";
        }
    }
    if (!empty($_FILES['kk_photo']['name'])) {
        if (move_uploaded_file($_FILES['kk_photo']['tmp_name'], $upload_dir . '/' . $_FILES['kk_photo']['name'])) {
            $kk_photo = $_FILES['kk_photo']['name'];
        } else {
            echo "Error uploading KK photo.";
        }
    }
    if (!empty($_FILES['ijazah_photo']['name'])) {
        if (move_uploaded_file($_FILES['ijazah_photo']['tmp_name'], $upload_dir . '/' . $_FILES['ijazah_photo']['name'])) {
            $ijazah_photo = $_FILES['ijazah_photo']['name'];
        } else {
            echo "Error uploading Ijazah photo.";
        }
    }
    
    $sql = "UPDATE employees SET name = ?, email = ?, no_hp = ?, alamat = ?, tgl_masuk = ?, nama_bank = ?, no_rek = ?, no_bpjs = ?, uk_baju = ?, uk_celana = ?, uk_sepatu = ?, ktp_photo = ?, kk_photo = ?, ijazah_photo = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$name, $email, $no_hp, $alamat, $tgl_masuk, $nama_bank, $no_rek, $no_bpjs, $uk_baju, $uk_celana, $uk_sepatu, $ktp_photo, $kk_photo, $ijazah_photo, $id])) {
        header("Location: show_employees.php?success=1");
    } else {
        echo "Error updating record: " . print_r($stmt->errorInfo(), true);
    }
}

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
    <title>Edit Karyawan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
        background-color: #fff;
        color: #DFD0B8;
        font-family: 'Poppins';
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
            color: #000;
            margin: 10px;
            font-size: 45px;
            font-family: 'MuseoModerno';
        }

        form{
            display: flex;
        }

        .part1 {
            background-color: #3C5B6F;
            border-radius: 10px;
            padding: 30px;
            width: 500px;
            margin: 10px auto;
            justify-content: space-between;
        }

        .contact{
            display: flex;
        }

        .contact label{
            width: 237px;
        }

        .email{
            margin: 0 2px;
        }

        .no_hp{
            margin: 0 15px;
            margin-right: 10px;
            padding: 0 10px;
        }

        .bank{
            display: flex;
        }

        .bank label{
            width: 236px;
        }

        .nama_bank{
            margin: 0 2px;
        }

        .no_rek{
            margin: 0 15px;
            margin-right: 10px;
            padding: 0 10px;
        }

        .gender{
            display: flex;
        }

        .P{
            display: flex;
        }

        .L{
            display: flex;
            margin-left: 25px;
        }

        .pakaian{
            display: flex;
        }

        .pakaian input{
            margin: 0 5px;
            margin-right: 50px;
            height: 5px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
        }

        form input[type="text"],
        form input[type="date"],
        form input[type="email"],
        form textarea {
            width: calc(100% - 10px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-family: 'Arial', sans-serif;
            background-color: #fff;
        }

        form input[type="file"] {
            padding: 0.75rem 1.5rem;
            margin: 0.625rem;
            margin-bottom: 30px;
            border: none;
            width: 85%;
            border-radius: 10px;
            text-align: center;
            color: #ffffff;
            cursor: pointer;
            background: #fff;
            color: #000;
            }

        form input[type="file"]:hover {
            box-shadow: 0 0 20px rgba(87, 89, 93, 0.6), 0 0 40px rgba(87, 89, 93, 0.4);
        } 

        .foto{
            display: block;
            margin: 0 auto;
            background-color: #fff;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, border-color 0.3s;
            }

        .foto:hover {
            background-color: #fff;
            border-color: #bbb;
        }

        .foto:focus {
            outline: none;
            border-color: #999;
        }

        .button {
            background-color: #153448;
            color: #DFD0B8;
            padding: 10px 20px;
            margin-top: 30px;
            float: right;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .button:hover {
            background-color: #000;
            color: #fff;
        }

        .container {
            display: flex;
            justify-content: space-between;
        }

        .left-section, .right-section {
            width: 48%;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        .radio-group {
            display: flex;
            align-items: center;
        }

        .radio-group label {
            margin-right: 20px;
        }

        .ukuran-pakaian {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .ukuran-pakaian label {
            margin-right: 10px;
        }

        .ukuran-pakaian input[type="text"] {
            width: 50px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <div class="back-button">
        <a href="../karyawan/show_employees.php"><span class="arrow">&larr;</span> Back</a>
    </div>

    <h1>Edit Karyawan</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <<input type="hidden" name="id" value="<?php echo $employee['id']; ?>">
        <input type="hidden" name="old_name" value="<?php echo $employee['name']; ?>">

        <div class="part1">
            <label>Nama:</label> <input type="text" name="name" value="<?php echo $employee['name']; ?>"><br>
            <div class="contact">
                <div class="email">
                    <label>Email:</label> <input type="email" name="email" value="<?php echo $employee['email']; ?>"><br>
                </div>

                <div class="no_hp">
                    <label>No HP:</label> <input type="text" name="no_hp" value="<?php echo $employee['no_hp']; ?>"><br>
                </div>
            </div>

            <label>Alamat:</label> <textarea name="alamat"><?php echo $employee['alamat']; ?></textarea><br>

            <label>Tanggal Masuk:</label> <input type="date" name="tgl_masuk" value="<?php echo $employee['tgl_masuk']; ?>"><br>

            <div class="bank">
                <div class="nama_bank">
                    <label>Nama Bank:</label> <input type="text" name="nama_bank" value="<?php echo $employee['nama_bank']; ?>"><br>
                </div>

                <div class="no_rek">
                    <label>No Rek:</label> <input type="text" name="no_rek" value="<?php echo $employee['no_rek']; ?>"><br>
                </div>
            </div>

            <label>No BPJS:</label> <input type="text" name="no_bpjs" value="<?php echo $employee['no_bpjs']; ?>"><br>
        
            <label for="uk_pakaian">Ukuran Pakaian</label><br>
            <div class="pakaian">
                <label for="uk_baju">Ukuran Baju:</label> <input type="text" name="uk_baju" class="uk_pakaian" value="<?php echo $employee['uk_baju']; ?>"><br>

                <label for="uk_celana">Ukuran Celana:</label> <input type="text" name="uk_celana" class="uk_pakaian" value="<?php echo $employee['uk_celana']; ?>"><br>

                <label for="uk_sepatu">Ukuran Sepatu:</label> <input type="text" name="uk_sepatu" class="uk_pakaian" value="<?php echo $employee['uk_sepatu']; ?>"><br>
            </div>

            <div class="part2"></div>
            <label>Foto KTP:</label><br>
            <?php if ($employee['ktp_photo']): ?>
                <img src="../uploads/employees/<?php echo str_replace(' ', '_', $employee['name']) . '/' . $employee['ktp_photo']; ?>" width="300"><br>
                <input type="hidden" name="existing_ktp_photo" value="<?php echo $employee['ktp_photo']; ?>">
            <?php endif; ?>
            <input type="file" name="ktp_photo" accept="image/*"><br>
            
            <label>Foto KK:</label><br>
            <?php if ($employee['kk_photo']): ?>
                <img src="../uploads/employees/<?php echo str_replace(' ', '_', $employee['name']) . '/' . $employee['kk_photo']; ?>" width="300"><br>
                <input type="hidden" name="existing_kk_photo" value="<?php echo $employee['kk_photo']; ?>">
            <?php endif; ?>
            <input type="file" name="kk_photo" accept="image/*"><br>
            
            <label>Foto Ijazah:</label><br>
            <?php if ($employee['ijazah_photo']): ?>
                <img src="../uploads/employees/<?php echo str_replace(' ', '_', $employee['name']) . '/' . $employee['ijazah_photo']; ?>" width="300"><br>
                <input type="hidden" name="existing_ijazah_photo" value="<?php echo $employee['ijazah_photo']; ?>">
            <?php endif; ?>
            <input type="file" name="ijazah_photo" accept="image/*"><br>

           

            <button type="submit" name="update" class="button">Update</button>
            
        </div>
    </form>

</body>
</html>
