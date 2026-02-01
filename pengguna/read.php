<?php
require_once __DIR__ . '/../config/database.php';

$result = mysqli_query($conn, "SELECT id, nama, nim, email, role, created_at FROM pengguna ORDER BY id DESC");
