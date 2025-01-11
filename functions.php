<?php
// TODO: coba koneksi ke database menggunakan PDO
// Koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'php-dasar');

// fetch all data in array assoc
function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}