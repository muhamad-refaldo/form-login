<?php

$conn = mysqli_connect("localhost","root","","phpdasar");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    };

    return $rows;
};




function tambah($data) {
// ambil data dari tiap elemen form
global $conn;
    $nama = htmlspecialchars( $data["nama"]);
    $noSiswa = htmlspecialchars ($data["noSiswa"]);
    $email = htmlspecialchars ($data["email"]);
    $jurusan = htmlspecialchars ($data["jurusan"]);
    // $gambar = htmlspecialchars ($data["gambar"]);

    // upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }


    $query = "INSERT INTO mahasiswa
                    VALUES
    ('', '$nama', '$noSiswa', '$email', '$jurusan', '$gambar')
    ";
        mysqli_query($conn, $query);

        return(mysqli_affected_rows( $conn));
}

function upload() {

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar di upload

    if( $error === 4) {
        echo "<script>
            alert('pilih gambar dulu ya brok');
            </script>";
            return false;
    }

    // cek apakah yang di upload gambar

    $ekstensiGambarValid = ['jpg', 'png', 'jpeg'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {

        echo "<script>
        alert(' gambar tidak valid brok');
        </script>";
        return false;
    }

    // cek jika ukuran terlalu besar
    if($ukuranFile > 1000000) {
        echo "<script>
        alert(' ukuranya kegedean brok, ga kira kira lu brok');
        </script>";
        return false;
    }

    // generate gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    
    // gambar siap di upload
    move_uploaded_file($tmpName,'img/' . $namaFileBaru);

    return $namaFileBaru;


}


function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id=$id");
    return mysqli_affected_rows($conn);
}

function edit($data) {
    global $conn;

    $id = $data ["id"];
    $nama = htmlspecialchars( $data["nama"]);
    $noSiswa = htmlspecialchars ($data["noSiswa"]);
    $email = htmlspecialchars ($data["email"]);
    $jurusan = htmlspecialchars ($data["jurusan"]);
    $gambar = htmlspecialchars ($data["gambar"]);
    $gambarLama = htmlspecialchars ($data["gambarLama"]);
    // cek apakah user pilih gambar baru atau tidak

    if($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }


    $query = "UPDATE mahasiswa SET
                nama = '$nama',
                noSiswa = '$noSiswa',
                email = '$email',
                jurusan = '$jurusan',
                gambar = '$gambar'
                WHERE id = $id
                ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows( $conn);
}

function cari($keayword) {
    $query = "SELECT * FROM mahasiswa
                WHERE
            nama LIKE '%$keayword%' OR
            noSiswa LIKE '%$keayword%' OR
            email LIKE '%$keayword%' OR
            jurusan LIKE '%$keayword%'
    ";
    return query($query);
}


function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if(mysqli_fetch_assoc( $result )) {
        echo "<script>
            alert('username yang di pilih sudah ada');
            </script>";
            return false;
    }

    // cek konfirmasi password
    if($password !== $password2) {
        echo "<script>
            alert('konfirmasi password tidak sesuai brokkk');
            </script>";
            return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke DB
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);
}

// function registrasi($data) {
//     global $conn;
//     $username = htmlspecialchars( $data["username"]);
//     $password = htmlspecialchars( $data["password"]);
//     $password2 = htmlspecialchars( $data["password2"]);

//     $query = "INSERT INTO user  VALUES
//     ('', '$username', '$password', '$password2')";

//     mysqli_query($conn, $query);
//     return mysqli_affected_rows($conn);
// }





?>