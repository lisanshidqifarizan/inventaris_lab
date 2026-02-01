<?php require './barang/read.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Barang</title>
</head>
<body>

    <h2>Manajemen Barang</h2>

    <a href="dashboard.php">⬅ Kembali</a>
    <hr>

    <form action="barang/create.php" method="POST">
        <input
            type="text"
            name="kode_barang"
            placeholder="Kode Barang (LAB-KOM-009)"
            required
        >

        <input
            type="text"
            name="nama_barang"
            placeholder="Nama Barang"
            required
        >

        <input
            type="number"
            name="stok"
            placeholder="Jumlah"
            required
        >

        <select name="kondisi">
            <option value="Baik">Baik</option>
            <option value="Rusak Ringan">Rusak Ringan</option>
            <option value="Rusak Berat">Rusak Berat</option>
        </select>

        <button type="submit">Tambah Barang</button>
    </form>


    <br>

    <table border="1" cellpadding="8">
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Jumlah</th>
            <th>Kondisi</th>
            <th>Aksi</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= htmlspecialchars($row['kode_barang']) ?></td>
            <td><?= htmlspecialchars($row['nama_barang']) ?></td>
            <td><?= $row['stok'] ?></td>
            <td><?= $row['kondisi'] ?></td>
            <td>
                <a href="barang/update.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="barang/delete.php?id=<?= $row['id'] ?>"
                onclick="return confirm('Hapus data?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>