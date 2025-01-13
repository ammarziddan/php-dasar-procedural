<?php

require 'functions.php';

$mahasiswa = fetch('SELECT * FROM mahasiswa');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
</head>

<body>

    <h1>Daftar Mahasiswa</h1>

    <a href="insert.php">Tambah Data Mahasiswa</a>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>NPM</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
        </tr>
        <?php $i = 1 ?>
        <?php foreach ($mahasiswa as $mhs) : ?>
            <tr>
                <td><?= $i ?></td>
                <td>
                    <a href="">edit</a> |
                    <a href="delete.php?id=<?= $mhs['id'] ?>" onclick="return confirm('yakin ingin menghapus data <?= $mhs['nama'] ?>?')">hapus</a>
                </td>
                <td><img src="img/<?= $mhs['gambar'] ?>" alt="<?= $mhs['gambar'] ?>" width="80"></td>
                <td><?= $mhs['npm'] ?></td>
                <td><?= $mhs['nama'] ?></td>
                <td><?= $mhs['email'] ?></td>
                <td><?= $mhs['jurusan'] ?></td>
            </tr>
            <?php $i++ ?>
        <?php endforeach; ?>
    </table>

</body>

</html>