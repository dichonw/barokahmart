<?php
include('../inc/koneksi.php');
if(isset($_POST['button_tambah'])){
$kd_supplier	=$_POST['kd_supplier'];	
$nm_supplier	=$_POST['nm_supplier'];
$alamat			=$_POST['alamat'];
$telepon		=$_POST['telepon'];
$fax			=$_POST['fax'];
$query_insert="INSERT INTO tabel_supplier(kd_supplier,nm_supplier,almt_supplier,tlp_supplier,fax_supplier,atas_nama)
VALUES('".$kd_supplier."','".$nm_supplier."','".$alamat."','".$telepon."','".$fax."','supplier')";
$insert=mysqli_query($koneksi, $query_insert);
if($insert){
header("location:../?menu=data_sup&stt=sukses");}
else{
header("location:../?menu=data_sup&stt=gagal");}}
?>