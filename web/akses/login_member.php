<?php
session_start();
include "../../kasir/main/inc/koneksi.php";
if (isset($_POST['button_login'])) {
	$hp					= $_POST['hp'];
	$password_digunakan	= $_POST['password'];
	/*$query_cek_user="SELECT * FROM tabel_member WHERE hp='".$hp."' AND stt_user='active'";*/
	$query_cek_user = "SELECT * FROM tabel_member WHERE hp='" . $hp . "' AND stt_user = 'active'";
	$cek_user = mysqli_query($koneksi, $query_cek_user);
	$count = mysqli_num_rows($cek_user);
	if ($count > 0) {
		$user = mysqli_fetch_array($cek_user);
		$hp					= $user['hp'];
		$nm_user			= $user['nm_user'];
		$status				= $user['stt_user'];
		$password_database	= $user['password'];
		if ($password_database == md5($password_digunakan)) {
			$_SESSION['hp']				= $hp;
			$_SESSION['nm_user']		= $nm_user;
			$_SESSION['stt_user']		= 'active';
			$log 						= date("H:i d M Y");
			$_SESSION['nm_user'] 		= $nm_user;
			$sql_online = mysqli_query($koneksi, "UPDATE `tabel_member` SET `on`=1, `log`='$log' WHERE hp='$hp'");
			/*header('location:../?menu=home');*/
			echo "<script>document.location.href='../?menu=home';</script>";
		} else {
			header('location:cek_login.php');
		}
	} else {
		header('location:cek_login.php');
	}
} else {
	header('location:cek_login.php');
}
/*else {
	echo "<script>document.location.href='cek_login.php';</script>";}}}*/
