<?php
session_start();
require_once __DIR__ . '/../config/database.php';

// proteksi role
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['admin','petugas'])) {
    die("Akses ditolak");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $nim      = mysqli_real_escape_string($conn, $_POST['nim']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $role     = mysqli_real_escape_string($conn, $_POST['role']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO pengguna (nama, nim, email, password, role)
              VALUES ('$nama', '$nim', '$email', '$password', '$role')";

    if (mysqli_query($conn, $query)) {
        header("Location: ../pengguna.php");
        exit;
    } else {
        die("ERROR CREATE USER: " . mysqli_error($conn));
    }
}
