<?php include("../kasir/main/inc/koneksi.php");?>
<?php
/*=======BELI BARANG====*/
ini_set("display_errors",0);
if(isset($_POST['add_to_cart'])){
$no_notae	 		= $_POST ['no_nota'];
$kd_barang	 		= $_POST ['kd_barang'];
$nm_barang	 		= $_POST ['nm_barang'];
$hrg_jual	 		= $_POST ['jual'];
$sql = mysqli_query($koneksi, "SELECT * FROM tabel_stok_toko WHERE kd_barang = '$kd_barang' ");
if (mysqli_num_rows($sql) == 1){
$sql="SELECT * FROM tabel_stok_toko WHERE kd_barang = '$kd_barang'"; $qry=mysqli_query($koneksi, $sql); $d=mysqli_fetch_array($qry);
$id_tabel_stok_toko	= $d['kd_barang'];
$masuk				= $d['stok'];
$total_masuk		= $masuk-0;
$insert = mysqli_query($koneksi, "UPDATE `tabel_stok_toko` SET `stok`='$total_masuk' WHERE `kd_barang`='$kd_barang'");
if($insert){
$input = mysqli_query($koneksi, "INSERT INTO tabel_rinci_penjualan VALUES ('$no_notae','$kd_barang','$nm_barang','','','1','$hrg_jual','','','','','')");
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?menu=cart&no_nota='.$no_notae.'">';   
}else{
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?menu=cart&no_nota='.$no_notae.'">';
} }}
?>
<?php
ini_set("display_errors",0);
if(isset($_POST['jml'])){ 
$no_faktur		=$_POST['no_faktur'];
$kd_brg			=$_POST['kd_brg'];
$jml			=$_POST['jml'];
$hrg			=$_POST['hrg'];
$sub_total		=$jml*$hrg;
$sql1="INSERT INTO tabel_rinci_penjualan_hitung VALUES('','$no_faktur','$kd_brg','$jml','$hrg')";
$sql2 = "UPDATE tabel_rinci_penjualan SET jumlah='$jml',harga='$hrg',sub_total_jual='$sub_total' WHERE kd_barang='$kd_brg' AND no_faktur_penjualan = '$no_faktur'";
$insert=mysqli_query($koneksi, $sql1);
$update=mysqli_query($koneksi, $sql2); 
if($insert){
	//header("location:?menu=home&stt=sukses");
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?menu=cart&no_nota='.$no_faktur.'">';
}
	else{
	//header("location:?menu=home&stt=gagal");
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?menu=cart&no_nota='.$no_faktur.'">';
}
	if($update){
	//header("location:?menu=home&stt=sukses");
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?menu=cart&no_nota='.$no_faktur.'">';
}
	else{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?menu=cart&no_nota='.$no_faktur.'">';
}
}
?>  
