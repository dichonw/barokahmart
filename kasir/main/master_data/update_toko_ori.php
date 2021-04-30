<?php
include('../inc/koneksi.php');
if(isset($_POST['button_update'])){
$kd_toko=$_POST['kd_toko_update'];	
$nm_toko=$_POST['nm_toko_update'];
$alamat=$_POST['alamat_update'];
$telepon=$_POST['telepon_update'];
$fax=$_POST['fax_update'];
$password=$_POST['password_update'];
$status=$_POST['status_update'];
$error=false;
$folder="../images/";
$file_type=array('jpg','jpeg','png','bmp','gif');
$max_size=3000000;
$file_name=$_FILES['logo_update']['name'];
$file_size=$_FILES['logo_update']['size'];
$explode=explode('.',$file_name);
$extensi=$explode[count($explode)-1];
if(!in_array($extensi,$file_type)){
$error=true;
$pesan="Type file tidak sesuai";}
if($file_size>$max_size){
$error=true;
$pesan="Ukuran file melebihi maximum";}
if($error==true){
echo"<script language='javascript'>
window.alert('Proses penyimpanan gagal".$pesan."');javascript:history.back();</script>";}
else{
if(move_uploaded_file($_FILES['logo_update']['tmp_name'],$folder.$file_name)){
$query_update="UPDATE tabel_toko SET nm_toko='".$nm_toko."' ,almt_toko='".$alamat."',tlp_toko='".$telepon."',fax_toko='".$fax."',logo='".$file_name."',password=md5('".$password."'),status='".$status."' WHERE kd_toko='".$kd_toko."'";
$update=mysqli_query($koneksi, $query_update);
if($update){
header("location:../index.php?menu=toko&stt=sukses");}
else{
header("location:../index.php?menu=toko&stt=gagal");}}
else{
echo"<script language='javascript'>window.alert('Proses penyimpanan gagal silahkan isi data kembali ');javascript:history.back();</script>";}
}}?>