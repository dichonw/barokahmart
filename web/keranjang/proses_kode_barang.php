<?php
session_start();
include('../../kasir/main/inc/koneksi.php');
if(isset($_GET['kd_barang'])&&isset($_GET['no_faktur'])){
$kd_barang	= $_GET['kd_barang'];
$no_faktur	= $_GET['no_faktur'];
$query ="SELECT tabel_barang.*,tabel_stok_toko.* FROM tabel_barang,tabel_stok_toko WHERE tabel_barang.kd_barang='".$kd_barang."' AND tabel_stok_toko.kd_barang='".$kd_barang."' AND tabel_stok_toko.stok<=0 ";
$get_data	= mysqli_query($koneksi, $query);
$found		= mysqli_num_rows($get_data);
if($found == 0){
$data=mysqli_fetch_array(mysqli_query($koneksi, "SELECT tabel_barang.*,tabel_stok_toko.* FROM tabel_barang,tabel_stok_toko WHERE tabel_barang.kd_barang='".$kd_barang."' AND tabel_stok_toko.kd_barang='".$kd_barang."' "));
$kd_barang		=$data['kd_barang'];
$nm_barang		=$data['nm_barang'];
$kd_satuan		=$data['kd_satuan'];
$kd_kategori	=$data['kd_kategori'];
$warna			=$data['warna'];
$ukuran			=$data['ukuran'];
$hrg_jual		=$data['hrg_jual'];
$hrg_grosir		=$data['hrg_grosir'];
$hrg_beli		=$data['hrg_beli'];
$diskon			=$data['diskon'];
$disk			=$hrg_beli*$diskon/100;
$hrg_jual_disk	=$hrg_jual-$disk;
$stok			=$data['stok'];
//$jml			=$_POST['jml'];
$jml			=1;
$sub_total=$hrg_jual_disk*$jml;

$query_rinci_jual="INSERT INTO tabel_rinci_penjualan (no_faktur_penjualan,kd_barang,nm_barang,warna,ukuran,jumlah,harga,sub_total_jual,keterangan)VALUES ('".$no_faktur."','".$kd_barang."','".$nm_barang."','".$warna."','".$ukuran."','".$jml."','".$hrg_jual_disk."','".$sub_total."','TUNAI') ";
$insert_rinci_jual=mysqli_query($koneksi, $query_rinci_jual);
if($insert_rinci_jual){
header('location:../?menu=cart');
}else{
echo "Terjadi Kesalahan, Tidak dapat melanjutkan proses";}}
else{
echo "<script type='text/javascript'> alert('STOK KOSONG!'); document.location.href='../?menu=cart'; </script>;";}}
?>
