<!-- framework tailwind -->
<!-- <script src="https://cdn.tailwindcss.com"></script> -->

<?php 

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require "functions.php";

// pagination
// konfigurasi
$jumlahDataPerHalaman = 10;
$jumlahData = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

// cara gampang oprator tinery
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ( $jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;


// if cara ribet

// if(isset($_GET['halaman'])) {
// $halamanAktif = $_GET["halaman"];
// } else {
//     $halamanAktif = 1;
// }


// jumlah data versi lama/ribet

// $result = mysqli_query($conn, "SELECT * FROM mahasiswa");
// $jumlahData = mysqli_num_rows($result);


$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $jumlahDataPerHalaman");

// tombol cari di tekan
if(isset($_POST ["cari"])) {
    $mahasiswa = cari($_POST ["keayword"]);
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    
    <a href="logout.php">logout</a>| <a href="print.php">print</a>

    <h1 class="h1-1">daftar siswa & siswi SMK ISLAM ARRIDHO</h1>

    <a href="tambah.php" class="tambah">tambah data mahasiswa</a>
    <br>
    <form action="" method="post">

    <input type="text" name="keayword" size="50" autofocus placeholder="input pencarian" autocomplete="off" id="keayword">
    <button type="submit" name="cari" id="tombol-cari">cari</button>

    <img src="gif/Running heart.gif" alt="gif" class="loader">
    </form>
    <br>
    <!-- navigasi -->
    <!-- <table border="1" cellpadding="10" cellspacing="0"> -->

    <?php if( $halamanAktif > 1 ) : ?>
    <a href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
    <?php endif; ?>

    <?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
        <?php if($i == $halamanAktif ) : ?>
        <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color: red;"><?= $i; ?></a>
        <?php else : ?>
        <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if( $halamanAktif < $jumlahHalaman ) : ?>
    <a href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
    <?php endif; ?>

    <br>
    
    <div id="container">

    <table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>no.</th>
        <th>Aksi</th>
        <th>Gambar</th>
        <th>No siswa</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Jurusan</th>
    </tr>
    <?php $i = 1; ?>

    <?php foreach($mahasiswa as $row) : ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id']; ?>">edit</a> |
            <a href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('yakin di hapus?');">hapus</a>
        </td>
        <!-- <td><img src="img/poto aldo.jpg" alt="poto aldo" width="50"></td> -->
        <td><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
        <td><?= $row["noSiswa"]; ?></td>
        <td><?= $row["nama"]; ?></td>
        <td><?= $row["email"]; ?></td>
        <td><?= $row["jurusan"]; ?></td>
    </tr>
    <?php $i++; ?>

    <?php endforeach; ?>

    </table>
    </div>
    <!-- java script library jquary -->
    <script src="js/jquery-3.7.1.min.js"></script>
    <!-- java script -->
    <script src="js/script.js"></script>
</body>
</html>