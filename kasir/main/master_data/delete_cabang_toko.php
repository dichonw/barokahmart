<?php
include('../inc/koneksi.php');
if(isset($_GET['kd_toko'])){
$kd_toko=$_GET['kd_toko'];
$query_delete_user_toko = "DELETE FROM tabel_user WHERE kd_toko='".$kd_toko."'";
$delete_user_toko=mysqli_query($koneksi, $query_delete_user_toko);
$query_delete="DELETE FROM tabel_toko WHERE kd_toko='".$kd_toko."'";	
$delete=mysqli_query($koneksi, $query_delete);
if($delete){
header("location:../index.php?menu=branch-shop&stt=sukses");}
else{
header("location../index.php?menu=branch-shop&stt=gagal");}
}?>