<?php 
require "../functions.php";

$keayword = $_GET["keayword"];
$query = "SELECT * FROM mahasiswa
                WHERE
        nama LIKE '%$keayword%' OR
        noSiswa LIKE '%$keayword%' OR
        email LIKE '%$keayword%' OR
        jurusan LIKE '%$keayword%'
";
$mahasiswa = query($query);

?>

<table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>no.</th>
        <th>Aksi</th>
        <th>Gambar</th>
        <th>no siswa</th>
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