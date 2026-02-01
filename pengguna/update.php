<?php
require_once __DIR__ . '/../config/database.php';

$id = $_GET['id'] ?? null;
if (!$id) die("ID tidak ditemukan");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = $_POST['nama'];
    $noid  = $_POST['nim'];
    $email = $_POST['email'];
    $role  = $_POST['role'];

    $query = "UPDATE pengguna SET
              nama='$nama',
              nim='$noid',
              email='$email',
              role='$role'
              WHERE id=$id";

    if (mysqli_query($conn, $query)) {
        header("Location: ../pengguna.php");
        exit;
    } else {
        die(mysqli_error($conn));
    }
}

$data = mysqli_query($conn, "SELECT * FROM pengguna WHERE id=$id");
$pengguna = mysqli_fetch_assoc($data);
if (!$pengguna) die("Data tidak ditemukan");
?>
<!DOCTYPE html>
<html>
<body>
<h2>Edit Pengguna</h2>

<form method="POST">
    <input type="text" name="nama" value="<?= htmlspecialchars($pengguna['nama']) ?>" required>
    <input type="text" name="nim" value="<?= $pengguna['nim'] ?>" required>
    <input type="email" name="email" value="<?= $pengguna['email'] ?>" required>

    <select name="role">
        <?php foreach (['petugas','mahasiswa'] as $r): ?>
            <option value="<?= $r ?>" <?= $pengguna['role']===$r?'selected':'' ?>>
                <?= ucfirst($r) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Simpan</button>
</form>
</body>
</html>
