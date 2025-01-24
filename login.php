<?php
session_start();

// cek apakah ada session login
if (isset($_SESSION['login'])) {
    header('Location: index.php');
    exit;
}

require 'functions.php';

if (isset($_POST['login'])) {
    if (!login($_POST)) {
        $error = true;
    };
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        label {
            display: block;
        }
    </style>
</head>

<body>
    <!-- TODO: Redesign UI -->
    <h1>Halaman Login</h1>


    <?php if (isset($error)) : ?>
        <p style="color: red; font-style:italic">Username atau password salah.</p>
    <?php endif ?>

    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </li>
            <li>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </li>
            <li>
                <input type="checkbox" id="rememberMe" name="rememberMe">
                <label for="rememberMe">Remember me</label>
            </li>
            <li>
                <button type="submit" name="login">Login</button>
                <p>belum punya akun? klik <a href="registration.php">disini</a></p>
            </li>
        </ul>
    </form>
</body>

</html>