<?php
session_start();

// HARUS LOGIN
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// ROLE CHECK
$role = $_SESSION['user']['role'];
if ($role !== 'admin' && $role !== 'petugas') {
    http_response_code(403);
    echo "Akses ditolak. Anda tidak memiliki izin.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Inventaris Lab</title>
</head>
<body>

<h1>Dashboard Inventaris</h1>
<p>Halo, <strong><?= htmlspecialchars($_SESSION['user']['nama']) ?></strong> (<?= $role ?>)</p>
<p>Pilih menu pengelolaan data:</p>

<div class="menu">
    <a href="?page=barang">Data Barang</a>
    <a href="?page=pengguna">Data Pengguna</a>
    <a href="?page=peminjaman">Peminjaman</a>
</div>

<hr>

<div class="content">
<?php
$page = $_GET['page'] ?? '';

switch ($page) {
    case 'barang':
        require __DIR__ . '/barang/index.php';
        break;

    case 'pengguna':
        require __DIR__ . '/pengguna/index.php';
        break;

    case 'peminjaman':
        require __DIR__ . '/peminjaman/index.php';
        break;

    default:
        echo "<p>Silakan pilih menu di atas.</p>";
}
?>
</div>

</body>
</html>
