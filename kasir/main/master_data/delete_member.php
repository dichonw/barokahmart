<?php
include('../inc/koneksi.php');
if(isset($_GET['id_user'])){
$id_delete=$_GET['id_user'];
$query_delete="DELETE FROM tabel_member WHERE id_user='".$id_delete."'";	
$delete=mysqli_query($koneksi, $query_delete);
if($delete){
header("location:../index.php?menu=member&stt=sukses");}
else{
header("location:../index.php?menu=member&stt=gagal");}
}
?>