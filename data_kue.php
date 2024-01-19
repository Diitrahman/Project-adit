<?php
include 'koneksi1.php';
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:login_admin.php');
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == "edit") {
        $result = mysqli_query($koneksi, "SELECT * FROM kue WHERE kode_kue='$_GET[kode_kue]'");
        while ($data = mysqli_fetch_array($result)) {
            $nama_kue = $data['nama_kue'];
            $harga_kue = $data['harga_kue'];
            $stok = $data['stok'];
            $foto = $data['foto'];
        }
    } elseif ($_GET['aksi'] == "hapus") {
        $hapus = mysqli_query($koneksi, "DELETE FROM kue WHERE kode_kue='$_GET[kode_kue]'");
        if ($hapus) {
            header("Location:data_kue.php");
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kue</title>
    <link rel="stylesheet" href="css/table.css">
    <a href="tambah_pengguna.php">Atur Data Pengguna</a><br>
    <a href="mkk3.php">Kembali ke Home</a>

</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <table width="25%" border=0>
            <tr>
                <td> Nama kue</td>
                <td><input type="text" name="nama_kue" value="<?=@$nama_kue?>"></td>
            </tr>
            <tr>
                <td>Harga</td>
                <td><input type="text" name="harga_kue" value="<?=@$harga_kue?>"></td>
            </tr>
            <tr>
                <td>Stok</td>
                <td><input type="text" name="stok" value="<?=@$stok?>"></td>
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
    <table class="table table-bordered border-primary">
        <thead>
            <tr>
                <h2>Data Produk</h2>
                <th>No</th>
                <th>Name</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'koneksi1.php';
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM kue");
            while($data=mysqli_fetch_array($query)){
                $kode_kue = $data['kode_kue'];
                echo "<tr>";
                echo "<td>".$no; $no++."</td>";
                echo "<td>".$data['nama_kue']."</td>";
                echo "<td>".$data['harga_kue']."</td>";
                echo "<td>".$data['stok']."</td>";
                echo "<td style ='padding: 5px;'><img src='Images/".$data['foto']."'style='height: 160px'></td>";

                ?>
                <td> <a href='data_kue.php?aksi=edit&kode_kue=<?=$kode_kue?>'>Edit</a>
                    <a href='data_kue.php?aksi=hapus&kode_kue=<?=$kode_kue?>'>Hapus</a>
                </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php
    include 'koneksi1.php';
    if (isset($_POST['submit'])) {
        if (($_GET['aksi'] == 'edit')) {
            $kode_kue = $_GET['kode_kue'];
            $nama_kue = $_POST['nama_kue'];
            $harga_kue = $_POST['harga_kue'];
            $stok = $_POST['stok'];
            $foto = $_FILES['foto']['name'];
            $ekstensi1 = array('png', 'jpg', 'jpeg','webp');
            $x = explode('.', $foto);
            $ekstensi = strtolower(end($x));
            $file_tmp = $_FILES['foto']['tmp_name'];
            if (in_array($ekstensi, $ekstensi1) === true) {
                move_uploaded_file($file_tmp, 'Images/'.$foto);
            } else {
                echo "<script> alert('Ekstensi tidak diperbolehkan')</script>";
            }
            $edit = mysqli_query($koneksi, "UPDATE kue set nama_kue='$nama_kue',harga_kue='$harga_kue',foto='$foto' where kode_kue='$kode_kue'");
            if ($edit > 0) {
                header("Location:data_kue.php");
            }
        }else{
            $nama_kue = $_POST['nama_kue'];
            $harga_kue = $_POST['harga_kue'];
            $stok = $_POST['stok'];
            $foto = $_FILES['foto']['name'];
            $file_tmp = $_FILES['foto']['tmp_name'];
            move_uploaded_file($file_tmp, 'Images/' . $foto);
            $result = mysqli_query($koneksi, "INSERT INTO kue(nama_kue,harga_kue,foto) VALUES('$nama_kue','$harga_kue','$foto')");
            if ($result > 0) {
                header("Location:data_kue.php");
            }
        }

    }
    ?>
</body>
</html>