<?php
require_once __DIR__ . '/../config/database.php';

$id = $_GET['id'] ?? null;
if (!$id) die("ID tidak valid");

if (mysqli_query($conn, "DELETE FROM pengguna WHERE id=$id")) {
    header("Location: ../pengguna.php");
} else {
    die(mysqli_error($conn));
}
