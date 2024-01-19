<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location:login_user.php');
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Checkout</title>
    <style>
        /* CSS untuk styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            background-image: url('Backgroundco.jpg');
            color:#fff;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 20px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* CSS untuk pesan error */
        .error-message {
            color: black;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <?php
        include 'koneksi1.php';
        $query = "SELECT * FROM kue WHERE kode_kue='$_GET[id]'";
        $result = mysqli_query($koneksi, $query);
        $data = mysqli_fetch_array($result);

        include 'koneksi.php';
        $user = mysqli_query($koneksi, "SELECT * FROM adit WHERE username = '$_SESSION[username]'");
        $person = mysqli_fetch_array($user);

    ?>
    <div class="container">
        <h1>Form Checkout</h1>
        <form id="checkout-form">
            <label for="nama">Nama kue:</label>
            <input type="text" id="nama_kue" name="nama_kue" value="<?=$data['nama_kue']?>" required>
            <div class="error-message" id="Nama Kue-error"></div>

            <label for="nama">Nama:</label>
            <input type="text" id="username" name="username" value="<?=$_SESSION['username'];?>" required>
            <div class="error-message" id="username-error"></div>

            <label for="alamat">Alamat:</label>
            <textarea id="alamat" name="alamat" required></textarea>
            <div class="error-message" id="alamat-error"></div>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <div class="error-message" id="email-error"></div>

            <label for="nomor_telepon">Nomor Telepon:</label>
            <input type="tel" id="nomor_telepon" name="nomor_telepon" required>
            <div class="error-message" id="nomor-telepon-error"></div>

            <label for="metode_pembayaran">Metode Pembayaran:</label>
            <select id="metode_pembayaran" name="metode_pembayaran" required>
                <option value="debit">Debit</option>
                <option value="kredit">Kredit</option>
                <option value="transfer">Transfer Bank</option>
            </select>
            <div class="error-message" id="metode-pembayaran-error"></div>

            <a href="cetak.php"><input type="submit" value="Checkout"></a>
        </form>
    </div>

    <script>
        // JavaScript untuk validasi
        const form = document.getElementById('checkout-form');

        form.addEventListener('submit', function(event) {
            let isValid = true;

            // Validasi Nama
            const nama = document.getElementById('nama');
            const namaError = document.getElementById('nama-error');
            if (nama.value.trim() === '') {
                isValid = false;
                namaError.textContent = 'Nama harus diisi.';
            } else {
                namaError.textContent = '';
            }

            // Validasi Alamat
            const alamat = document.getElementById('alamat');
            const alamatError = document.getElementById('alamat-error');
            if (alamat.value.trim() === '') {
                isValid = false;
                alamatError.textContent = 'Alamat harus diisi.';
            } else {
                alamatError.textContent = '';
            }

            // Validasi Email
            const email = document.getElementById('email');
            const emailError = document.getElementById('email-error');
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email.value)) {
                isValid = false;
                emailError.textContent = 'Email tidak valid.';
            } else {
                emailError.textContent = '';
            }

            // Validasi Nomor Telepon
            const nomorTelepon = document.getElementById('nomor_telepon');
            const nomorTeleponError = document.getElementById('nomor-telepon-error');
            const nomorTeleponPattern = /^\d{10}$/;
            if (!nomorTeleponPattern.test(nomorTelepon.value)) {
                isValid = false;
                nomorTeleponError.textContent = 'Nomor Telepon harus terdiri dari 10 digit angka.';
            } else {
                nomorTeleponError.textContent = '';
            }

            // Validasi Metode Pembayaran
            const metodePembayaran = document.getElementById('metode_pembayaran');
            const metodePembayaranError = document.getElementById('metode-pembayaran-error');
            if (metodePembayaran.value === '') {
                isValid = false;
                metodePembayaranError.textContent = 'Pilih metode pembayaran.';
            } else {
                metodePembayaranError.textContent = '';
            }

            // Hentikan pengiriman form jika tidak valid
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>