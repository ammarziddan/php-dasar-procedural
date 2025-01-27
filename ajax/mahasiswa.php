<?php

require '../functions.php';

$keyword = search($_GET['keyword']);
$base_query = "SELECT * FROM mahasiswa";
$query = $base_query . ' ' . $keyword . ' LIMIT 5';
$mahasiswa = fetchAll($query);

?>
<br><br><br><br>

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
                <a href="update.php?id=<?= $mhs['id'] ?>">edit</a> |
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