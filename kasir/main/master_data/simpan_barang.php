<?php
include('../inc/koneksi.php');
if(isset($_POST['button_tambah'])){ 
$kd_barang		=$_POST['kd_barang'];
$nm_barang		=$_POST['nm_barang'];
$satuan			=$_POST['satuan'];
$kategori		=$_POST['kategori'];
$deskripsi		=$_POST['deskripsi'];
$hrg_jual		=$_POST['hrg_jual'];
$hrg_grosir		=$_POST['hrg_grosir'];
$hrg_beli		=$_POST['hrg_beli'];
$kd_toko		=$_POST['kd_toko'];
$stok			=$_POST['stok'];
$sql1="INSERT INTO tabel_barang (kd_barang,nm_barang,kd_satuan,kd_kategori,deskripsi,hrg_jual,hrg_grosir,hrg_beli,diskon,hrg_jual_disk)
VALUES ('".$kd_barang."','".$nm_barang."','".$satuan."','".$kategori."','".$deskripsi."','".$hrg_jual."','".$hrg_grosir."','".$hrg_beli."','".$diskon."','".$hrg_jual_disk."')";
$sql2 = "INSERT INTO tabel_stok_toko VALUES('','$kd_toko','$kd_barang','$stok')";
$insert1=mysqli_query($koneksi, $sql1);
$insert2=mysqli_query($koneksi, $sql2); 

if($insert1){
	header("location:../index.php?menu=barang&stt=sukses");}
	else{
	header("location:../index.php?menu=barang&stt=gagal");}
	if($insert2){
	header("location:../index.php?menu=barang&stt=sukses");}
	else{
	header("location:../index.php?menu=barang&stt=gagal");}
}


?>