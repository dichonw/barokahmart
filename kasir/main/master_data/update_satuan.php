<?php
include('../inc/koneksi.php');
if(isset($_POST['button_update'])){
$kd_sat=$_POST['kd_update'];
$nm_sat=$_POST['nm_update'];
$query_update="UPDATE tabel_satuan_barang SET nm_satuan= '".$nm_sat."' WHERE kd_satuan='".$kd_sat."'";	
$update=mysqli_query($koneksi, $query_update);
if($update){
header("location:../index.php?menu=satuan&stt=sukses");}
else{
header("location:../index.php?menu=satuan&stt=gagal");}}
?>