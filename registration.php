<?php

require 'functions.php';

if (isset($_POST['register'])) {
    // TODO: tampilkan pesan error
    if (register($_POST)) {
        echo "
            <script>
            alert('Registrasi berhasil!');
            </script>
            
        ";
    } else {
        echo "
            <script>
            alert('Registrasi gagal!');
            </script>
        ";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>

    <style>
        label {
            display: block;
        }
    </style>
</head>

<body>
    <!-- TODO: Redesign UI -->
    <h1>Halaman Registrasi</h1>
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
                <label for="confirmPass">Confirm Your Password</label>
                <input type="password" id="confirmPass" name="confirmPass" required>
            </li>
            <li>
                <button type="submit" name="register">Register</button>
            </li>
        </ul>
    </form>
</body>

</html>