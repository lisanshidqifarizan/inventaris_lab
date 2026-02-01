<?php
require_once __DIR__ . "/../config/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama    = $_POST["nama_barang"];
    $stok    = $_POST["stok"];
    $kondisi = $_POST["kondisi"];

    $query = "INSERT INTO barang (nama_barang, stok, kondisi)
              VALUES ('$nama', '$stok', '$kondisi')";

    if (mysqli_query($conn, $query)) {
        header("Location: ../dashboard.php");
        exit;
    } else {
        die("ERROR MYSQL: " . mysqli_error($conn));
    }
}
