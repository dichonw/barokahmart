<?php
include('../inc/koneksi.php');
$no_faktur=$_POST['no_faktur'];
$id_user=$_POST['id_user'];
if(isset($_POST['button_add'])){
if($_POST['kd_barang']!=""){
$kd_barang		=$_POST['kd_barang'];
$nm_barang		=$_POST['nm_barang'];
$warna			=$_POST['warna'];
$ukuran			=$_POST['ukuran'];
$jml			=$_POST['jumlah'];
$hrg			=$_POST['harga'];
$total			=$hrg*$jml;
$sub_total		=$total;
$query_insert="INSERT INTO tabel_rinci_penjualan (no_faktur_penjualan, kd_barang, nm_barang, warna, ukuran, jumlah, harga, 	sub_total_jual) VALUES ('".$no_faktur."','".$kd_barang."','".$nm_barang."','".$warna."','".$ukuran."','".$jml."','".$hrg."',				'".$sub_total."')";
$insert=mysqli_query($koneksi, $query_insert);
if($insert){
header('location:kasir.php?menu=kredit');}
else{
echo"<script language='javascript'>
window.alert('Proses penyimpanan gagal silahkan isi data kembali');javascript:history.back();</script>";} }
else{
echo"<script language='javascript'>window.alert('Tidak Ada Item dipilih');javascript:history.back();</script>";	} }
 
else if(isset($_POST['button_selesai'])){
$total=0;
$query_get_data="SELECT sub_total_jual FROM tabel_rinci_penjualan WHERE no_faktur_penjualan='".$no_faktur."'";
$get_data		=mysqli_query($koneksi, $query_get_data);
while($data		=mysqli_fetch_array($get_data)){
$sub_total		=$data['sub_total_jual'];
$total			=$sub_total+$total;}
$kd_supplier	=$_POST['kd_supplier'];
$kategori		=$_POST['kategori'];
$nm_supplier	=$_POST['nm_supplier'];
$almt_supplier	=$_POST['almt_supplier'];
$almt			=$_POST['almt'];
$tlp_supplier	=$_POST['tlp_supplier'];
$fax_supplier	=$_POST['fax_supplier'];
$atas_nama		=$_POST['atas_nama'];
$ket			=$_POST['keterangan'];
$dp				=$_POST['dp'];
$sisa			=$_POST['sisa'];

$query_insert_penjualan="INSERT INTO tabel_penjualan VALUES ('$no_faktur','$kd_supplier',NOW(),'$id_user','$total','$dp','$sisa','$ket','')";
$insert_penjualan=mysqli_query($koneksi, $query_insert_penjualan);
if($insert_penjualan){
echo"<script type='text/javascript'> alert('Transaksi Berhasil,Menampilkan Nota Penjualan!'); document.location.href='update_stok_member.php?no_faktur=".$no_faktur."';</script>"; }
else{
echo "<script type='text/javascript'> alert('Transaksi Gagal, Silahkan Ulangi!'); document.location.href='kasir.php?menu=member-kredit'; </script> ";} }
