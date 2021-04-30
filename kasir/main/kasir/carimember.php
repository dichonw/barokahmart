<?php
   include "../inc/koneksi.php"; //menyisipkan file koneksi.php
   $carimember = isset($_GET['carimember']) ? mysqli_real_escape_string($database,$_GET['carimember']):'';
   $data = array();
   $sql  = "select * from tabel_supplier where nm_supplier LIKE '".$carimember."%' AND atas_nama='member' OR atas_nama='pelanggan'";
   
   if($res = $database->query($sql)) {
      while ($row = $res->fetch_assoc()) {
	   $data[] = $row;
      }
   }
   echo json_encode($data);
   
   /* tutup koneksinya */
   $database->close();
