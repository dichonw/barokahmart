<?php
//include('../inc/koneksi.php');
ini_set("display_errors",0);
$id_gmbr	=$_GET['id_gmbr'];

if ($id_gmbr	=	$_GET['id_gmbr']){
	$delete_nota = mysqli_query($koneksi, "DELETE FROM tabel_barang_gambar WHERE id_gmbr='".$id_gmbr."'");
	echo "<script>alert('Data Berhasil Dihapus!');window.history.go(-1);</script>";
}
else{
	echo "<script>alert('Gagal Dihapus');window.history.go(-1);</script>";
}
?>