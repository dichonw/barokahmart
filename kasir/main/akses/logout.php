<?php
session_start();
unset($_SESSION['id_user']); unset($_SESSION['akses']);
unset($_SESSION['kd_toko']); unset($_SESSION['status']);
session_destroy(); header('location:login_toko.php');
?>