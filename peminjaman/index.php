<?php
require_once __DIR__ . '/../config/database.php';

$result = mysqli_query($conn, "
    SELECT 
        p.id,
        u.nama AS peminjam,
        b.nama_barang,
        p.jumlah,
        p.tanggal_pinjam,
        p.tanggal_kembali,
        p.status
    FROM peminjaman p
    JOIN pengguna u ON p.pengguna_id = u.id
    JOIN barang b ON p.barang_id = b.id
    ORDER BY p.created_at DESC
");

$users = mysqli_query(
    $conn,
    "SELECT id, nama FROM pengguna WHERE role = 'mahasiswa'"
);

$barang = mysqli_query(
    $conn,
    "SELECT id, nama_barang, stok FROM barang WHERE stok > 0"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Peminjaman</title>
</head>
<body>

<h2>Manajemen Peminjaman</h2>

<a href="dashboard.php">⬅ Kembali</a>
<hr>

<form action="peminjaman/create.php" method="POST">

    <label>Peminjam</label><br>
    <select name="pengguna_id" required>
        <option value="">-- Pilih Peminjam --</option>
        <?php while ($u = mysqli_fetch_assoc($users)) : ?>
            <option value="<?= $u['id'] ?>">
                <?= htmlspecialchars($u['nama']) ?>
            </option>
        <?php endwhile; ?>
    </select>
    <br><br>

    <label>Barang</label><br>
    <select name="barang_id" required>
        <option value="">-- Pilih Barang --</option>
        <?php while ($b = mysqli_fetch_assoc($barang)) : ?>
            <option value="<?= $b['id'] ?>">
                <?= htmlspecialchars($b['nama_barang']) ?> (stok <?= $b['stok'] ?>)
            </option>
        <?php endwhile; ?>
    </select>
    <br><br>

    <label>Jumlah</label><br>
    <input type="number" name="jumlah" min="1" required>
    <br><br>

    <!-- ❌ TANGGAL PINJAM DIHILANGKAN -->

    <label>Tanggal Kembali</label><br>
    <input type="date" name="tanggal_kembali">
    <br><br>

    <label>Catatan</label><br>
    <input type="text" name="catatan" placeholder="Opsional">
    <br><br>

    <button type="submit">Tambah Peminjaman</button>
</form>

<br>

<!-- =======================
     TABEL DATA PEMINJAMAN
     ======================= -->
<h1>Riwayat & Status:</h1>
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Peminjam</th>
        <th>Barang</th>
        <th>Jumlah</th>
        <th>Tgl Pinjam</th>
        <th>Tgl Kembali</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php if (mysqli_num_rows($result) > 0) : ?>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= htmlspecialchars($row['peminjam']) ?></td>
            <td><?= htmlspecialchars($row['nama_barang']) ?></td>
            <td><?= $row['jumlah'] ?></td>
            <td><?= $row['tanggal_pinjam'] ?></td>
            <td><?= $row['tanggal_kembali'] ?: '-' ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                <a href="peminjaman/update.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="peminjaman/delete.php?id=<?= $row['id'] ?>"
                   onclick="return confirm('Yakin hapus data peminjaman?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    <?php else : ?>
        <tr>
            <td colspan="7" align="center">Belum ada data peminjaman</td>
        </tr>
    <?php endif; ?>
</table>

</body>
</html>