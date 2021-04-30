<?php
include('../../kasir/main/inc/koneksi.php');
$id_jen = $_GET['id_jenis'];
$sql = "SELECT * FROM tabel_barang WHERE `kd_kategori` = '$id_jen'";
$pulsaResult = mysqli_query($koneksi, $sql);
while ($row = mysqli_fetch_array($pulsaResult)) {

    $data[] = array("kd_barang" => $row['kd_barang'], "nm_barang" => $row['nm_barang']);
}
echo json_encode($data);

?>