<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Project Form</title>
    <style>
        .hidden {
            display: none;
        }
        .form-group {
            margin-bottom: 15px;
        }
    </style>
    <script>
        function toggleAdditionalFields() {
            const sat2 = document.getElementById('file_sat_2').value;
            const ba2Section = document.getElementById('ba_2_section');
            const serahTerima2Section = document.getElementById('serah_terima_2_section');
            
            if (sat2) {
                ba2Section.classList.remove('hidden');
                serahTerima2Section.classList.remove('hidden');
            } else {
                ba2Section.classList.add('hidden');
                serahTerima2Section.classList.add('hidden');
            }
        }
    </script>
</head>
<body>
<?php include '../config.php'?>

    <a href="/elin" class="back-button">
            <span class="arrow">&larr;</span> Back
        </a>

    <h1>Form Tambah Proyek</h1>
    <form action="../proyek/add_project.php" method="POST" enctype="multipart/form-data">
        <div class="part1">
                <label for="project_name">Nama Proyek:</label>
                <input type="text" id="project_name" name="project_name" required>

            <div class="date">
                <div class="mulai">
                    <label for="start_date">Tanggal Mulai:</label>
                    <input type="date" id="start_date" name="start_date" required>
                </div>

                <div class="selesai">
                    <label for="end_date">Tanggal Selesai:</label>
                    <input type="date" id="end_date" name="end_date" required>
                </div>
            </div>

            <!-- File PO -->
                <label for="file_po">File PO:</label>
                <input type="file" id="file_po" name="file_po" accept="application/pdf" class="pdf" required>

            <!-- Invoice -->
                <label for="file_invoice">Invoice:</label>
                <input type="file" id="file_invoice" name="file_invoice" accept="application/pdf" class="pdf" required>

            <!-- File Daily K3 -->
                <label for="file_Daily_k3">File Daily K3:</label>
                <input type="file" id="file_Daily_k3" name="file_Daily_k3" accept="application/pdf" class="pdf" required>

            <!-- File Daily Report -->
                <label for="file_daily_report">File Daily Report:</label>
                <input type="file" id="file_daily_report" name="file_daily_report" accept="application/pdf" class="pdf" required>

            <!-- SAT -->
                <label for="file_sat">SAT:</label>
                <input type="file" id="file_sat" name="file_sat" accept="application/pdf" class="pdf" required>
        </div>

        <div class="part2">
            <!-- BA -->
            <div class="form-group">
                <label for="file_ba">BA:</label>
                <input type="file" id="file_ba" name="file_ba" accept="application/pdf" class="pdf2" required>
            </div>

            <!-- Serah Terima -->
            <div class="form-group">
                <label for="file_serah_terima">Serah Terima Barang:</label>
                <input type="file" id="file_serah_terima" name="file_serah_terima" accept="application/pdf" class="pdf2" required>
            </div>

            <!-- SAT 2 -->
                <label for="file_sat_2">SAT 2:</label>
                <input type="file" id="file_sat_2" name="file_sat_2" accept="application/pdf" class="pdf" onchange="toggleAdditionalFields()">

            <div class="2">
                <!-- BA 2 dan Serah Terima 2, Hidden by Default -->

                <div id="ba_2_section" class="form-group hidden">
                    <label for="file_ba_2">BA 2:</label>
                    <input type="file" id="file_ba_2" name="file_ba_2" accept="application/pdf" class="pdf2">
                </div>

                <div id="serah_terima_2_section" class="form-group hidden">
                    <label for="file_serah_terima_2">Serah Terima Barang 2:</label>
                    <input type="file" id="file_serah_terima_2" name="file_serah_terima_2" accept="application/pdf" class="pdf2">
                </div>
            </div>

            <button type="submit">Submit</button> 
        </div>
    </form>
</body>

<style>
    body {
    background-color: #fff;
    font-family: 'Poppins';
    color: #333;
    margin: 0;
    padding: 0;
    }

    .back-button {
        display: inline-flex; 
        align-items: center; 
        background-color: #3C5B6F;
        color: #DFD0B8;
        padding: 5px 10px; 
        margin: 10px;
        border-radius: 10px; 
        text-decoration: none;
        font-size: 16px; 
        font-weight: bold; 
        transition: background-color 0.3s; 
    }

    .back-button:hover {
        background-color: red; 
        color: #000;
    }

    .arrow {
        font-size: 20px; /* Ukuran panah */
        margin-right: 5px;
    }

    h1 {
        text-align: center;
        color: #000;
        margin: 10px;
        font-size: 45px;
    }

    form{
        display: flex;
    }

    .part1 {
        background-color: #3C5B6F;
        border-radius: 10px;
        padding: 30px;
        width: 500px;
        margin: 1px auto;
        margin-right: 10px;
        justify-content: space-between;
    }

    .date{
        display: flex;
    }

    .date label{
        width: 236px;
    }

    .mulai{
        margin: 0 2px;
    }

    .selesai{
        margin: 0 15px;
        margin-right: 10px;
        padding: 0 10px;
    }

    .part2 {
        background-color: #3C5B6F;
        border-radius: 10px;
        padding: 30px;
        width: 450px;
        margin: 1px auto;
        margin-left: 10px;
        justify-content: space-between;
    }
    
    form label {
        display: block;
        margin-bottom: 2px;
        color: #DFD0B8;
    }

    form input[type="text"],
    form input[type="date"] {
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
        margin: 0 auto;
        margin-bottom: 30px;
        border: none;
        border-radius: 10px;
        color: #ffffff;
        cursor: pointer;
        color: #000;
        background: rgba(219, 204, 181, 0.29);
        border: 2px dotted black; 
    }

    form input[type="file"]:hover {
        box-shadow: 0 0 20px rgba(87, 89, 93, 0.6), 0 0 40px rgba(87, 89, 93, 0.4);
        background: rgba(46, 43, 38, 0.29);
    } 

    .pdf{
        display: block;
        margin: 0 auto;
        border: 2px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s, border-color 0.3s;
        width: 85%;
        }

    .pdf:hover {
        background-color: #DFD0B8;
        border-color: #bbb;
    }

    .pdf:focus {
        outline: none;
        border-color: #999;
    }

    .pdf2{
        display: block;
        margin: 0 auto;
        border: 2px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s, border-color 0.3s;
        }

    .pdf1:hover {
        border-color: #bbb;
    }

    .pdf1:focus {
        outline: none;
        border-color: #999;
    }

    form button {
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

    form button:hover {
        background-color: #3C5B6F;
        color: #DFD0B8;
        box-shadow: 0px 3px 7px 0px black;
        font-weight: bold;
    }

    .container {
        display: flex;
        justify-content: space-between;
    }

    .left-section, .right-section {
        width: 48%;
    }

    .form-group {
        margin-bottom: 15px;
    }
</style>

</html>
