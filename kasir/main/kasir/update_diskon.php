<?php
include('../inc/koneksi.php');
ini_set("display_errors",0);
if(isset($_POST['edit'])){	
$no_faktur_penjualan =$_POST ['no_faktur_penjualan'];
$diskon =$_POST ['diskon'];
if(empty($diskon)) { 
}else {
$query = "UPDATE `tabel_rinci_penjualan` SET `diskon`='$diskon' WHERE `tabel_rinci_penjualan`.`no_faktur_penjualan` = '$no_faktur_penjualan'" ;
$hasil = mysqli_query($koneksi, $query);
echo "<script language='JavaScript'>alert('OK diskon berhasil ditambahkan!');document.location='../?menu=home'</script>";
}
}
?>