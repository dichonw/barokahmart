<?php
//koneksi database, sesuaikan dengan username dan password database Anda
include('../inc/koneksi.php');

//menangkap data yang dipostkan pembeli
$kd_toko_pusat = $_POST['kd_toko_pusat'];
$kd_barang_pusat = $_POST['kd_barang_pusat'];
$stok_pusat = $_POST['stok_pusat'];
$kd_toko_cabang = $_POST['kd_toko_cabang'];
$kd_barang_cabang = $_POST['kd_barang_cabang'];
$stok_cabang = $_POST['stok_cabang'];
$stok_akhir = $stok_pusat - $stok_cabang;

//perintah query insert ke table pembayaran
//$query_insert = ("INSERT INTO tabel_stok_toko (kd_toko,kd_barang,stok)VALUES ('".$kd_toko_cabang."','".$kd_barang_cabang."','".$stok_cabang."')");
$query_update1 = "UPDATE  `tabel_stok_toko` SET  `kd_toko` =  '$kd_toko_pusat',`kd_barang` =  '$kd_barang_pusat',`stok` =  '$stok_akhir' WHERE  `tabel_stok_toko`.`kd_toko`='$kd_toko_pusat' AND `kd_barang`='$kd_barang_pusat';
";

//perintah query update pada table status
$query_update2 = "UPDATE  `tabel_stok_toko` SET  `kd_toko` =  '$kd_toko_cabang',`kd_barang` =  '$kd_barang_cabang',`stok` =  '$stok_cabang' WHERE  `tabel_stok_toko`.`kd_toko`='$kd_toko_cabang' AND `kd_barang`='$kd_barang_cabang';
";

//eksekusi query insert
$update1 = mysqli_query($koneksi, $query_update1);

//eksekusi query update
$update2 = mysqli_query($koneksi, $query_update2);

//hasil eksekusi query insert
if ($update1) {
	echo " ";
} else {
	echo "Gagal Update ... ";
}

//hasil eksekusi query update
if ($update2) {
	echo "";
} else {
	echo "Gagal Update ... ";
}
?>
<script language="JavaScript">
	alert('STOK Berhasil Diperbarui');
	document.location = 'gudang.php?menu=distribusi'
</script>