<?php
include 'koneksi.php';
if(isset($_POST['daftar'])){
    $nama_pengguna = $_POST['nama_pengguna'];
    $username = $_POST['username'];
    $password = $_POST['password'];

$query = mysqli_query($koneksi,"INSERT INTO adit (nama_pengguna,username,password) values ('$nama_pengguna','$username','$password')");
if($query>0){
    header("Location:login_user.php");
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login2.css">
    <title>Sign up</title>
</head>
<body>
    <div class="login-container">
        <h2>Sign up</h2>
        <form action="mkkdaftar.php" method="post">
            <label for="username">Nama</label>
            <input type="text" id="name" name="nama_pengguna" required>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="daftar" value="daftar">Login</button>
        </form>
    </div>
</body>
</html>