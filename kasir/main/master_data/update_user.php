<?php
include('../inc/koneksi.php');
if(isset($_POST['button_update'])){
$id_update=$_POST['id_update'];
$nm_update=$_POST['nm_update'];
$pass_update=$_POST['pass_update'];
$akses_update=$_POST['akses_update'];
$kd_toko_update=$_POST['kd_toko_update'];
$query_update="UPDATE tabel_user SET nm_user='".$nm_update."',password=md5('".$pass_update."'),akses='".$akses_update."',kd_toko='".$kd_toko_update."' WHERE id_user='".$id_update."'";
$update=mysqli_query($koneksi, $query_update);
if($update){
header("location:../index.php?menu=user&stt=sukses");}
else{
header("location:../index.php?menu=user&stt=gagal");}
}
?>