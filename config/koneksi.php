<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "notes_app";

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("koneksi gagal: " . mysqli_connect_error());
}
?>
