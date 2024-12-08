<!DOCTYPE html>
<html>
<head>
    <title>Tambah Karyawan</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #fff;
            color: #333;
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

        .contact{
            display: flex;
        }

        .contact label{
            width: 236px;
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

        .part2 {
            background-color: #3C5B6F;
            border-radius: 10px;
            padding: 30px;
            width: 450px;
            margin: 1px auto;
            margin-left: 10px;
            justify-content: space-between;
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
            margin-bottom: 2px;
            color: #DFD0B8;
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
            background: rgba(219, 204, 181, 0.29);
            color: #000;
            text-align: center;
            border: 2px dotted black; 
            }

        form input[type="file"]:hover {
            box-shadow: 0 0 20px rgba(87, 89, 93, 0.6), 0 0 40px rgba(87, 89, 93, 0.4);
            background: rgba(46, 43, 38, 0.29);
        } 

        .foto{
            display: block;
            margin: 0 auto;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, border-color 0.3s;
            }

        .foto:hover {
            border-color: #bbb;
        }

        .foto:focus {
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

<?php include '../config.php'; ?>

    <div class="back-button">
        <a href="../admin.php"><span class="arrow">&larr;</span> Back</a>
    </div>

    <h1>Form Tambah Karyawan</h1>
    <form action="add_employee.php" method="POST" enctype="multipart/form-data">
        <div class="part1">
            <label>Nama:</label>
            <input type="text" name="name" required><br><br>
            
            <div class="contact">
                <div class="email">
                    <label>Email:</label>
                    <input type="email" name="email" required><br><br>
                </div>

                <div class="no_hp">
                    <label>No HP:</label>
                    <input type="text" name="no_hp" required><br><br>
                </div>
            </div>

            <label>Alamat:</label>
            <textarea name="alamat" required></textarea><br><br>
            
            <label>Tanggal Masuk:</label>
            <input type="date" name="tgl_masuk" required><br><br>

            <div class="bank">
                <div class="nama_bank">
                    <label>Nama Bank:</label>
                    <input type="text" name="nama_bank" required><br><br>
                </div>

                <div class="no_rek">
                    <label>No Rekening:</label>
                    <input type="text" name="no_rek" required><br><br>
                </div>
            </div>
            <label>No BPJS:</label>
            <input type="text" name="no_bpjs" required><br><br>
        </div>

        <div class="part2">
            <label for="gender">Gender:</label>
            <div class="gender">
                <div class="P">
                    <input type="radio" id="perempuan" name="gender" value="perempuan">
                    <label for="perempuan">Perempuan</label>
                </div>

                <div class="L">
                    <input type="radio" id="laki-laki" name="gender" value="laki-laki">
                    <label for="laki-laki">Laki - Laki</label>
                </div>
            </div>
            <br><br>
            
                <label for="uk_pakaian">Ukuran Pakaian:</label>
            <div class="pakaian">
                <label for="uk_baju">Baju</label>
                <input type="text" id="uk_baju" name="uk_baju" class="uk_pakaian">

                <label for="uk_celana">Celana</label>
                <input type="text" id="uk_celana" name="uk_celana" class="uk_pakaian">

                <label for="uk_sepatu">Sepatu</label>
                <input type="text" id="uk_sepatu" name="uk_sepatu" class="uk_pakaian">
            </div><br>

    
                <label>Foto KTP:</label>
                <input type="file" name="ktp_photo" accept="image/*" class="foto" id="ktp" required>
                
                <label>Foto KK:</label>
                <input type="file" name="kk_photo" accept="image/*" class="foto" id="kk" required>
                
                <label>Foto Ijazah:</label>
                <input type="file" name="ijazah_photo" accept="image/*" class="foto" id="ijazah" required>
            

            <button type="submit">Submit</button>
        </div>
    </form>
</body>
</html>