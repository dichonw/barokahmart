<?php
include('../inc/koneksi.php');
if(isset($_GET['kd_supplier'])){
$kd_supplier=$_GET['kd_supplier'];	
$query_delete="DELETE FROM tabel_supplier WHERE kd_supplier='".$kd_supplier."'";
$delete=mysqli_query($koneksi, $query_delete);
if($delete){
header("location:../?menu=data_sup&stt=sukses");}
else{
header("location:../?menu=data_sup&stt=gagal");}}
?>