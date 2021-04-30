<?php
include('inc/koneksi.php');
$kd_barang=$_GET['kd_barang'];
$no_faktur=$_GET['no_faktur'];
$query_hapus="DELETE FROM tabel_rinci_retur WHERE kd_barang='".$kd_barang."' AND no_faktur_retur='".$no_faktur."'";
$hapus=mysqli_query($koneksi, $query_hapus);
if($hapus){
echo "<script type='text/javascript'> alert('Berhasil dihapus'); document.location.href='?menu=suplier'; </script> ";}
else{
echo"<script language='javascript'>
window.alert('Gagal Menghapus Data');javascript:history.back();
</script>";}
?>