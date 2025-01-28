$(function () {

    // membuat event ketika keyword ditulis
    $('#keyword').on('keyup', function () {
        // munculkan icon loader
        $('.img-loader').show();

        // menggunakan $.get()
        $.get('jquery/mahasiswa.php?keyword=' + $('#keyword').val(), function(data) {

            $('#data-table').html(data);

            // hilangkan icon loader
            $('.img-loader').hide();
        })
    })
})