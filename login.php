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

    <link rel="stylesheet" href="css/style.css">
</head>

<body>


    <div class="login">
        <div class="login-header">
            <h1 class="login-title">Login</h1>
        </div>
        <div class="login-content">
            <?php if (isset($error)) : ?>
                <p class="login-text-failed">Username atau password salah.</p>
            <?php endif ?>
            <form action="" method="post">
                <ul class="form-list">
                    <li>
                        <label class="login-label" for="username">Username</label>
                        <input class="login-input-text" type="text" id="username" name="username" required>
                    </li>
                    <li>
                        <label class="login-label" for="password">Password</label>
                        <input class="login-input-text" type="password" id="password" name="password" required>
                    </li>
                    <li class="remember-me">
                        <input class="login-checkbox" type="checkbox" id="rememberMe" name="rememberMe">
                        <label class="login-label" for="rememberMe">Remember me</label>
                    </li>
                    <li>
                        <button type="submit" name="login" class="login-btn">Login</button>
                    </li>
                    <p>belum punya akun? klik <a href="registration.php">disini</a></p>
                </ul>
            </form>
        </div>
    </div>

</body>

</html>