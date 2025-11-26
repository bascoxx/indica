<?php
// logout.php – HARUS ADA session_start() DI ATAS!
session_start();           // <— BARIS INI WAJIB ADA!!
session_destroy();         // hapus semua session
header("Location: login.php");
exit();
?>