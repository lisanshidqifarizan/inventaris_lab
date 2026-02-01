<?php
require_once __DIR__ . "/../config/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $kode   = $_POST["kode_barang"];
    $nama   = $_POST["nama_barang"];
    $stok   = $_POST["stok"];
    $kondisi = $_POST["kondisi"];

    // cek kode barang unik
    $cek = mysqli_query($conn, "SELECT id FROM barang WHERE kode_barang='$kode'");
    if (mysqli_num_rows($cek) > 0) {
        die("Kode barang sudah digunakan");
    }

    $query = "INSERT INTO barang (kode_barang, nama_barang, stok, kondisi)
              VALUES ('$kode', '$nama', '$stok', '$kondisi')";

    if (mysqli_query($conn, $query)) {
        header("Location: ../dashboard.php?page=barang");
        exit;
    } else {
        die("ERROR MYSQL: " . mysqli_error($conn));
    }
}
