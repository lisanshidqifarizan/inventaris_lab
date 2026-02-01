<?php
require_once __DIR__ . "/../config/database.php";

$id = $_GET["id"] ?? null;

if (!$id) {
    die("ID tidak ditemukan");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama    = $_POST["nama_barang"];
    $stok    = $_POST["stok"];
    $kondisi = $_POST["kondisi"];

    $query = "UPDATE barang SET
              nama_barang = '$nama',
              stok = '$stok',
              kondisi = '$kondisi'
              WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        header("Location: ../dashboard.php");
        exit;
    } else {
        die("Gagal update data");
    }
}

$data = mysqli_query($conn, "SELECT * FROM barang WHERE id = $id");
$barang = mysqli_fetch_assoc($data);

if (!$barang) {
    die("Data tidak ditemukan");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
</head>
<body>
    <h1>Edit Barang | Inventaris Lab</h1>

    <form method="POST">
        <input
            type="text"
            name="nama_barang"
            value="<?= htmlspecialchars($barang['nama_barang']) ?>"
            required
        >

        <input
            type="number"
            name="stok"
            value="<?= $barang['stok'] ?>"
            required
        >

        <select name="kondisi">
            <?php
            $kondisiList = [
                "Baik",
                "Rusak Ringan",
                "Rusak Berat",
                "Dipinjam",
                "Tidak Tersedia"
            ];
            foreach ($kondisiList as $k) :
            ?>
                <option value="<?= $k ?>"
                    <?= $barang['kondisi'] === $k ? 'selected' : '' ?>>
                    <?= $k ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Simpan</button>
        <a href="../dashboard.php">Batal</a>
    </form>
</body>
</html>
