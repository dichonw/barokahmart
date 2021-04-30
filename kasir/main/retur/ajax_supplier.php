<?php
include('../inc/koneksi.php');
$kd_barang=$_GET['kd_barang'];
$query="SELECT * FROM tabel_barang WHERE tabel_barang.kd_barang='".$kd_barang."'";		
$get_data=mysqli_query($koneksi, $query);
$hasil=mysqli_fetch_array($get_data);
$nm_barang	=$hasil['nm_barang'];
$hrg_beli		=$hasil['hrg_beli'];
$data=$nm_barang."&&&".$hrg_beli;
echo $data; ?>