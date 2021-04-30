<?php
include('../inc/koneksi.php');
if(isset($_GET['no_faktur_penjualan'])){
$faktur	=$_GET['no_faktur_penjualan'];	
$barang	=$_GET['kd_barang'];
$delete1=mysqli_query($koneksi, "DELETE FROM tabel_rinci_penjualan WHERE no_faktur_penjualan='".$faktur."' AND kd_barang='".$barang."' ");
$delete2=mysqli_query($koneksi, "DELETE FROM tabel_rinci_penjualan_hitung WHERE no_faktur_penjualan='".$faktur."' AND kd_barang='".$barang."' ");
//$delete=mysql_query($query_delete);
if($delete){
header("location:../?menu=grosir&stt=sukses");}
else{
header("location:../?menu=grosir&stt=sukses");}
if($delete2){
header("location:../?menu=grosir&stt=sukses");}
else{
header("location:../?menu=grosir&stt=gagal");}
}
