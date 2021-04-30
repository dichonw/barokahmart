<?php
//session_start();
include('../kasir/main/inc/koneksi.php');
if(isset($_POST['simpan'])){
$no_faktur		=$_POST['no_nota'];
$total_belanja	=$_POST['total_belanja'];
$tgl_penjualan	=date('Ymd');
$status			=$_POST['status'];
$ket			=$_POST['ket'];
$id_user		=$_POST['id_member'];
$query="INSERT INTO tabel_penjualan (no_faktur_penjualan,tgl_penjualan,id_user,total_penjualan,dp,sisa,ket,status)VALUES('".$no_faktur."',NOW(),'$id_user','".$total_belanja."','','wait','ONLINE $ket','$status')";
$insert=mysqli_query($koneksi, $query);
if($insert){
$query_item_penjualan="SELECT kd_barang, SUM(jumlah) as total_item FROM tabel_rinci_penjualan WHERE no_faktur_penjualan='".$no_faktur."' group by kd_barang ";
$item_penjualan=mysqli_query($koneksi, $query_item_penjualan);
while($penjualan=mysqli_fetch_array($item_penjualan)){
$kd_barang		=$penjualan['kd_barang'];
$total_item		=$penjualan['total_item'];
$query_ambil_stok="SELECT stok FROM tabel_stok_toko WHERE kd_barang='".$kd_barang."' ";
$ambil_stok=mysqli_query($koneksi, $query_ambil_stok);
$stok=mysqli_fetch_array($ambil_stok);
$stok_lama		=$stok['stok'];
$stok_baru		=$stok_lama-$total_item;
$query_update_stok="UPDATE tabel_stok_toko SET stok='".$stok_baru."' WHERE kd_barang='".$kd_barang."' ";
$update_stok=mysqli_query($koneksi, $query_update_stok);}}
else{echo "transaksi gagal";}}
//header('location:?menu=home');
//echo "<META HTTP-EQUIV='Refresh' Content='0; URL=keranjang/kasir-nota.php?no_faktur=$no_faktur'>";
/*echo "<script>document.location.href='keranjang/kasir-nota.php?no_faktur=$no_faktur&https://wa.me/6285959188887?text=Cek%20nota%20$no_faktur';</script>";*/
echo "<script>document.location.href='?menu=record';</script>";
?>