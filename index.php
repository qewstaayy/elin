<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        // Ambil data user berdasarkan username
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verifikasi password yang diinput dengan password yang di-hash di database
            if (password_verify($password, $user['password'])) {
                // Login berhasil, simpan data user ke session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Redirect berdasarkan role
                if ($user['role'] === 'admin') {
                    header("Location: admin.php");
                } elseif ($user['role'] === 'user') {
                    header("Location: user.php");
                }
                exit;
            } else {
                // Password salah
                $error = "Incorrect password!";
            }
        } else {
            // User tidak ditemukan
            $error = "User not found!";
        }
    } else {
        $error = "Please fill in all fields!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<style> 
    body {
        font-family: 'Poppins';
        background-color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        
    }
    .container img {
        width: 150px;
    }
    form{
        background-color: #fff;
        padding: 40px 55px;
        border-radius: 15px;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
    }
    form label{
        display: block;
        text-align: left;
    }
    form input{
        width: 280px;
        justify-content: center;
        padding: 10px ;
        border: 2px solid #000;
        border-radius: 7px;
    }
    .btn-login  {
        display: inline-block;
        width: 100%;
        padding: 12px;
        background-color: #153448;
        color: #fff;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 20px;
    }
    .btn-login:hover {
        background-color: #1A3D54;
        color: #A18849;
        font-weight: 700;
    }

    @media (max-width: 768px) {

    }
</style>

<body>
    <div class="container">
        <img src="asset/logo.jpeg" alt="logo" class="logo"><br>

        <form method="POST" action="">    
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        
            <label>Username:</label>
            <input type="text" name="username" required><br><br>

            <label>Password:</label>
            <input type="password" name="password" required><br><br>

            <button type="submit" class="btn-login">LOG IN</button>
        </form>
    </div>
</body>
</html>