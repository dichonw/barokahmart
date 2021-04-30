<?php
//include('../inc/koneksi.php');
ini_set("display_errors",0);
$kd_barang	=$_GET['kd_barang'];

if ($kd_barang	=	$_GET['kd_barang']){
	$delete_nota = mysqli_query($koneksi, "DELETE FROM tabel_barang WHERE kd_barang='".$kd_barang."'");
	$batalkan_nota = mysqli_query($koneksi, "DELETE FROM tabel_stok_toko WHERE kd_barang='".$kd_barang."'");
	echo "<script>alert('Data Berhasil Dihapus!');document.location='?menu=stok'</script>";
}
else{
	echo "<script>alert('Gagal Dihapus');window.history.go(-1);</script>";
}
?>