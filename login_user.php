<?php
   include 'koneksi.php';
   session_start();
   if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if($username!="" && $password!=""){
        $mysqli=mysqli_query($koneksi,"SELECT * FROM adit WHERE username = '$username' AND password = '$password' ");
        if($data = mysqli_fetch_array($mysqli)){
            $_SESSION['username']=$data['username'];
            $_SESSION['password']=$data['password'];
            header("Location:index.php");
        }
    }else{
        header("Location:login_user.php");
    }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login3.css">
    <title>Login Form</title>
</head>
<body>
    <div class="login-container">
        <h2>Cake Store</h2>
        <form action="" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            
            <button type="login" name="login" value="login">Login</button>
            <br>
            <a>Or</a>
            <br>
            <a href="mkkdaftar.php">Sign up</a>
            <br>
            <div class="col-12 py-4">
               &copy; Copyright 2023
            </div>
        </form>
    </div>
</body>
</html>