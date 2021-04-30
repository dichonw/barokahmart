<?php
include('../inc/koneksi.php');
if(isset($_GET['no_faktur_penjualan'])){
$faktur=$_GET['no_faktur_penjualan'];	
$query_delete="DELETE FROM tabel_penjualan WHERE no_faktur_penjualan='".$faktur."'";
$delete=mysqli_query($koneksi, $query_delete);
if($delete){
header("location:kasir.php?menu=setor&stt=sukses");}
else{
header("location:kasir.php?menu=setor&stt=gagal");}
}
?>