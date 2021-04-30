<?php
session_start();
include('../inc/koneksi.php');
if(isset($_GET['kd_barang'])){
$kd_barang	= $_GET['kd_barang'];
$query = "INSERT INTO `tabel_barang` VALUES('$kd_barang','','','','','','','','','')";
$insert_kode = mysqli_query($koneksi, $query);
if($insert_kode){
//header('location:index.php?menu=barang&kd_barang=');
//echo "";
?><script language='JavaScript'>; document.location='../?menu=barang&kd_barang=<?php echo $kd_barang; ?>'</script>
<?php 
}else{
echo "Terjadi Kesalahan, Tidak dapat melanjutkan proses";
}
}
?>