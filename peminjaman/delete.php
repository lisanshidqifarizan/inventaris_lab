<?php
require_once __DIR__ . '/../config/database.php';

$id = $_GET['id'] ?? 0;

$data = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM peminjaman WHERE id=$id")
);

if (!$data) {
    die("Data tidak ditemukan");
}

if ($data['status'] === 'Dipinjam') {
    mysqli_query($conn, "
        UPDATE barang 
        SET stok = stok + {$data['jumlah']}
        WHERE id = {$data['barang_id']}
    ");
}

mysqli_query($conn, "DELETE FROM peminjaman WHERE id=$id");

header("Location: ../dashboard.php?page=peminjaman");
exit;
