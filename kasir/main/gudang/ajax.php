<?php
include('../inc/koneksi.php');
$kd_barang=$_GET['kd_barang'];
$query="SELECT * FROM tabel_barang WHERE tabel_barang.kd_barang='".$kd_barang."'";		
$get_data=mysqli_query($koneksi, $query);
$hasil=mysqli_fetch_array($get_data);
$nm_barang	=$hasil['nm_barang'];
$warna		=$hasil['warna'];
$ukuran		=$hasil['ukuran'];
$harga		=$hasil['hrg_jual'];
$data=$nm_barang."&&&".$warna."&&&".$ukuran."&&&".$harga;
echo $data;
