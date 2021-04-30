<?php
include('../../kasir/main/inc/koneksi.php');
$kd_barang = $_GET['id_kurir'];
$pulsaQuery = "SELECT id_kurir, harga FROM tabel_kurir WHERE `id_kurir` = '$kd_barang'";
// $pulsaQuery = "SELECT * FROM tabel_barang WHERE `kd_barang` = '$kd_barang'";
$pulsaResult = mysqli_query($koneksi, $pulsaQuery);
while ($row = mysqli_fetch_array($pulsaResult)) {

    $data[] = array("id_kurir" => $row['id_kurir'], "harga" => $row['harga']);
}
echo json_encode($data);

?>