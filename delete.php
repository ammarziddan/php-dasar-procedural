<?php
require 'functions.php';

$id = $_GET["id"];

if (destroy($id)) {
    // TODO: tambahkan pesan error
    echo "
        <script>
        alert('Berhasil menghapus data!');
        document.location.href = 'index.php'
        </script>
        
    ";
} else {
    echo "
        <script>
        alert('Gagal menghapus data!');
        document.location.href = 'index.php'
        </script>  
    ";
};
