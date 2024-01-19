<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Form Registrasi</title>
</head>
<body>
    <div class="container">
        <h1>Form Registrasi</h1>
        <form>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm-password">Konfirmasi Password:</label>
            <input type="password" id="confirm-password" name="confirm-password" required>

            <button type="submit">Daftar</button>
        </form>
    </div>
</body>
</html>
