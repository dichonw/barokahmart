<?php
session_start();
include('../inc/koneksi.php');
$kd_toko	=$_SESSION['kd_toko'];
$no_faktur	=$_GET['no_faktur'];
$query_get_rinci_retur="SELECT tabel_rinci_retur.*, tabel_retur.no_faktur_retur FROM tabel_rinci_retur, tabel_retur WHERE tabel_rinci_retur.no_faktur_retur=tabel_retur.no_faktur_retur AND tabel_retur.no_faktur_retur='".$no_faktur."'";
$get_rinci_retur=mysqli_query($koneksi, $query_get_rinci_retur);
while($rinci_retur=mysqli_fetch_array($get_rinci_retur)){
$kd_barang	=$rinci_retur['kd_barang'];
$jml		=$rinci_retur['jumlah'];
$query_get_stok="SELECT * FROM tabel_stok_toko WHERE kd_barang='".$kd_barang."' AND kd_toko='".$kd_toko."'";
$get_stok	=mysqli_query($koneksi, $query_get_stok);
$hitung_record_stok=mysqli_num_rows($get_stok);
if($hitung_record_stok>0){
$stok=mysqli_fetch_array($get_stok);
$jml_stok	=$stok['stok'];
$stok_baru	=$jml_stok-$jml;
$query_update_stok="UPDATE tabel_stok_toko SET stok='".$stok_baru."' WHERE kd_barang='".$kd_barang."' AND kd_toko='".$kd_toko."'";
$update_stok=mysqli_query($koneksi, $query_update_stok);}
else{
$query_insert_stok="INSERT INTO tabel_stok_toko (kd_toko,kd_barang,stok) VALUES ('".$kd_toko."','".$kd_barang."','".$jml."')";
$insert_stok=mysqli_query($koneksi, $query_insert_stok);} }
if($update_stok||$insert_stok){
header("location:../?menu=retur")
//header("location:?menu=faktur_retur_supplier&no_faktur=".$no_faktur."")
/*echo "<script language='JavaScript'>document.location='?menu=retur_faktur&no_faktur='".$no_faktur."''</script>"*/
/*echo "<script language='JavaScript'>document.location='?menu=suplier'</script>"*/
;}
