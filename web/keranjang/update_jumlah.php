<?php
session_start();
include('../inc/koneksi.php');
//ini_set("display_errors",0);

$kd_barang =$_POST ['kd_barang'];
$jumlah =$_POST ['jumlah'];

?>
<?php
if($jumlah==''){
mysqli_query($koneksi, "UPDATE `tabel_rinci_penjualan` SET `jumlah`='$jumlah' WHERE `tabel_rinci_penjualan`.`kd_barang` = '$kd_barang'");
echo $jumlah;
?><script language="JavaScript">document.location='kasir.php?menu=penjualan'</script>
<?php 
}elseif($jumlah!=''){ 
if($jumlah !=="" ){
mysqli_query($koneksi, "UPDATE `tabel_rinci_penjualan` SET `jumlah`='$jumlah' WHERE `tabel_rinci_penjualan`.`kd_barang` = '$kd_barang'");
?><script language="JavaScript">document.location='kasir.php?menu=penjualan'</script>
<?php
}else{
echo "<script>alert('Error');window.history.go(-1);</script>";
}
}else{
echo"<script>alert('Warna Tidak Boleh Kosong ');window.history.go(-1);";
}
?>