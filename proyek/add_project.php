<?php
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $project_name = $_POST['project_name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Bersihkan nama proyek agar bisa menjadi nama folder yang valid
    $clean_project_name = preg_replace('/[^a-zA-Z0-9_\-]/', '_', strtolower($project_name));

    // Buat folder untuk proyek jika belum ada
    $target_dir = "../uploads/projects/$clean_project_name/";

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Buat folder dengan permission 0777
    }

    // Inisialisasi variabel untuk insert data
    $file_po = $file_daily_report = $file_k3 = $file_invoice = $file_sat = $file_ba = $file_serah_terima = $file_sat_2 = $file_ba_2 = $file_serah_terima_2 = null;

    // Upload file jika ada
    if (!empty($_FILES['file_po']['name'])) {
        $file_po = $_FILES['file_po']['name'];
        $po_target = $target_dir . basename($file_po);
        move_uploaded_file($_FILES['file_po']['tmp_name'], $po_target);
    }

    if (!empty($_FILES['file_daily_report']['name'])) {
        $file_daily_report = $_FILES['file_daily_report']['name'];
        $daily_report_target = $target_dir . basename($file_daily_report);
        move_uploaded_file($_FILES['file_daily_report']['tmp_name'], $daily_report_target);
    }

    if (!empty($_FILES['file_k3']['name'])) {
        $file_k3 = $_FILES['file_k3']['name'];
        $k3_target = $target_dir . basename($file_k3);
        move_uploaded_file($_FILES['file_k3']['tmp_name'], $k3_target);
    }

    if (!empty($_FILES['file_invoice']['name'])) {
        $file_invoice = $_FILES['file_invoice']['name'];
        $invoice_target = $target_dir . basename($file_invoice);
        move_uploaded_file($_FILES['file_invoice']['tmp_name'], $invoice_target);
    }

    if (!empty($_FILES['file_sat']['name'])) {
        $file_sat = $_FILES['file_sat']['name'];
        $sat_target = $target_dir . basename($file_sat);
        move_uploaded_file($_FILES['file_sat']['tmp_name'], $sat_target);
    }

    if (!empty($_FILES['file_ba']['name'])) {
        $file_ba = $_FILES['file_ba']['name'];
        $ba_target = $target_dir . basename($file_ba);
        move_uploaded_file($_FILES['file_ba']['tmp_name'], $ba_target);
    }

    if (!empty($_FILES['file_serah_terima']['name'])) {
        $file_serah_terima = $_FILES['file_serah_terima']['name'];
        $serah_terima_target = $target_dir . basename($file_serah_terima);
        move_uploaded_file($_FILES['file_serah_terima']['tmp_name'], $serah_terima_target);
    }

    if (!empty($_FILES['file_sat_2']['name'])) {
        $file_sat_2 = $_FILES['file_sat_2']['name'];
        $sat_2_target = $target_dir . basename($file_sat_2);
        move_uploaded_file($_FILES['file_sat_2']['tmp_name'], $sat_2_target);
    }

    if (!empty($_FILES['file_ba_2']['name'])) {
        $file_ba_2 = $_FILES['file_ba_2']['name'];
        $ba_2_target = $target_dir . basename($file_ba_2);
        move_uploaded_file($_FILES['file_ba_2']['tmp_name'], $ba_2_target);
    }

    if (!empty($_FILES['file_serah_terima_2']['name'])) {
        $file_serah_terima_2 = $_FILES['file_serah_terima_2']['name'];
        $serah_terima_2_target = $target_dir . basename($file_serah_terima_2);
        move_uploaded_file($_FILES['file_serah_terima_2']['tmp_name'], $serah_terima_2_target);
    }

    // Insert data proyek ke database
    $sql = "INSERT INTO projects (project_name, start_date, end_date, file_po, file_daily_report, file_k3, file_invoice, file_sat, file_ba, file_serah_terima, file_sat_2, file_ba_2, file_serah_terima_2)
            VALUES (:project_name, :start_date, :end_date, :file_po, :file_daily_report, :file_k3, :file_invoice, :file_sat, :file_ba, :file_serah_terima, :file_sat_2, :file_ba_2, :file_serah_terima_2)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':project_name' => $project_name,
        ':start_date' => $start_date,
        ':end_date' => $end_date,
        ':file_po' => $file_po,
        ':file_daily_report' => $file_daily_report,
        ':file_k3' => $file_k3,
        ':file_invoice' => $file_invoice,
        ':file_sat' => $file_sat,
        ':file_ba' => $file_ba,
        ':file_serah_terima' => $file_serah_terima,
        ':file_sat_2' => $file_sat_2,
        ':file_ba_2' => $file_ba_2,
        ':file_serah_terima_2' => $file_serah_terima_2
    ]);

    // Redirect ke halaman proyek
    header('Location: show_projects.php?success=1');
    exit();
}
