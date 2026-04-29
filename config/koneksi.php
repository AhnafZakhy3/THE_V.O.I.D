<?php
$host = getenv('DB_HOST') ?: "localhost";
$username = getenv('DB_USER') ?: "root";
$password = getenv('DB_PASS') ?: "";
$database = getenv('DB_NAME') ?: "notes_app";

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("koneksi gagal: " . mysqli_connect_error());
}
?>
