
<?php 

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require "functions.php";
// koneksi ke dbms
$conn = mysqli_connect("localhost","root","","phpdasar");

// ambil data di url
$id = $_GET["id"];
// query data mahasiswa berdasarkan id nya

$mhs = query("SELECT * FROM mahasiswa WHERE id = $id") [0];

// cek apakah tombol submit sudah di tekan atau belum
if( isset($_POST["submit"]) ) {

    // cek data berhasil di ubah atau tidak
    if(edit($_POST) > 0) {
        echo "<script> 
                alert('data berhasil di edit');
                document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script> 
                alert('data gagal di edit');
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
    <title>tambah edit mahasiswa</title>
</head>
<body>
    <h1>edit data mahasiswa</h1>    

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $mhs['id']; ?>">
        <input type="hidden" name="gambarLama" value="<?= $mhs['gambar']; ?>">
    <ul>
        <li>
            <label for="noSiswa">No Siswa :</label>
            <input type="text" name="noSiswa" id="noSiswa" required 
            value="<?= $mhs["noSiswa"]; ?>">
        </li>
        <li>
            <label for="nama">Nama :</label>
            <input type="text" name="nama" id="nama" required
            value="<?= $mhs["nama"]; ?>">
        </li>
        <li>
            <label for="email">Email :</label>
            <input type="text" name="email" id="email" required
            value="<?= $mhs["email"]; ?>">
        </li>
        <li>
            <label for="jurusan">Jurusan :</label>
            <input type="text" name="jurusan" id="jurusan" required
            value="<?= $mhs["jurusan"]; ?>">
        </li>
        <li>
            <label for="gambar">Gambar :</label> <br>
            <img src="img/<?= $mhs["gambar"]; ?>" alt="gambar" width="50"><br>
            <input type="file" name="gambar" id="gambar"
            value="<?= $mhs["gambar"]; ?>">
        </li>
        <button type="submit" name="submit" style="cursor: pointer;">edit data</button>
    </ul>
    </form>
    <a href="index.php">back to home</a>

</body>
</html>