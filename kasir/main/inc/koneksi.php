<?php
$servername = "localhost";
$username = "root";
$password = "";
$db="barokahmart";

$koneksi = mysqli_connect($servername, $username, $password, $db);

if (!$koneksi) {
  die("Connection failed: " . mysqli_connect_error());
}

?>


<!-- $servername = "localhost";
$username = "republ23_bm";
$password = "t&*2OdacukEbm";
$db="republ23_barokahmart"; -->
