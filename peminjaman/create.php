<?php
require_once __DIR__ . '/../config/database.php';

$users  = mysqli_query($conn, "SELECT id, nama FROM pengguna WHERE role='mahasiswa'");
$barang = mysqli_query($conn, "SELECT id, nama_barang, stok FROM barang WHERE stok > 0");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pengguna_id = $_POST['pengguna_id'];
    $barang_id   = $_POST['barang_id'];
    $jumlah      = $_POST['jumlah'];
    $tgl_pinjam  = date('Y-m-d'); // ✅ AUTO DATE BACKEND
    $tgl_kembali = $_POST['tanggal_kembali'] ?? null;
    $catatan     = $_POST['catatan'] ?? '';

    // cek stok
    $cek = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT stok FROM barang WHERE id = $barang_id")
    );

    if ($jumlah > $cek['stok']) {
        die("Stok tidak mencukupi");
    }

    mysqli_query($conn, "
        INSERT INTO peminjaman
        (pengguna_id, barang_id, jumlah, tanggal_pinjam, tanggal_kembali, status, catatan)
        VALUES
        ('$pengguna_id', '$barang_id', '$jumlah', '$tgl_pinjam', '$tgl_kembali', 'Dipinjam', '$catatan')
    ");

    mysqli_query($conn, "
        UPDATE barang SET stok = stok - $jumlah WHERE id = $barang_id
    ");

    header("Location: ../dashboard.php?page=peminjaman");
    exit;
}
