<?php
include('../inc/koneksi.php');
ini_set("display_errors",0);
if(isset($_POST['bayar'])){ //['bayar'] merupakan name dari button di form tambah
	$faktur				= $_POST['faktur'];
	$kd_supplier		= $_POST['kd_supplier'];
	$tgl_penjualan		= $_POST['tgl_penjualan'];
	$id_user			= $_POST['id_user'];
	$total_penjualan	= $_POST['total_penjualan'];
	$dp					= $_POST['dp'];
	$jml				= $_POST['jml'];
	$sisa				= $_POST['sisa'];
	$status				= $_POST['status'];
	$uang				= $dp+$jml;//sek salah
	$kari				= $sisa-$jml;//sek salah

if ($status =="LUNAS"){
	$ganti = "KREDIT LUNAS";
}
elseif ($status =="Angsuran"){
	$ganti = "Angsuran";
}
else {
}
	$sql	= "UPDATE tabel_penjualan SET dp='$uang',sisa='$kari',status='$ganti' WHERE no_faktur_penjualan='$faktur' ";
	$query	= mysqli_query($koneksi, $sql);
	
	if($query){
		echo "<script language='JavaScript'>document.location='kasir.php?menu=faktur_member&no_faktur=".$faktur."'</script>";
		//header("location: kasir.php?menu=angsuran"); 
	}
	else{
		echo "<script language='javascript'>
window.alert('Proses penyimpanan gagal silahkan isi data kembali');javascript:history.back();</script>";
	}
}
