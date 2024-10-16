<?php $base_url = '/elin'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Poppins';
            margin: 0;
            padding: 0;
        }

        nav{
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

        ul li ul.dropdown{
            width: 81%;
            background: #153448;
            position: absolute;
            z-index: 999;
            display: none;
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
            <a href="/elin" class="logo"><h2>Pandawa</h2></a>
            <ul class="navlink">
                <li><a href="<?= $base_url ?>/">Home</a></li>
                <li>
                    <a href="<?= $base_url ?>/">Data Karyawan ▼ </a>
                    <ul class="dropdown">
                        <li><a href="<?= $base_url ?>/karyawan/form_employee.php">Form Karyawan</a></li>
                        <li><a href="<?= $base_url ?>/karyawan/show_employees.php">Data Karyawan</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?= $base_url ?>/">Data Project ▼</a>
                    <ul class="dropdown">
                        <li><a href="<?= $base_url ?>/proyek/form_project.php">Form Project</a></li>
                        <li><a href="<?= $base_url ?>/proyek/show_projects.php">Data Project</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</body>


</html>