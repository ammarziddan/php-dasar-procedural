<?php
require 'functions.php';

$id = $_GET['id'];

// fetch data berdasarkan $_GET['id']
$mhs = fetch("SELECT * FROM mahasiswa WHERE id=$id");

if (isset($_POST['submit'])) {
    if (update($id, $_POST)) {
        echo "
            <script>
            alert('Berhasil mengubah data');
            document.location.href = 'index.php'
            </script>
        ";
    } else {
        // TODO: tambahkan pesan error
        echo "
            <script>
            alert('Gagal mengubah data!');
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
    <title>Edit Data Mahasiswa</title>
</head>

<body>

    <h1>Edit Data Mahasiswa</h1>

    <!-- TODO: Tambahkan csrf token (manual) -->
    <form action="" method="post">
        <ul>
            <li>
                <label for="npm">NPM</label>
                <input type="text" name="npm" id="npm" required value='<?= $mhs['npm'] ?>'>
            </li>
            <li>
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" required value='<?= $mhs['nama'] ?>'>
            </li>
            <li>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" required value='<?= $mhs['email'] ?>'>
            </li>
            <li>
                <label for="jurusan">Jurusan</label>
                <input type="text" name="jurusan" id="jurusan" required value='<?= $mhs['jurusan'] ?>'>
            </li>
            <li>
                <label for="gambar">Gambar</label>
                <input type="text" name="gambar" id="gambar" value='<?= $mhs['gambar'] ?>'>
            </li>
            <li>
                <button type="submit" name="submit">Ubah data</button>
            </li>
        </ul>
    </form>

</body>

</html>