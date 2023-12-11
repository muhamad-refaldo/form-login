
<?php 

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require "functions.php";

// koneksi ke dbms
$conn = mysqli_connect("localhost","root","","phpdasar");

// cek apakah tombol submit sudah di tekan atau belum
if( isset($_POST["submit"]) ) {

    // cek data berhasil atau tidak
    if(tambah($_POST) > 0) {
        echo "<script> 
                alert('data berhasil di tambahkan');
                document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script> 
                alert('data gagal di tambahkan');
                document.location.href = 'index.php';
        </script>";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah data mahasiswa</title>
</head>
<body>
    <h1>tambah data mahasiswa</h1>    

    <form action="" method="post" enctype="multipart/form-data">
    <ul>
        <li>
            <label for="noSiswa">No siswa :</label>
            <input type="text" name="noSiswa" id="noSiswa" required>
        </li>
        <li>
            <label for="nama">Nama :</label>
            <input type="text" name="nama" id="nama" required>
        </li>
        <li>
            <label for="email">Email :</label>
            <input type="text" name="email" id="email" required>
        </li>
        <li>
            <label for="jurusan">Jurusan :</label>
            <input type="text" name="jurusan" id="jurusan" required>
        </li>
        <li>
            <label for="gambar">Gambar :</label>
            <input type="file" name="gambar" id="gambar">
        </li>
        <button type="submit" name="submit" style="cursor: pointer;">tambah data</button>
    </ul>
    </form>
    <a href="index.php">back to home</a>

</body>
</html>