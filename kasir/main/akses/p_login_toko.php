<?php
session_start();
include('../inc/koneksi.php');
if (isset($_POST['button_login'])) {
    $kd_toko = $_POST['kd_toko'];
    $password_digunakan = $_POST['password'];
    $query_cek_toko = "SELECT * FROM tabel_toko WHERE kd_toko='" . $kd_toko . "'";
    $cek_toko = mysqli_query($koneksi, $query_cek_toko);
    $count = mysqli_num_rows($cek_toko);
    if ($count > 0) {
        $toko = mysqli_fetch_array($cek_toko);
        $kd_toko = $toko['kd_toko'];
        $status = $toko['status'];
        $password_database = $toko['password'];
        if ($password_database == md5($password_digunakan)) {
            $_SESSION['kd_toko'] = $kd_toko;
            $_SESSION['status_toko'] = $status;
            header('location:login_user.php');
        } else {
            header('location:login_toko.php');
        }
    } else {
        header('location:login_toko.php');
    }
} else {
    header('location:login_toko.php');
}
