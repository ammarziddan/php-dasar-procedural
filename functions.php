<?php
// TODO: coba koneksi ke database menggunakan PDO
// Koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'php-dasar');

// query to database
function query($query) {
    global $conn;
    return mysqli_query($conn, $query);
}

// fetch data all
function fetchAll($query)
{
    $result = query($query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// fetch data
function fetch($query)
{
    return mysqli_fetch_assoc(query($query));
}

// Search data
function search($keyword)
{
    return "SELECT * FROM mahasiswa 
            WHERE
            nama LIKE '%$keyword%'OR
            npm LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%'
    ";
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

function update($id, $data)
{
    $id = $id;
    $nama = htmlspecialchars($data['nama']);
    $npm = htmlspecialchars($data['npm']);
    $email = htmlspecialchars($data['email']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $gambar = htmlspecialchars($data['gambar']);

    $query = "UPDATE mahasiswa 
            SET nama='$nama', npm='$npm', email='$email', jurusan='$jurusan', gambar='$gambar'
            WHERE id=$id";

    return query($query);
}