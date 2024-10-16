<?php
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_name = $_POST['project_name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $file_po = $_FILES['file_po']['name'];
    $file_laporan_keuangan = $_FILES['file_laporan_keuangan']['name'];
    $file_invoice = $_FILES['file_invoice']['name'];
    $file_sat = $_FILES['file_sat']['name'];
    $file_daily_report = $_FILES['file_daily_report']['name'];
    $file_ba = $_FILES['file_ba']['name'];
    $file_serah_terima = $_FILES['file_serah_terima']['name'];
    $file_sat_2 = $_FILES['file_sat_2']['name'];
    $file_daily_report_2 = $_FILES['file_daily_report_2']['name'];
    $file_ba_2 = $_FILES['file_ba_2']['name'];
    $file_serah_terima_2 = $_FILES['file_serah_terima_2']['name'];

    $target_dir = "../uploads/projects/";
    $po_target = $target_dir . basename(path: $file_po);
    $laporan_keuangan_target = $target_dir . basename(path: $file_laporan_keuangan);
    $invoice_target = $target_dir . basename(path: $file_invoice);
    $sat_target = $target_dir . basename(path: $file_sat);
    $daily_report_target = $target_dir . basename(path: $file_daily_report);
    $ba_target = $target_dir . basename(path: $file_ba);
    $serah_terima_target = $target_dir . basename(path: $file_serah_terima);
    $sat_2_target = $target_dir . basename(path: $file_sat_2);
    $daily_report_2_target = $target_dir . basename(path: $file_daily_report_2);
    $ba_2_target = $target_dir . basename(path: $file_ba_2);
    $serah_terima_2_target = $target_dir . basename(path: $file_serah_terima_2);

    move_uploaded_file(from: $_FILES['file_po']['tmp_name'],
    to: $po_target);
    move_uploaded_file(from: $_FILES['file_laporan_keuangan']['tmp_name'],
    to: $laporan_keuangan_target);
    move_uploaded_file(from: $_FILES['file_invoice']['tmp_name'],
    to: $invoice_target);
    move_uploaded_file(from: $_FILES['file_sat']['tmp_name'],
    to: $sat_target);
    move_uploaded_file(from: $_FILES['file_daily_report']['tmp_name'],
    to: $daily_report_target);
    move_uploaded_file(from: $_FILES['file_ba']['tmp_name'],
    to: $ba_target);
    move_uploaded_file(from: $_FILES['file_serah_terima']['tmp_name'],
    to: $serah_terima_target);
    move_uploaded_file(from: $_FILES['file_sat_2']['tmp_name'],
    to: $sat_2_target);
    move_uploaded_file(from: $_FILES['file_daily_report_2']['tmp_name'],
    to: $daily_report_2_target);
    move_uploaded_file(from: $_FILES['file_ba_2']['tmp_name'],
    to: $ba_2_target);
    move_uploaded_file(from: $_FILES['file_serah_terima_2']['tmp_name'],
    to: $serah_terima_2_target);
  
    $sql = "INSERT INTO projects (project_name, start_date, end_date, file_po, file_laporan_keuangan, file_invoice, file_sat, file_daily_report, file_ba, file_serah_terima, file_sat_2, file_daily_report_2, file_ba_2, file_serah_terima_2)
            VALUES (:project_name, :start_date, :end_date, :file_po, :file_laporan_keuangan, :file_invoice, :file_sat, :file_daily_report, :file_ba, :file_serah_terima, :file_sat_2, :file_daily_report_2, :file_ba_2, :file_serah_terima_2)";

    $stmt = $pdo->prepare(query: $sql);
    $stmt->execute(params: [
        ':project_name' => $project_name,
        ':start_date' => $start_date,
        ':end_date' => $end_date,

        ':file_po' => $file_po,
        ':file_laporan_keuangan' => $file_laporan_keuangan,
        ':file_invoice' => $file_invoice,
        ':file_sat' => $file_sat,
        ':file_daily_report' => $file_daily_report,
        ':file_ba' => $file_ba,
        ':file_serah_terima' => $file_serah_terima,
        ':file_sat_2' => $file_sat_2,
        ':file_daily_report_2' => $file_daily_report_2,
        ':file_ba_2' => $file_ba_2,
        ':file_serah_terima_2' => $file_serah_terima_2

    ]);

    header(header: 'Location: show_projects.php?success=1');
    exit();
}