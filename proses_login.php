<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ambil user dari database
    $sql = "SELECT * FROM users WHERE username = ? LIMIT 1";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            // Login sukses
            $_SESSION['login']        = true;
            $_SESSION['id']           = $row['id'];
            $_SESSION['username']     = $row['username'];
            $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
            $_SESSION['role']         = $row['role'];

            // Arahkan sesuai role
            if ($row['role'] == 'admin' || $row['role'] == 'owner') {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: kasir/pos.php");
            }
            exit();
        }
    }
}

// Jika gagal
header("Location: login.php?error=1");
exit();
?>