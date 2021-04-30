<?php
include('../inc/koneksi.php');
ini_set("display_errors",0);
if(isset($_POST['edit'])){	
$kd_barang			 	=$_POST ['kd_barang'];
$diskon 				=$_POST ['diskon'];
$hrg_jual 				=$_POST ['hrg_jual'];
if(empty($kd_barang)) { 
}else {
$query = "UPDATE `tabel_barang` SET `hrg_jual`='$hrg_jual',`diskon`='$diskon' WHERE `kd_barang` = '$kd_barang'" ;
$hasil = mysqli_query($koneksi, $query);
echo "<script language='JavaScript'>alert('OK diskon berhasil ditambahkan!');document.location='../?menu=stok'</script>";
}
}
