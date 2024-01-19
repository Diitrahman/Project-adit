<?php

include 'koneksi.php';
if(isset($_GET['aksi'])){
    //MENAMPILKAN DATA YANG AKAN DIEDIT
    if($_GET['aksi']=="edit"){
        $result = mysqli_query($koneksi,"SELECT * FROM adit WHERE id_pengguna='$_GET[id_pengguna]'");
        while($data = mysqli_fetch_array($result)){
            $nama = $data['nama_pengguna'];
            $uname = $data['username'];
            $pass = $data['password'];
            $foto = $data['foto'];
        }
    }elseif($_GET['aksi']=='hapus'){
        $hapus = mysqli_query($koneksi,"DELETE FROM adit WHERE id_pengguna='$_GET[id_pengguna]'");
        if($hapus){
            header("Location:tambah_pengguna.php");
        }
    }


} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table pengguna</title>
    <link rel="stylesheet" href="css/table.css">
</head>
<body>
    <a href="mkk3.php">Kembali Ke Home</a><br><br>

    <form action="" method="post" enctype="multipart/form-data">
        <table width="25%" border=0>
            <h2><i>Input & Edit Data</i></h2>
            <tr>
                <td>Nama Pengguna</td>
                <td><input type="text" name="nama_pengguna" value="<?=@$nama?>"></td>
            </tr>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" value="<?=@$uname?>"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="text" name="password" value="<?=@$pass?>"></td>
            </tr>
            <tr>
                <td>Foto</td>
                <td><input type="file" name="foto" value="<?=@$foto?>"></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Tambah"></td>
            </tr>
        </table>
    </form>



    <table class="table" border=1 >
        <thead>
            <h2><i>Data Pengguna</i></h2>
            <th>No</th>
            <th>Nama pengguna</th>
            <th>Username</th>
            <th>Password</th>
            <th>Foto</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            <?php
            include 'koneksi.php';
            $no=1;
            $query = mysqli_query($koneksi,"SELECT * FROM adit");
            while($data = mysqli_fetch_array($query)){
                $id_pengguna = $data['id_pengguna'];
                echo "<tr>";
                echo "<td>".$no; $no++."</td>";
                echo "<td>".$data['nama_pengguna']."</td>";
                echo "<td>".$data['username']."</td>";
                echo "<td>".$data['password']."</td>";
                echo "<td><img src='Images/".$data['foto']."' style = 'width: 100px;'></td>";
                
                
            
            ?>
            <td><a href="tambah_pengguna.php?aksi=edit&id_pengguna=<?=$data['id_pengguna']?>">Edit ||</a>
                <a href="tambah_pengguna.php?aksi=hapus&id_pengguna=<?=$data['id_pengguna']?>">Hapus</a>
            </td>
            </tr>
            <?php }
            ?>
        </tbody>
    </table>
    <?php

    include 'koneksi.php';

    if(isset($_POST['submit'])){
        //MENYIMPAN DATA YANG DIEDIT
        if($_GET['aksi']=="edit"){
            $id_pengguna = $_GET['id_pengguna'];
            $nama_pengguna = $_POST['nama_pengguna'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $foto = $_FILES['foto']['name'];
            $ekstensi1 = array('png','jpg','jpeg','webp');
            $x = explode('.',$foto);
            $ekstensi = strtolower(end($x));
            $file_tmp = $_FILES['foto']['tmp_name'];
            if(in_array($ekstensi ,$ekstensi1) === true){
                move_uploaded_file($file_tmp,'Images/'.$foto);
            }else{
                echo "<script> alert('Ekstensi tidak diperbolehkan')</script>";
            }

            $edit = mysqli_query($koneksi,"UPDATE adit set nama_pengguna='$nama_pengguna',username='$username',password='$password',foto='$foto' where id_pengguna='$id_pengguna'");
            if($edit>0){
                header("Location:tambah_pengguna.php");
            }
        }else{
            $nama_pengguna = $_POST['nama_pengguna'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $foto = $_FILES['foto']['name'];
            $ekstensi1 = array('png','jpg','jpeg','webp');
            $x = explode('.',$foto);
            $ekstensi = strtolower(end($x));
            $file_tmp = $_FILES['foto']['tmp_name'];
            if(in_array($ekstensi ,$ekstensi1) === true){
                move_uploaded_file($file_tmp,'Images/'.$foto);
            }else{
                echo "<script> alert('Ekstensi tidak diperbolehkan')</script>";
            }

            $result = mysqli_query($koneksi,"INSERT INTO adit(nama_pengguna,username,password,foto) VALUES ('$nama_pengguna','$username','$password','$foto')");
            if($result > 0){
                header("Location: tambah_pengguna.php");
            }
        }
        
    }

    ?>
</body>
</html>