<?php
session_start();
include('../inc/koneksi.php');
$kd_toko            = $_SESSION['kd_toko'];
if (isset($_POST['button_login'])) {
    $id_user            = $_POST['id_user'];
    $password_digunakan    = $_POST['password'];
    $query_cek_user        = "SELECT*FROM tabel_user WHERE id_user='" . $id_user . "' AND kd_toko='" . $kd_toko . "'";
    $cek_user            = mysqli_query($koneksi, $query_cek_user);
    $count                = mysqli_num_rows($cek_user);
    if ($count > 0) {
        $user                = mysqli_fetch_array($cek_user);
        $id_user            = $user['id_user'];
        $nm_user            = $user['nm_user'];
        $status                = $user['akses'];
        $password_database    = $user['password'];
        if ($password_database    == md5($password_digunakan)) {
            $_SESSION['id_user']        = $id_user;
            $_SESSION['nm_user']        = $nm_user;
            $_SESSION['status_user']    = $status;
            header('location:../?menu=home');
        } else {
            header('location:login_user.php');
        }
    } else {
        header('location:login_user.php');
    }
} else {
    header('location:login_user.php');
}
