<?php
// TODO: coba koneksi ke database menggunakan PDO
// Koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'php-dasar');

// query to database
function query($query) {
    global $conn;
    return mysqli_query($conn, $query);
}

// fetch data
function fetch($query)
{
    $result = query($query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Insert Data
function insert($data)
{
    global $conn;

    // ambil semua data dari form
    $npm = htmlspecialchars($data['npm']);
    $nama = htmlspecialchars($data['nama']);
    $email = htmlspecialchars($data['email']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $gambar = htmlspecialchars($data['gambar']);

    // query insert data
    $query = "INSERT INTO mahasiswa 
    (id, nama, npm, email, jurusan, gambar)
    VALUES 
    ('', '$nama', '$npm', '$email', '$jurusan', '$gambar')";

    // jalankan query tambah data
    return query($query);
}

function destroy($id)
{
    $query = "DELETE FROM mahasiswa WHERE id=$id";
    return query($query);
}