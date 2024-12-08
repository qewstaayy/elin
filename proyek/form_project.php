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
        let counter = 1;
        const maxButton = 10;

        function addFields() { //Mengatur batasan pada tabel yang ditambah
            if (counter >= maxButton){
                alert("Sudah mencapai BATAS!!");
                return;
            }

            counter++; // Menambah hitungan set untuk SAT, BA, dan Serah Terima
            
            // Membuat elemen container baru
            const container = document.createElement('div');
            container.classList.add('form-group');
            container.innerHTML = `

                <label for="file_sat_${counter}">SAT ${counter}:</label>
                <input type="file" id="file_sat_${counter}" name="file_sat_${counter}" accept="application/pdf" class="pdf">

                <label for="file_ba_${counter}">BA ${counter}:</label>
                <input type="file" id="file_ba_${counter}" name="file_ba_${counter}" accept="application/pdf" class="pdf2">

                <label for="file_serah_terima_${counter}">Serah Terima Barang ${counter}:</label>
                <input type="file" id="file_serah_terima_${counter}" name="file_serah_terima_${counter}" accept="application/pdf" class="pdf2">
            `;
            
            // Menambahkan elemen baru ke bagian form
            document.getElementById('dynamic-fields').appendChild(container);
        }
    </script>
</head>
<body>

    <div class="back-button">
        <a href="../admin.php"><span class="arrow">&larr;</span> Back</a>
    </div>

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

            <label for="file_po">File PO:</label>
            <input type="file" id="file_po" name="file_po" accept="application/pdf" class="pdf" required>

            <label for="file_daily_report">File Daily Report:</label>
            <input type="file" id="file_daily_report" name="file_daily_report" accept="application/pdf" class="pdf" required>

            <label for="file_k3">File K3:</label>
            <input type="file" id="file_k3" name="file_k3" accept="application/pdf" class="pdf" required>

            <label for="file_invoice">Invoice:</label>
            <input type="file" id="file_invoice" name="file_invoice" accept="application/pdf" class="pdf" required>

            <label for="file_sat">SAT:</label>
            <input type="file" id="file_sat" name="file_sat" accept="application/pdf" class="pdf" required>

            <label for="file_ba">BA:</label>
            <input type="file" id="file_ba" name="file_ba" accept="application/pdf" class="pdf2 " required>

            <label for="file_serah_terima">Serah Terima:</label>
            <input type="file" id="file_serah_terima" name="file_serah_terima" accept="application/pdf" class="pdf2 " required>
        </div>

        <div class="part2">
            <div id="dynamic-fields"></div> <!-- Kontainer untuk elemen dinamis -->

            <button type="button" onclick="addFields()">Tambah SAT, BA, dan Serah Terima</button>
            <button type="submit" class="submit">Submit</button>
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
        margin: 12px;
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
        margin: 0 10px;
        float: right;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        justify-content: space-between;
    }

    form button:hover {
        background-color: #3C5B6F;
        color: #DFD0B8;
        box-shadow: 0px 3px 5px 0px black;
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
