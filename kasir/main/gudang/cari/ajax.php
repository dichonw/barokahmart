<?php
include('../inc/koneksi.php');
$kd_barang = $_GET['kd_barang'];
$query = "SELECT tabel_barang.*, tabel_satuan_barang.nm_satuan as satuan FROM tabel_barang,tabel_satuan_barang 
WHERE tabel_barang.kd_barang='" . $kd_barang . "' AND tabel_satuan_barang.kd_satuan=tabel_barang.kd_satuan";
$get_data = mysqli_query($koneksi, $query);
$hasil = mysqli_fetch_array($get_data);
$nm_barang = $hasil['nm_barang'];
$satuan = $hasil['satuan'];
$harga = $hasil['hrg_beli'];
$data = $nm_barang . "&&&" . $satuan . "&&&" . $harga;
echo $data;
