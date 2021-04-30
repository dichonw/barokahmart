<?php
include('../inc/koneksi.php');
if(isset($_GET['kd_satuan'])){
$kd_satuan=$_GET['kd_satuan'];
$query_delete="DELETE FROM tabel_satuan_barang WHERE kd_satuan='".$kd_satuan."'";
$delete=mysqli_query($koneksi, $query_delete);
if($delete){
header("location:../index.php?menu=satuan&stt=sukses");}
else{
header("location:../index.php?menu=satuan&stt=gagal");}
}
?>