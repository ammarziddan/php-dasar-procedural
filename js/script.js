// Ambil elemen keyword, search-btn, data-table
const keyword = document.getElementById("keyword");
const searchBtn = document.getElementById("search-btn");
const dataTable = document.getElementById("data-table");

// tambahkan event ketika input diisi
keyword.addEventListener("keypress", function () {

    // buat object ajax
    const xhr = new XMLHttpRequest();

    // cek kesiapan ajax
    xhr.onreadystatechange = function () {
        if(xhr.readyState == 4 && xhr.status == 200) {
            dataTable.innerHTML = xhr.responseText;
        }
    }

    // eksekusi ajax
    xhr.open('GET', 'ajax/mahasiswa.php?keyword=' + keyword.value, true);
    xhr.send();

});
