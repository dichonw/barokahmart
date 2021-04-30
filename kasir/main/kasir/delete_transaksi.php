<?php
include('../inc/koneksi.php');
if(isset($_GET['no_faktur_penjualan'])){
$no_faktur_penjualan=$_GET['no_faktur_penjualan'];	
$kd_barang=$_GET['kd_barang'];
$query_delete="DELETE kd_barang FROM tabel_rinci_penjualan WHERE no_faktur_penjualan='".$no_faktur_penjualan."' ";
$delete=mysqli_query($koneksi, $query_delete);
if($delete){
header("location:kasir.php?menu=penjualan&stt=sukses");}
else{
header("location:kasir.php?menu=penjualan&stt=gagal");}
}
?>