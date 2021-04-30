<?php
include('../inc/koneksi.php');
$query_max_id=mysqli_query($koneksi, "SELECT MAX(id_user) as maxid FROM tabel_user");
$result=mysqli_fetch_array($query_max_id);
$maxid=$result['maxid'];
$uid="UID";
$no_urut=substr($maxid,-3);
$new_urut=$no_urut+1;
$id_user=$uid.sprintf("%03s",$new_urut);
if(isset($_POST['button_tambah'])){
$nm_user=$_POST['nm_user'];	
$password=$_POST['password'];
$akses=$_POST['akses'];
$kd_toko=$_POST['kd_toko'];
$query_insert="INSERT INTO tabel_user (id_user,nm_user,password,akses,kd_toko)VALUES('".$id_user."','".$nm_user."',md5('".$password."'),'".$akses."','".$kd_toko."')";
$insert=mysqli_query($koneksi, $query_insert);
if($insert){
header("location:../index.php?menu=user&stt=sukses");}
else{
header("location:../index.php?menu=user&stt=gagal");}
}
