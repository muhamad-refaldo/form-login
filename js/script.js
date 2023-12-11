// // ambil element yang di butuhkan
// var keayword = document.getElementById('keayword');
// var tombolCari = document.getElementById('tombol-cari');
// var container = document.getElementById('container');

// // tambahkan event ketika keayword di ketik
// keayword.addEventListener('keyup', function() {

//     // buat object ajax
//     var ajax = new XMLHttpRequest();

//     // cek ajax

//     ajax.onreadystatechange = function() {
//         if(ajax.readyState == 4 && ajax.status == 200) {
//             container.innerHTML = ajax.responseText;
//         }
//     }

//     // eksekusi ajjax
//     ajax.open('GET', 'ajax/siswa.php?keayword=' + keayword.value, true);
//     ajax.send();

// });



// ajax versi jquery
$(document).ready(function() {

    // event ketika keayword fi tulis
    $('#keayword').on('keyup', function(){
        // munculin icon loading
        $('.loader').show();

        // ajax load
        // $('#container').load('ajax/siswa.php?keayword=' + $('#keayword').val());

        // .get()
        $.get('ajax/siswa.php?keayword=' + $('#keayword').val(), function(data){

            $('#container').html(data);
            $('.loader').hide();

    });

    });

});

// hilang tombol cari
$('#tombol-cari').hide();