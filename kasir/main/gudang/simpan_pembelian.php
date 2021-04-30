<?php
include('inc/koneksi.php');
$no_faktur	=$_POST['no_faktur'];
$id_user	=$_POST['id_user'];
if(isset($_POST['button_add'])){
if($_POST['kd_barang']!=""){
$kd_barang	=$_POST['kd_barang'];
$nm_barang	=$_POST['nm_barang'];
$warna		= $_POST['warna'];
$ukuran		= $_POST['ukuran'];
$jml		= $_POST['jumlah'];
$hrg		= $_POST['harga'];
$sub_total	= $_POST['sub_total'];
$query_insert="INSERT INTO tabel_rinci_pembelian (no_faktur_pembelian,kd_barang,nm_barang,warna,ukuran,jumlah,harga,sub_total_beli) VALUES ('".$no_faktur."','".$kd_barang."','".$nm_barang."','".$warna."','".$ukuran."','".$jml."','".$hrg."','".$sub_total."')";
$insert=mysqli_query($koneksi, $query_insert);
if($insert){
echo "<script type='text/javascript'> document.location.href='?menu=pembelian'; </script> ";}
else{
echo"<script language='javascript'>
window.alert('Proses penyimpanan gagal silahkan isi data kembali');javascript:history.back();</script>";} }
else{
echo"<script language='javascript'>window.alert('Tidak Ada Item dipilih');javascript:history.back();</script>";	} }

else if(isset($_POST['button_selesai'])){
$total=0;
$query_get_data="SELECT sub_total_beli FROM tabel_rinci_pembelian WHERE no_faktur_pembelian='".$no_faktur."';";
$get_data=mysqli_query($koneksi, $query_get_data);
while($data=mysqli_fetch_array($get_data)){
$sub_total=$data['sub_total_beli'];
$total=$sub_total+$total;}
$kd_supplier=$_POST['kd_supplier'];
$tanggal=date('Ymd');
$query_insert_pembelian="INSERT INTO tabel_pembelian (no_faktur_pembelian,kd_supplier,tgl_pembelian,id_user,total_pembelian) VALUES ('".$no_faktur."','".$kd_supplier."','".$tanggal."','".$id_user."','".$total."')";
$insert_pembelian=mysqli_query($koneksi, $query_insert_pembelian);
if($insert_pembelian){
echo"<script type='text/javascript'> alert('Transaksi Berhasil'); document.location.href='gudang/update_stok.php?no_faktur=".$no_faktur."';</script>"; }
else{
echo "<script type='text/javascript'> alert('Transaksi Gagal, Silahkan Ulangi!'); document.location.href='?menu=pembelian'; </script> ";} }
