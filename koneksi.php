<?php
$host = 'localhost';
$user = 'root';
$pass = '';              // XAMPP default kosong
$db   = 'indica_db';

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>