<?php
include('../inc/koneksi.php');
if(isset($_POST['button_update'])){
$kd_update				=$_POST['kd_update'];
$nm_update				=$_POST['nm_update'];
$sat_update				=$_POST['sat_update'];
$kat_update				=$_POST['kat_update'];
$deskripsi				=$_POST['deskripsi'];
$jual_update			=$_POST['jual_update'];
$grosir_update			=$_POST['grosir_update'];
$beli_update			=$_POST['beli_update'];
$kd_toko				=$_POST['kd_toko'];
$stok					=$_POST['stok'];
//$diskon_update			=$_POST['diskon_update'];
//$hrg_jual_disk_update	=$_POST['hrg_jual_disk_update'];

//$query_update="UPDATE tabel_barang SET kd_barang='".$kd_update."',nm_barang='".$nm_update."',kd_satuan='".$sat_update."',kd_kategori='".$kat_update."',warna='".$wrn_update."',ukuran='".$uk_update."',hrg_jual='".$jual_update."',hrg_beli='".$beli_update."',diskon='".$diskon_update."',hrg_jual_disk='".$hrg_jual_disk_update."' WHERE kd_barang='".$kd_update."'";

$query_update="UPDATE tabel_barang SET nm_barang='".$nm_update."',kd_satuan='".$sat_update."',kd_kategori='".$kat_update."',deskripsi='".$deskripsi."',hrg_jual='".$jual_update."',hrg_grosir='".$grosir_update."',hrg_beli='".$beli_update."' WHERE kd_barang='".$kd_update."'";
$sql_insert = mysqli_query($koneksi, "INSERT INTO tabel_stok_toko VALUES('','$kd_toko','$kd_update','$stok')");

$update=mysqli_query($koneksi, $query_update);
if($update){
header("location:../?menu=gambar&kd_barang=$kd_update");}
else{
header("location:../?menu=barang&stt=gagal");}
}
if($sql_insert){
header("location:../?menu=gambar&kd_barang=$kd_update");}
else{
header("location:../?menu=barang&stt=gagal");}
?>