<?php

// header('Content-Type: application/json');
include('../../kasir/main/inc/koneksi.php');
$pulsaQuery = "SELECT * FROM `tabel_kategori_baru`";
$pulsaResult = mysqli_query($koneksi, $pulsaQuery);
while ($row = mysqli_fetch_array($pulsaResult)) {

    $data[] = array("id_kategori_baru" => $row['id_kategori_baru'], "nama_kategori_baru" => $row['nama_kategori_baru']);
}
// $sql = "SELECT * FROM tabel_kategori_baru";
// $query = $mysqli->query($sql);
// $data = array();
// while($row = $query->fetch_array(MYSQLI_ASSOC)){
// $data[] = array("id_kategori_baru" => $row['id_kategori_baru'], "nama_kategori_baru" => $row['nama_kategori_baru']);
// }
echo json_encode($data);
// echo $data;
?>
