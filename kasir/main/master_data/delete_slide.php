<?php
include('../inc/koneksi.php');
if(isset($_GET['id_slide'])){
$id_slide=$_GET['id_slide'];
$query_delete="DELETE FROM tabel_slide WHERE id_slide='".$id_slide."'";	
$delete=mysqli_query($koneksi, $query_delete);
if($delete){
header("location:../?menu=promo");}
else{
header("location:../?menu=promo");}}
?>
