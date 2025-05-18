<?php
// config.php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "forum_diskusi";

// Buat koneksi
$conn = new mysqli($host, $user, $pass, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset
$conn->set_charset("utf8mb4");
?>