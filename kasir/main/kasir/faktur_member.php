<?php
session_start();
if(!isset($_SESSION['kd_toko'])&&!isset($_SESSION['status_toko'])){ 
header('location:../akses/login_toko.php');}
else if(!isset($_SESSION['id_user'])&&!isset($_SESSION['status_user'])){
header('location:../akses/login_user.php');}
else{
$status_toko=$_SESSION['status_toko'];
$status_user=$_SESSION['status_user'];}
?>
<?php
include('../inc/koneksi.php');
if(isset($_SESSION['kd_toko'])){
$query_info_toko=mysqli_query($koneksi, "SELECT * FROM tabel_toko WHERE kd_toko='".$_SESSION['kd_toko']."'");
$info_toko=mysqli_fetch_array($query_info_toko);
$nm_toko	=$info_toko['nm_toko'];
$almt_toko	=$info_toko['almt_toko'];
$tlp_toko	=$info_toko['tlp_toko'];
$fax_toko	=$info_toko['fax_toko'];
$logo_toko	=$info_toko['logo'];
$header=true;}
?>
<?php
include('../inc/koneksi.php');
$kd_toko=$_SESSION['kd_toko'];
$no_faktur=$_GET['no_faktur'];

$query_get_rinci_penjualan="SELECT tabel_penjualan.*,tabel_rinci_penjualan.* FROM tabel_penjualan,tabel_rinci_penjualan WHERE tabel_penjualan.no_faktur_penjualan='".$no_faktur."' AND tabel_penjualan.no_faktur_penjualan=tabel_rinci_penjualan.no_faktur_penjualan";
$get_penjualan			=mysqli_query($koneksi, $query_get_rinci_penjualan);
$penjualan				=mysqli_fetch_array($get_penjualan);
$kd_supplier		=$penjualan['kd_supplier'];
$tgl_penjualan		=$penjualan['tgl_penjualan'];
$id_user			=$penjualan['id_user'];
$total_penjualan	=$penjualan['total_penjualan'];
$dp					=$penjualan['dp'];
$sisa				=$penjualan['sisa'];
$ket				=$penjualan['ket'];
$tgl				= $tgl_penjualan;
$tglbaru 			= date("d-m-Y", strtotime($tgl));

if ($ket == "TUNAI"){
    $tes = "BACK";                    
	}
elseif ($ket =="KREDIT"){
	$tes = "OVER"; 
    }
else{
    }
	
$query_get_data_supplier="SELECT * FROM tabel_supplier WHERE kd_supplier='".$kd_supplier."'";
$get_data_supplier		=mysqli_query($koneksi, $query_get_data_supplier);
$data_supplier			=mysqli_fetch_array($get_data_supplier);
$nm_supplier		=$data_supplier['nm_supplier'];
$almt_supplier		=$data_supplier['almt_supplier'];
$tlp_supplier 		=$data_supplier['tlp_supplier'];
$fax_supplier 		=$data_supplier['fax_supplier'];
$atas_nama			=$data_supplier['atas_nama'];
$get_rinci_penjualan=mysqli_query($koneksi, $query_get_rinci_penjualan);
$hitung_baris=mysqli_num_rows($get_rinci_penjualan);

$query_get_data_user="SELECT * FROM tabel_user WHERE id_user='".$id_user."'";
$get_data_user			=mysqli_query($koneksi, $query_get_data_user);
$data_user				=mysqli_fetch_array($get_data_user);
$nm_user		=$data_user['nm_user'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:Faktur penjualan:.</title>

<style type="text/css">
body {	
	font-size: 11px;
	color: #222;
	font-family:Arial, Helvetica, sans-serif;
	}
</style>
</head>

<body onload="print()" style="background:none">
<div id="faktur">
<table width="200">
  <tr>
   <th colspan="2" align="center">NOTA PENJUALAN<br /><?php echo $nm_toko; ?></th>
  </tr>   
  <tr>  	
    <td colspan="2" align="center"><?php echo $almt_toko; ?><br /><?php echo $tlp_toko; ?><br /><?php echo $fax_toko; ?></td>
  </tr>
  <tr><td colspan="2"><hr /></td></tr> 
  <tr>
    <td colspan="2">NOTA.<?php echo $no_faktur; ?>
	<br /><small><?php echo $tgl_penjualan;?></small></td>
  </tr>
  
  <tr>
    <td colspan="2">Cust.<?php echo $nm_supplier;?><br /><?php echo $almt_supplier;?><?php echo $tlp_supplier;?></td>
  </tr> 
  <tr><td colspan="2"><hr /></td></tr>       
      <?php 
$total_item=0;
while($rinci_penjualan=mysqli_fetch_array($get_rinci_penjualan)){
$kd_brg		=$rinci_penjualan['kd_barang'];
$nm_brg		=$rinci_penjualan['nm_barang'];
$warna		=$rinci_penjualan['warna'];
$ukuran		=$rinci_penjualan['ukuran'];
$sat		=$rinci_penjualan['satuan'];
$jml		=$rinci_penjualan['jumlah'];
$hrg		=$rinci_penjualan['harga'];
$sub_ttl	=$rinci_penjualan['sub_total_jual'];
$total_item	=$jml+$total_item;
	  ?>
      <tr class="tr_item">
        <td>
		<?php echo $nm_brg; ?><br />
		<small><?php echo $warna; ?><?php echo $ukuran; ?><br />
		<?php echo $jml; ?> x <?php echo number_format($hrg,0,".","."); ?></small></td>
        <td>Rp.<?php echo number_format($sub_ttl,0,".","."); ?></td>        
      </tr>
<?php } ?>
      <tr><td colspan="2"><hr /></td></tr>      
      <tr class="tr_header_footer">
        <td>TTL. <?php echo $total_item ?></td>
        <td>Rp. <?php echo number_format($total_penjualan,0,".","."); ?></td>
      </tr> 
      <tr>
      	<th>CASH</th>        
        <td>Rp. <?php echo number_format($dp,0,".","."); ?></td>
      </tr> 
      <tr>      	
        <th><?php echo $tes; ?></th>        
        <td>Rp. <?php echo number_format($sisa,0,".","."); ?></td>
      </tr> 
    	<tr><td colspan="2" align="center">Terima kasih atas kepercayaan anda.</td></tr>	
</table>
</div>
</body>
</html>