<?php
include("../../kasir/main/inc/koneksi.php");
ini_set("display_errors",0);
session_start();
$hp = $_SESSION['hp'];
unset($_SESSION['hp']); unset($_SESSION['password']);
$sql_offline = mysqli_query($koneksi, "UPDATE `tabel_member` SET `on`=0 WHERE hp='$hp'");
session_destroy();
?><script type="text/javascript">window.location = "../akses/login.php";</script>