<?php
require_once __DIR__ . "/../config/database.php";

$id = $_GET["id"];

$query = "DELETE FROM barang WHERE id=$id";

if (mysqli_query($conn, $query)) {
    header("Location: ../dashboard.php");
} else {
    echo "Gagal hapus data";
}
