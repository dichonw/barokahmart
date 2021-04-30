<?php
include('../../kasir/main/inc/koneksi.php');
$id_kat = $_GET['id_kategori'];
$pulsaQuery = "SELECT * FROM tabel_jenis_baru WHERE `id_kategori_baru` = '$id_kat'";
$pulsaResult = mysqli_query($koneksi, $pulsaQuery);
while ($row = mysqli_fetch_array($pulsaResult)) {

    $data[] = array("id_jenis_baru" => $row['id_jenis_baru'], "nama_jenis_baru" => $row['nama_jenis_baru']);
}
echo json_encode($data);

?>