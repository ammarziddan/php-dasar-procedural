<?php
require 'functions.php';

if (isset($_POST['submit'])) {
    if (insert($_POST)) {
        echo "
            <script>
            alert('Berhasil menambahkan data');
            document.location.href = 'index.php'
            </script>
            
        ";
    } else {
        // TODO: tambahkan pesan error
        echo "
            <script>
            alert('Gagal menambahkan data!');
            document.location.href = 'index.php'
            </script>  
        ";
    };
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>Tambah Data Mahasiswa</h1>

    <!-- TODO: Tambahkan csrf token (manual) -->
    <form action="" method="post">
        <ul>
            <li>
                <label for="npm">NPM</label>
                <input type="text" name="npm" id="npm" required>
            </li>
            <li>
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" required>
            </li>
            <li>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" required>
            </li>
            <li>
                <label for="jurusan">Jurusan</label>
                <input type="text" name="jurusan" id="jurusan" required>
            </li>
            <li>
                <label for="gambar">Gambar</label>
                <input type="text" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">Masukkan data</button>
            </li>
        </ul>
    </form>

</body>

</html>