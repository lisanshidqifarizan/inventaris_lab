<?php
require_once __DIR__ . '/../config/database.php';

$query = "SELECT * FROM barang ORDER BY id DESC";
$result = mysqli_query($conn, $query);
