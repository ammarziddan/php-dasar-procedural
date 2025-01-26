<?php

require 'functions.php';

// jalankan session
session_start();

// cek cookie remember beserta valuenya
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = fetch("SELECT username FROM users WHERE id = $id");

    // cek cookie dan username
    if ($key === hash('sha256', $result['username'])) {
        $_SESSION['login'] = true;
    }
}

// cek session login
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

// base query
$keyword = "SELECT * FROM mahasiswa";

// search $_GET
$get = $_GET;
unset($get['page']);

$search = '';
if (isset($_GET['keyword'])) {
    $search = search($_GET['keyword']);
}
$keyword = $keyword . ' ' . $search;

if (isset($_GET['clear'])) {
    $_GET = [];
}

// TODO: coba pagination menggunakan method post
// Pagination
$paginate = paginate($keyword);

$keyword = $keyword . ' ' . $paginate['keyword'];

$mahasiswa = fetchAll($keyword);

?>

<!-- TODO: Redesign UI -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
</head>

<body>

    <a href="logout.php">Logout</a>

    <h1>Daftar Mahasiswa</h1>

    <a href="insert.php">Tambah Data Mahasiswa</a>
    <br><br>

    <form action="" method="get">
        <input id="keyword" type="text" name="keyword" size="45" placeholder="search data..." autofocus>
        <button type="submit" id="search-btn">Search</button>
    </form>

    <!-- Clear Search button -->
    <?php if (isset($_GET['keyword'])) : ?>
        <br>
        <p style="display: inline;">showing results for <i>'<?= $_GET['keyword'] ?>''</i>. </p>
        <a href="index.php">Clear search</a>
    <?php endif; ?>

    <br><br>

    <!-- Pagination -->
    <?php if ($paginate['activePage'] > 1) : ?>
        <a href="?<?= http_build_query($get) ?>&page=<?= $paginate['activePage'] - 1 ?>">&laquo;</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $paginate['pageCount']; $i++) :  ?>
        <?php if ($i == $paginate['activePage']) : ?>
            <a href="?<?= http_build_query($get) ?>&page=<?= $i ?>"><b><?= $i ?></b></a>
        <?php else : ?>
            <a href="?<?= http_build_query($get) ?>&page=<?= $i ?>"><?= $i ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if ($paginate['activePage'] < $paginate['pageCount']) : ?>
        <a href="?<?= http_build_query($get) ?>&page=<?= $paginate['activePage'] + 1 ?>">&raquo;</a>
    <?php endif; ?>
    <br><br>

    <div id="data-table">
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
            <?php $i = $paginate['offset'] + 1 ?>
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
    </div>


    <script src="js/script.js"></script>
</body>

</html>