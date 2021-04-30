<?php
include('../inc/koneksi.php');
if(isset($_GET['id'])){
$id=$_GET['id'];	
$query_delete="DELETE FROM tabel_stok_toko WHERE id='".$id."'";
$delete=mysqli_query($koneksi, $query_delete);
if($delete){
header("location:gudang.php?menu=stok&stt=sukses");}
else{
header("location:gudang.php?menu=stok&stt=gagal");}
}
?>