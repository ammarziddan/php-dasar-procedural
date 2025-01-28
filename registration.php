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
    <title>Sign Up</title>

    <!-- style.css -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- TODO: tambahkan email verification -->
    <div class="login">
        <div class="login-header">
            <h1 class="login-title">Sign Up</h1>
        </div>
        <div class="login-content">
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
                    <li>
                        <label class="login-label" for="confirmPass">Confirm Your Password</label>
                        <input class="login-input-text" type="password" id="confirmPass" name="confirmPass" required>
                    </li>
                    <li>
                        <button class="login-btn" type="submit" name="register">Register</button>
                    </li>
                    <p>sudah punya akun? klik <a href="login.php">disini</a></p>
                </ul>
            </form>
        </div>
    </div>
</body>

</html>