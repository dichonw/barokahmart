<?php
include('../inc/koneksi.php');
ini_set("display_errors",0);
if(isset($_POST['edit'])){	
$kd_barang	 		= $_POST ['kd_barang'];
$nm_barang	 		= $_POST ['nm_barang'];
$satuan 			= $_POST ['satuan'];
$kategori 			= $_POST ['kategori'];
$deskripsi 			= $_POST ['deskripsi'];
$hrg_beli 			= $_POST ['hrg_beli'];
$hrg_jual 			= $_POST ['hrg_jual'];
$hrg_grosir 		= $_POST ['hrg_grosir'];
$diskon		 		= $_POST ['diskon'];
$stok 				= $_POST ['stok'];

$insert = mysqli_query($koneksi, "UPDATE `tabel_barang` SET `nm_barang`='$nm_barang',`kd_satuan`='$satuan',`kd_kategori`='$kategori',`deskripsi`='$deskripsi',`hrg_beli`='$hrg_beli',`hrg_jual`='$hrg_jual',`hrg_grosir`='$hrg_grosir',`diskon`='$diskon' WHERE kd_barang = '$kd_barang'");
if($insert){	
$input = mysqli_query($koneksi, "UPDATE `tabel_stok_toko` SET `stok`='$stok' WHERE kd_barang = '$kd_barang'");
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../?menu=stok">';
    }
}
?>