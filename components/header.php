<?php $base_url = '/elin'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <script>
        document.querySelector('.navlink li').addEventListener('mouseover', function() {
        document.querySelector('.dropdown').style.display = 'block';
        document.querySelector('.dropdown').style.zIndex = '10'; // Pastikan lebih tinggi dari tombol delete
        });

        document.querySelector('.navlink li').addEventListener('mouseleave', function() {
        document.querySelector('.dropdown').style.display = 'none';
        });

    </script>

    <style>
        body{
            font-family: 'Poppins';
            margin: 0;
            padding: 0;
        }

        nav {
            z-index: 1; /* Pastikan nilai lebih rendah dari z-index dropdown */
            padding: 0 15px;
            top: 0;
            position: sticky;
            background-color: #153448;
        }

        .navbar{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo{
            text-decoration: none;
            color: #DFD0B8;
            font-family: 'MuseoModerno';
            font-size: 20px;
        }   

        .logout{
            
            text-decoration: none;
            color: #DFD0B8;
            font-family: 'Poppins';
            font-size: 20px;
        }

        .logout:hover{
            color: #A18849;
            font-weight: bold;
        }

        .navlink{
            display: flex ;
            margin-right: 100px;
            list-style: none;
            
        }

        .navlink li{
            display: inline-block;
            position: relative;
        }

        .navlink li a{
            display: block;
            padding: 15px 50px;
            font-size: 18px;
            text-decoration: none;
            text-align: center;
            color: #DFD0B8;
            font-weight: bold;
        }

        ul li ul.dropdown {
            width: 80%;
            background: #153448;
            position: absolute;
            z-index: 9999;
            display: none;
            top: 50px; /* Pastikan menggunakan satuan px */
            left: 0;
            overflow: visible; /* Memastikan dropdown tidak terpotong */
        }
        ul li a:hover{
            text-decoration: underline;
            color: #A18849;
        }

        .dropdown li{
            display: block; 
        }

        .dropdown li a{
            font-size: 15px;
            font-weight: none;
            padding-left: 0%;
        }

        ul li:hover .dropdown{
            display: block;
        }
    </style>

</head>
<body>
    <nav>
        <div class="navbar">
            <a class="logo" href="<?= $base_url ?>/admin.php"><h2>Pandawa</h2></a>
            <ul class="navlink">
                <li><a href="<?= $base_url ?>/admin.php">Home</a></li>
                <li>
                    <a href="<?= $base_url ?>/admin.php">Data Karyawan ▼ </a>
                    <ul class="dropdown">
                        <li><a href="<?= $base_url ?>/karyawan/form_employee.php">Form Karyawan</a></li>
                        <li><a href="<?= $base_url ?>/karyawan/show_employees.php">Data Karyawan</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?= $base_url ?>/admin.php">Data Project ▼</a>
                    <ul class="dropdown">
                        <li><a href="<?= $base_url ?>/proyek/form_project.php">Form Project</a></li>
                        <li><a href="<?= $base_url ?>/proyek/show_projects.php">Data Project</a></li>
                    </ul>
                </li>
            </ul>
            <a href="logout.php" class="logout">Logout</a>
        </div>
    </nav>
</body>


</html>