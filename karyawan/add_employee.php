<?php
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $tgl_masuk = $_POST['tgl_masuk'];
    $nama_bank = $_POST['nama_bank'];
    $no_rek = $_POST['no_rek'];
    $no_bpjs = $_POST['no_bpjs'];
    $gender = $_POST['gender'];
    $uk_baju = $_POST['uk_baju'];
    $uk_celana = $_POST['uk_celana'];
    $uk_sepatu = $_POST['uk_sepatu'];

    $ktp_photo = $_FILES['ktp_photo']['name'];
    $kk_photo = $_FILES['kk_photo']['name'];
    $ijazah_photo = $_FILES['ijazah_photo']['name'];

    // Buat folder khusus berdasarkan nama karyawan
    $target_dir = "../uploads/employees/" . str_replace(' ', '_', $name) . "/"; // Ganti spasi dengan underscore
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true); // Buat folder dengan izin 0777
    }

    // Lokasi penyimpanan file
    $ktp_target = $target_dir . basename($ktp_photo);
    $kk_target = $target_dir . basename($kk_photo);
    $ijazah_target = $target_dir . basename($ijazah_photo);

    // Pindahkan file ke folder yang sudah dibuat
    move_uploaded_file($_FILES['ktp_photo']['tmp_name'], $ktp_target);
    move_uploaded_file($_FILES['kk_photo']['tmp_name'], $kk_target);
    move_uploaded_file($_FILES['ijazah_photo']['tmp_name'], $ijazah_target);

    // Simpan data ke database
    $sql = "INSERT INTO employees (name, email, no_hp, alamat, tgl_masuk, nama_bank, no_rek, no_bpjs, gender, uk_baju, uk_celana, uk_sepatu, ktp_photo, kk_photo, ijazah_photo)
            VALUES (:name, :email, :no_hp, :alamat, :tgl_masuk, :nama_bank, :no_rek, :no_bpjs, :gender, :uk_baju, :uk_celana, :uk_sepatu, :ktp_photo, :kk_photo, :ijazah_photo)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':no_hp' => $no_hp,
        ':alamat' => $alamat,
        ':tgl_masuk' => $tgl_masuk,
        ':nama_bank' => $nama_bank,
        ':no_rek' => $no_rek,
        ':no_bpjs' => $no_bpjs,
        ':gender' => $gender,
        ':uk_baju' => $uk_baju,
        ':uk_celana' => $uk_celana,
        ':uk_sepatu' => $uk_sepatu,
        ':ktp_photo' => basename($ktp_photo), // Simpan nama file saja ke database
        ':kk_photo' => basename($kk_photo),   // Simpan nama file saja ke database
        ':ijazah_photo' => basename($ijazah_photo) // Simpan nama file saja ke database
    ]);

    header('Location: ../karyawan/show_employees.php?success=1');
    exit();
}
