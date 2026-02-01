<?php require './pengguna/read.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Pengguna</title>
</head>
<body>

<h2>Manajemen Pengguna</h2>

<a href="dashboard.php">⬅ Kembali</a>
<hr>

<form action="pengguna/create.php" method="POST">
    <input type="text" name="nama" placeholder="Nama" required><br><br>
    <input type="text" name="nim" placeholder="NIM / NIP" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>

    <select name="role">
        <option value="mahasiswa">Mahasiswa</option>
        <option value="petugas">Petugas</option>
    </select><br><br>

    <button type="submit">Tambah Pengguna</button>
</form>


<br><br>
<table border="1" cellpadding="8">
    <tr>
        <th>Nama</th>
        <th>NIM / NIP</th>
        <th>Email</th>
        <th>Role</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
    <tr>
        <td><?= htmlspecialchars($row['nama']) ?></td>
        <td><?= $row['nim'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['role'] ?></td>
        <td>
            <a href="pengguna/update.php?id=<?= $row['id'] ?>">Edit</a> |
            <a href="pengguna/delete.php?id=<?= $row['id'] ?>"
               onclick="return confirm('Hapus pengguna?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
