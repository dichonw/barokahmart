<?php
session_start();
if (!isset($_SESSION['kd_toko']) && !isset($_SESSION['status_toko'])) {
  header('location:../akses/login_toko.php');
} else if (!isset($_SESSION['id_user']) && !isset($_SESSION['status_user'])) {
  header('location:../akses/login_user.php');
} else {
  $status_toko = $_SESSION['status_toko'];
  $status_user = $_SESSION['status_user'];
}
?>
<?php
include('../inc/koneksi.php');
if (isset($_SESSION['kd_toko'])) {
  $query_info_toko = mysqli_query($koneksi, "SELECT * FROM tabel_toko WHERE kd_toko='" . $_SESSION['kd_toko'] . "'");
  $info_toko = mysqli_fetch_array($query_info_toko);
  $almt_toko  = $info_toko['almt_toko'];
  $tlp_toko  = $info_toko['tlp_toko'];
  $fax_toko  = $info_toko['fax_toko'];
  $logo_toko  = $info_toko['logo'];
  $header = true;
}
?>
<?php
include('../inc/koneksi.php');
$kd_toko = $_SESSION['kd_toko'];
$no_faktur = $_GET['no_faktur'];

$query_get_rinci_retur = "SELECT tabel_retur.*,tabel_rinci_retur.* FROM tabel_retur,tabel_rinci_retur WHERE tabel_retur.no_faktur_retur='" . $no_faktur . "' AND tabel_retur.no_faktur_retur=tabel_rinci_retur.no_faktur_retur";
$get_retur      = mysqli_query($koneksi, $query_get_rinci_retur);
$retur        = mysqli_fetch_array($get_retur);
$kd_supplier    = $retur['kd_supplier'];
$tgl_retur      = $retur['tgl_retur'];
$id_user      = $retur['id_user'];
$total_retur    = $retur['total_retur'];
$ket        = $retur['status'];
$tgl        = $tgl_retur;
$tglbaru       = date("d-m-Y", strtotime($tgl));

$query_get_data_supplier = "SELECT * FROM tabel_supplier WHERE kd_supplier='" . $kd_supplier . "'";
$get_data_supplier    = mysqli_query($koneksi, $query_get_data_supplier);
$data_supplier      = mysqli_fetch_array($get_data_supplier);
$nm_supplier    = $data_supplier['nm_supplier'];
$almt_supplier    = $data_supplier['almt_supplier'];
$almt        = $data_supplier['almt'];
$tlp_supplier     = $data_supplier['tlp_supplier'];
$fax_supplier     = $data_supplier['fax_supplier'];
$atas_nama      = $data_supplier['atas_nama'];
$get_rinci_retur = mysqli_query($koneksi, $query_get_rinci_retur);
$hitung_baris = mysqli_num_rows($get_rinci_retur);

$query_get_data_user = "SELECT * FROM tabel_user WHERE id_user='" . $id_user . "'";
$get_data_user      = mysqli_query($koneksi, $query_get_data_user);
$data_user        = mysqli_fetch_array($get_data_user);
$nm_user    = $data_user['nm_user'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>.:Faktur Retur:.</title>


  <style type="text/css">
    body {
      font-size: 11px;
      color: #222;
      font-family: Arial, Helvetica, sans-serif;
    }
  </style>
</head>

<body onload="print()" style="background:none">
  <div id="faktur">
    <div id="faktur">
      <table width="200">
        <tr>
          <th colspan="2" align="center">RETUR JUAL<br /><?php echo $nm_toko; ?></th>
        </tr>
        <tr>
          <td colspan="2" align="center"><?php echo $almt_toko; ?><br /><?php echo $tlp_toko; ?><br /><?php echo $fax_toko; ?></td>
        </tr>
        <tr>
          <td colspan="2">
            <hr />
          </td>
        </tr>
        <tr>
          <td colspan="2">NOTA.<?php echo $no_faktur; ?>
            <br /><small><?php echo $tgl_penjualan; ?></small></td>
        </tr>

        <tr>
          <td colspan="2">Cust.<?php echo $nm_supplier; ?><br /><?php echo $almt_supplier; ?><?php echo $tlp_supplier; ?></td>
        </tr>
        <tr>
          <td colspan="2">
            <hr />
          </td>
        </tr>
        <?php
        $total_item = 0;
        while ($rinci_retur = mysqli_fetch_array($get_rinci_retur)) {
          $kd_brg    = $rinci_retur['kd_barang'];
          $nm_brg    = $rinci_retur['nm_barang'];
          $warna    = $rinci_retur['warna'];
          $ukuran    = $rinci_retur['ukuran'];
          $jml    = $rinci_retur['jumlah'];
          $hrg    = $rinci_retur['harga'];
          $sub_ttl  = $rinci_retur['sub_total_retur'];
          $total_item  = $jml + $total_item;
        ?>
          <tr class="tr_item">
            <td>
              <?php echo $nm_brg; ?><br />
              <small><?php echo $warna; ?><?php echo $ukuran; ?><br />
                <?php echo $sub_ttl; ?></small></td>
            <td><?php echo $ket; ?></td>
          </tr>
        <?php } ?>
        <tr>
          <td colspan="2">
            <hr />
          </td>
        </tr>
        <tr class="tr_header_footer">
          <td>TOTAL BARANG</td>
          <td><?php echo $total_item ?> ITEMS</td>
        </tr>
        <tr>
          <td colspan="2" align="center">Terima kasih atas kepercayaan anda.</td>
        </tr>
      </table>
    </div>
</body>

</html>