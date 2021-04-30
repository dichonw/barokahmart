<?php
include('../inc/koneksi.php');

$toko_update = $_POST['toko_update'];
$kd_update = $_POST['kd_update'];
$stok_update = $_POST['stok_update'];

$query_get_stok = "SELECT stok FROM tabel_stok_toko WHERE kd_barang='" . $kd_update . "' AND kd_toko='" . $toko_update . "'";
$get_stok = mysqli_query($koneksi, $query_get_stok);

$jml_stok = $get_stok['stok'];
$stok_baru = $jml_stok + $stok_update;

$query_update_stok = "UPDATE tabel_stok_toko SET stok='" . $stok_baru . "' WHERE kd_barang='" . $kd_update . "' AND kd_toko='" . $toko_update . "'";
$update_stok = mysqli_query($koneksi, $query_update_stok);

?><script language="JavaScript">
	alert('STOK Berhasil Diperbarui');
	document.location = 'gudang.php?menu=stok'
</script>