<?php
session_start();
require_once __DIR__ . "/config/database.php";

// ambil data barang
$query = "SELECT nama_barang, stok, kondisi FROM barang ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home | Inventaris Lab</title>
</head>
<body>

<?php include './layout/header.php'; ?>

<main>
    <h2>Daftar Barang Inventaris</h2>

    <?php if (mysqli_num_rows($result) === 0): ?>
        <p>Belum ada data barang.</p>
    <?php else: ?>
        <table border="1" cellpadding="8">
            <tr>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Kondisi</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                <td><?= $row['stok'] ?></td>
                <td><?= $row['kondisi'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php endif; ?>
</main>

<?php include './layout/footer.php'; ?>

</body>
</html>

