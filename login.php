<?php

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
    <h1>Halaman Registrasi</h1>

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
                <button type="submit" name="login">Login</button>
            </li>
        </ul>
    </form>
</body>

</html>