<?php
require_once __DIR__ . '/../config/database.php';

$id = $_GET['id'] ?? 0;

$data = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM peminjaman WHERE id=$id")
);

if (!$data) {
    die("Data tidak ditemukan");
}

if (isset($_POST['submit'])) {
    $status = $_POST['status'];

    if ($data['status'] === 'Dipinjam' && $status === 'Dikembalikan') {
        mysqli_query($conn, "
            UPDATE barang 
            SET stok = stok + {$data['jumlah']}
            WHERE id = {$data['barang_id']}
        ");
    }

    mysqli_query($conn, "
        UPDATE peminjaman 
        SET status='$status'
        WHERE id=$id
    ");

    header("Location: ../dashboard.php?page=peminjaman");
    exit;
}
?>

<h3>Update Status Peminjaman</h3>

<form method="post">
    <label>Status</label><br>
    <select name="status">
        <option value="Dipinjam" <?= $data['status']=='Dipinjam'?'selected':'' ?>>
            Dipinjam
        </option>
        <option value="Dikembalikan" <?= $data['status']=='Dikembalikan'?'selected':'' ?>>
            Dikembalikan
        </option>
    </select><br><br>

    <button type="submit" name="submit">Update</button>
</form>
