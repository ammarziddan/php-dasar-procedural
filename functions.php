<?php
// konfigurasi environment
require 'env.php';

// TODO: coba koneksi ke database menggunakan PDO
// Koneksi ke database
$conn = mysqli_connect($hostname, $db_user, $db_password, $db_name);

// query to database
function query($query)
{
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
    return "WHERE
            nama LIKE '%$keyword%'OR
            npm LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%'
    ";
}

// TODO: optimasi pagination
// pagination
function paginate($keyword)
{
    // limit per halaman
    $limit = 5;

    // jumlah rows tabel mahasiswa
    $rowCount = mysqli_num_rows(query($keyword));

    // jumlah halaman
    $pageCount = ceil($rowCount / $limit);

    // active page
    $activePage = isset($_GET['page']) ? $activePage = $_GET['page'] : $_GET['page'] = 1;

    // menentukan offset
    $offset = $activePage * $limit - $limit;

    $keyword = "LIMIT $offset, $limit";

    return [
        'activePage' => $activePage,
        'pageCount' => $pageCount,
        'offset' => $offset,
        'keyword' => $keyword
    ];
}

// upload file gambar
function upload()
{
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
    // get image filename
    $getImg = "SELECT gambar FROM mahasiswa WHERE id=$id";
    $imgName = fetch($getImg)['gambar'];

    // remove old image
    unlink("img/$imgName");

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
    $gambar = htmlspecialchars($data['oldImg']);

    // cek apakah ada gambar baru
    if ($_FILES['gambar']['error'] === 0) {
        // remove old image
        if (file_exists("img/$gambar")) {
            unlink("img/$gambar");
        }

        $gambar = upload();
    }


    $query = "UPDATE mahasiswa 
            SET nama='$nama', npm='$npm', email='$email', jurusan='$jurusan', gambar='$gambar'
            WHERE id=$id";

    return query($query);
}

function register($data)
{
    global $conn;

    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['confirmPass']);

    // cek apakah username sudah ada
    $query = "SELECT username FROM users WHERE username='$username'";
    if (fetch($query)) {
        echo "
            <script>
            alert('Username sudah ada!');
            </script>
        ";
        return false;
    };

    // konfirmasi password
    if ($password !== $password2) {
        echo "
            <script>
            alert('Konfirmasi password gagal!');
            </script>
        ";
        return false;
    }

    // password encryption
    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users VALUES ('', '$username', '$password')";

    return query($query);
}

function login($data)
{
    $username = $data['username'];
    $password = $data['password'];

    $query = "SELECT * FROM users WHERE username = '$username'";

    // cek username
    if (mysqli_num_rows(query($query)) === 1) {

        // cek password
        $row = mysqli_fetch_assoc(query($query));
        if (password_verify($password, $row['password'])) {
            // set session
            $_SESSION['login'] = true;

            // cek rememberMe
            // TODO: simpan cookie di database, lalu cek dari database
            if (isset($_POST['rememberMe'])) {
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }

            header('Location: index.php');
            exit;
        }
    }

    return false;
}
