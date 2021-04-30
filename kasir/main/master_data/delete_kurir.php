<?php
include('../inc/koneksi.php');
if(isset($_GET['kd_kurir'])){
$kd_kurir=$_GET['kd_kurir'];
$query_delete="DELETE FROM tabel_kurir WHERE id_kurir='".$kd_kurir."'";	
$delete=mysqli_query($koneksi, $query_delete);
if($delete){
header("location:../index.php?menu=kategori&stt=sukses");}
else{
header("location:../index.php?menu=kategoristt=gagal");}}
?>
