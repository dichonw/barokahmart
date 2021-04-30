<?php
   include "../inc/conn.php"; //menyisipkan file koneksi.php
   $caribrg = isset($_GET['caribarang']) ? mysqli_real_escape_string($database,$_GET['caribarang']):'';
   $data = array();
   $sql  = "select * from tabel_barang where nm_barang LIKE '".$caribrg."%'";
   
   if($res = $database->query($sql)) {
      while ($row = $res->fetch_assoc()) {
	   $data[] = $row;
      }
   }
   echo json_encode($data);
   
   /* tutup koneksinya */
   $database->close();
?>
