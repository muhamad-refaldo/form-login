<?php 

// $conn = mysqli_connect("localhost","root","","phpdasar");

require 'functions.php';

if(isset($_POST["register"]) ) {

    if(registrasi($_POST) > 0) {
        echo "<script>
                alert('user baru di tambahkan');
            </script>";  
    } else {
        echo mysqli_error($conn);
    }

}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>halaman registrasi</title>
    <link rel="stylesheet" href="css/registrasi.css">
</head>
<body>
    <h1>halaman registrasi</h1>    
    
    <form action="" method="post">
    <ul>
        <li>
            <label for="username">username ⭐</label>
            <input type="text" name="username" id="username" required>
        </li>
        <li>
            <label for="password">password ⭐</label>
            <input type="password" name="password" id="password" required>
        </li>
        <li>
            <label for="password2">konfirmasi password ⭐</label>
            <input type="password" name="password2" id="password2" required>
        </li>
        <li>
            <button type="submit" name="register" style="cursor: pointer;">Register</button>
        </li>
        <li>
        <a href="login.php">login</a>
        </li>
    </ul>
    </form>


</body>
</html>