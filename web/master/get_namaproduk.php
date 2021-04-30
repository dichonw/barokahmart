<?php
 
// Query propinsi
$propinsi = $_GET['propinsi'];
$result = mysqli_query($koneksi,"SELECT * FROM tabel_jenis_baru WHERE tabel_jenis_baru.id_kategori_baru = '$propinsi'");
 
$results_array = array();
while($row = mysqli_fetch_array($result)) {
    $results_array[$row['id_jenis_baru']] = $row['nama_jenis_baru'];
}
 
echo json_encode($results_array);
 
mysqli_close($con);
?>