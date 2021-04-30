<?php
include('../inc/koneksi.php');
if(isset($_GET['kd_kategori'])){
$kd_kategori=$_GET['kd_kategori'];
$query_delete="DELETE FROM tabel_kategori_barang WHERE kd_kategori='".$kd_kategori."'";	
$delete=mysqli_query($koneksi, $query_delete);
if($delete){
header("location:../index.php?menu=kategori&stt=sukses");}
else{
header("location:../index.php?menu=kategoristt=gagal");}}
?>
