$(function () {

    // membuat event ketika keyword ditulis
    $('#keyword').on('keyup', function () {
        // munculkan icon loader
        $('.img-loader').show();

        // // ajax menggunakan load
        // $('#data-table').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val());

        // menggunakan $.get()
        $.get('ajax/mahasiswa.php?keyword=' + $('#keyword').val(), function(data) {

            $('#data-table').html(data);

            // hilangkan icon loader
            $('.img-loader').hide();
        })
    })
})