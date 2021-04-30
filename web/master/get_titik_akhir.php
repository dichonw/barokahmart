<?php
include('../../kasir/main/inc/koneksi.php');
$titik_awal = $_GET['titik_awal'];
$pulsaQuery = "SELECT id_kurir, titik_akhir FROM tabel_kurir WHERE `titik_awal` = '$titik_awal' ORDER BY titik_akhir ASC";
$pulsaResult = mysqli_query($koneksi, $pulsaQuery);
while ($row = mysqli_fetch_array($pulsaResult)) {

    $data[] = array("id_kurir" => $row['id_kurir'], "titik_akhir" => $row['titik_akhir']);
}
echo json_encode($data);

?>