<?php
include('../inc/koneksi.php');
$kd_barang=$_GET['kd_barang'];
$no_faktur=$_GET['no_faktur'];
$query_hapus="DELETE FROM tabel_rinci_penjualan WHERE kd_barang='".$kd_barang."' AND no_faktur_penjualan='".$no_faktur."'";
$hapus=mysqli_query($koneksi, $query_hapus);
if($hapus){
echo"<script language='javascript'>
window.alert('Menghapus Data');javascript:history.back(-1);
</script>";}
else{
echo"<script language='javascript'>
window.alert('Gagal Menghapus Data');javascript:history.back(-1);
</script>";}
?>