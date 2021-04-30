<?php
session_start();
include('../inc/koneksi.php');
$kd_toko				=$_SESSION['kd_toko'];
$faktur					=$_POST['no_faktur_retur'];
$tgl					=$_POST['tgl_retur'];
$kd_barang				=$_POST['kd_barang'];
$kd_supplier			=$_POST['supplier'];
$id_user				=$_POST['user'];
$jumlah					=$_POST['jumlah'];
$keterangan				=$_POST['ket'];
$nm_barang				=$_POST['nm_barang'];
$warna					=$_POST['warna'];
$ukuran					=$_POST['ukuran'];
$hrg_jual				=$_POST['hrg_jual'];
$hrg_retur				=$jumlah*$hrg_jual;

$user=mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_supplier WHERE kd_supplier='".$kd_supplier."'"));
$nm_supplier	= $user['nm_supplier'];

//INSERT TABEL RINCI RETUR
$query_insert_rinci="INSERT INTO tabel_rinci_retur (no_faktur_retur, kd_barang, nm_barang, warna, ukuran, jumlah, harga, sub_total_retur) VALUES ('".$faktur."', '".$kd_barang."', '".$nm_barang."', '".$warna."', '".$ukuran."', '".$jumlah."','".$hrg_jual."', '".$hrg_retur."')";
$insert=mysqli_query($koneksi, $query_insert_rinci);
if($insert){
header('location:kasir.php?menu=retur');}
else{
echo"<script language='javascript'>
window.alert('Proses penyimpanan gagal silahkan isi data kembali');javascript:history.back();</script>";} 
/////////////////////////////////////////////////////////////////////////////////////////////////

//INSERT TABEL RETUR
$query_insert_retur="INSERT INTO tabel_retur VALUES ('$faktur','$kd_supplier','$tgl','$id_user','$hrg_retur','RETUR DARI $nm_supplier','$keterangan')";
$retur=mysqli_query($koneksi, $query_insert_retur);
if($retur){
header('location:kasir.php?menu=retur');}
else{
echo"<script language='javascript'>
window.alert('Proses penyimpanan gagal silahkan isi data kembali');javascript:history.back();</script>";} 
/////////////////////////////////////////////////////////////////////////////////////////////////


//UPDATE TABEL STOK TOKO
$query_get_stok="SELECT * FROM tabel_stok_toko WHERE kd_barang='".$kd_barang."' AND kd_toko='".$kd_toko."'";
$get_stok=mysqli_query($koneksi, $query_get_stok);
while($stok=mysqli_fetch_array($get_stok)){	

$jml_stok		=$stok['stok'];
$stok_baru		=$jml_stok+$jumlah;

$query_update_stok="UPDATE tabel_stok_toko SET stok='".$stok_baru."' WHERE kd_barang='".$kd_barang."' AND kd_toko='".$kd_toko."'";
$update_stok=mysqli_query($koneksi, $query_update_stok);//kayake sek salah
}

if($insert || $retur || $update_stok){
header("location:kasir.php?menu=faktur_retur_pelanggan&no_faktur=".$faktur."");}
?>
