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

// upload file gambar
function upload()
{
    $fileName = $_FILES['gambar']['name'];
    $size = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];
    $type = $_FILES['gambar']['type'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "
            <script>
                alert('Pilih gambar terlebih dahulu');
            </script>
        ";
        return false;
    }

    // cek apakah file yang diupload merupakan gambar
    $validImg = ['jpeg', 'jpg', 'png'];
    $extension = strtolower(array_reverse(explode('/', $type))[0]);
    if (!in_array($extension, $validImg)) {
        echo "
            <script>
                alert('Upload file gambar');
            </script>
        ";
        return false;
    }

    // cek ukuran file tidak melebihi 2048mb
    if ($size > 2048000) {
        echo "
            <script>
                alert('Ukuran file terlalu besar');
            </script>
        ";
        return false;
    }

    $newFileName = bin2hex(random_bytes(16)) . '.' . $extension;

    // upload file ke direktori
    move_uploaded_file($tmpName, 'img/' . $newFileName);

    return $newFileName;
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

    // ambil file gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    } 

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
    // TODO: jika gambar diganti, hapus file gambar yang lama
    $id = $id;
    $nama = htmlspecialchars($data['nama']);
    $npm = htmlspecialchars($data['npm']);
    $email = htmlspecialchars($data['email']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $gambar = htmlspecialchars($data['oldImg']);

    // cek apakah ada gambar baru
    if ($_FILES['gambar']['error'] === 0) {
        $gambar = upload();
    }


    $query = "UPDATE mahasiswa 
            SET nama='$nama', npm='$npm', email='$email', jurusan='$jurusan', gambar='$gambar'
            WHERE id=$id";

    return query($query);
}