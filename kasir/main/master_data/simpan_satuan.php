<?php
include('../inc/koneksi.php');
if(isset($_POST['button_tambah'])){
$kd_satuan=$_POST['kd_satuan'];
$nm_satuan=$_POST['nm_satuan'];
$query_insert="INSERT INTO tabel_satuan_barang(kd_satuan,nm_satuan) VALUES('".$kd_satuan."','".$nm_satuan."')";
$insert=mysqli_query($koneksi, $query_insert);
if($insert){
header("location:../index.php?menu=satuan&stt=sukses");}
else{
header("location:../index.php?menu=satuan&stt=gagal");} }
?>