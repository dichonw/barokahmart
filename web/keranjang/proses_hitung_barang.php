<?php
include('inc/koneksi.php');
if(isset($_POST['jumlah'])){ 
$no_faktur		=$_POST['no_faktur'];
$kd_brg			=$_POST['kd_brg'];
$jml			=$_POST['jumlah'];
$hrg			=$_POST['hrg'];
$sub_total		=$jml*$hrg;
$sql1="INSERT INTO tabel_rinci_penjualan_hitung VALUES('','$no_faktur','$kd_brg','$jml','$hrg')";
$sql2 = "UPDATE tabel_rinci_penjualan SET jumlah='$jml',harga='$hrg',sub_total_jual='$sub_total' WHERE kd_barang='$kd_brg' AND no_faktur_penjualan = '$no_faktur'";
$insert=mysqli_query($koneksi, $sql1);
$update=mysqli_query($koneksi, $sql2); 
if($insert){
	//header("location:?menu=home&stt=sukses");
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?menu=home&stt=sukses">';
}
	else{
	//header("location:?menu=home&stt=gagal");
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?menu=home&stt=gagal">';
}
	if($update){
	//header("location:?menu=home&stt=sukses");
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?menu=home&stt=sukses">';
}
	else{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?menu=home&stt=gagal">';
}
}
?>
