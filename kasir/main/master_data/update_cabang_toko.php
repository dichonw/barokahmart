<?php
include('../inc/koneksi.php');
if(isset($_POST['button_update'])){
$kd_toko	=$_POST['kd_toko_update'];	
$nm_toko	=$_POST['nm_toko_update'];
$alamat		=$_POST['alamat_update'];
$telepon	=$_POST['telepon_update'];
$fax		=$_POST['fax_update'];
$password	=$_POST['password_update'];
$status		=$_POST['status_update'];
$query_update="UPDATE tabel_toko SET nm_toko='".$nm_toko."' ,almt_toko='".$alamat."',tlp_toko='".$telepon."',fax_toko='".$fax."',password=md5('".$password."'),status='".$status."' WHERE kd_toko='".$kd_toko."'";	
$update=mysqli_query($koneksi, $query_update);
if($update){
header("location:../index.php?menu=branch-shop&stt=sukses");}
else{
header("location:../index.php?menu=branch-shop&stt=gagal");}}
?>