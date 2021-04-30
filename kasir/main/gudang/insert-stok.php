<?php
include('../inc/koneksi.php');
$kd_toko  =  $_POST['kd_toko'];
$kd_barang  =  $_POST['kd_barang'];
$stok    =  $_POST['stok'];


$cekdata = "SELECT * FROM tabel_stok_toko WHERE kd_toko='" . $kd_toko . "' AND kd_barang='" . $kd_barang . "'";
$ada = mysqli_query($koneksi, $cekdata) or die(mysqli_error($koneksi));
if (mysqli_num_rows($ada) > 0) {
  echo "<script language='javascript'>
              alert ('Barang sudah ada di STOK silahkan melakukan UPDATE STOK barang');
              window.location='gudang.php?menu=stok';
              </script>";
} else {
  $query = "INSERT INTO tabel_stok_toko (kd_toko,kd_barang,stok)VALUES ('" . $kd_toko . "','" . $kd_barang . "','" . $stok . "')";
  mysqli_query($koneksi, $query) or die("Gagal menyimpan data karena :") . mysqli_error($koneksi);
}

?><script language="JavaScript">
  alert('STOK Berhasil Diperbarui');
  document.location = 'gudang.php?menu=stok'
</script>