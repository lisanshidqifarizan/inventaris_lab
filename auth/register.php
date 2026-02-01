<?php
require_once __DIR__ . "/config/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $nim      = mysqli_real_escape_string($conn, $_POST['nim']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = 'mahasiswa';

    $query = "INSERT INTO pengguna (nama, nim, email, password, role)
              VALUES ('$nama', '$nim', '$email', '$password', '$role')";

    if (mysqli_query($conn, $query)) {
        header("Location: login.php");
        exit;
    } else {
        die("ERROR REGISTER: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | Inventaris Lab</title>
</head>
<body>

<h1>Register</h1>

<form method="POST">
    <input type="text" name="nama" placeholder="Nama Lengkap" required><br><br>
    <input type="text" name="nim" placeholder="NIM / NIP" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>

    <button type="submit">Register</button>
</form>

<a href="login.php">Sudah punya akun? Login</a>

</body>
</html>
