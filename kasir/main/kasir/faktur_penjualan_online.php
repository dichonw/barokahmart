<?php
session_start();
include('../inc/koneksi.php');
$kd_toko=$_SESSION['kd_toko'];
$no_faktur=$_GET['no_faktur'];
$cash_jual=$_GET['cash_jual'];
$query_info_toko="SELECT * FROM tabel_toko WHERE kd_toko='".$kd_toko."'";
$ambil_info_toko=mysqli_query($koneksi, $query_info_toko);
$info_toko=mysqli_fetch_array($ambil_info_toko);
$nama_toko=$info_toko['nm_toko'];
$alamat=$info_toko['almt_toko'];
$tlp_toko=$info_toko['tlp_toko'];
$fax_toko=$info_toko['fax_toko'];
$logo=$info_toko['logo'];
$query_rinci_jual="SELECT * FROM tabel_rinci_penjualan WHERE no_faktur_penjualan='".$no_faktur."'";	
$rinci_jual=mysqli_query($koneksi, $query_rinci_jual);
$id=$_SESSION['id_user'];
$nama=$_SESSION['nm_user'];
$query_rinci_jual="SELECT * FROM tabel_user WHERE id='".$id."'";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:Nota Kasir:.</title>
<!--link href="../script/css/boilerplate.css" rel="stylesheet" type="text/css">
<link href="../script/css/style.css" rel="stylesheet" type="text/css">
<link href="../script/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../script/css/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
<link href="../script/css/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="../script/css/bootstrap/css/icon-font.min.css" rel="stylesheet" type="text/css">
<link href="../script/css/bootstrap/css/jquery-ui.css" rel="stylesheet" type="text/css">
<link href="../script/css/paketKBK.css" rel="stylesheet" type="text/css"-->
<style type="text/css">
body {	
	font-size: 11px;
	color: #222;
	font-family:Arial, Helvetica, sans-serif;
	}
</style>
</head>

<body onload="print()">
<table width="200" border="0">  
  <tr>
    <td colspan="2" align="center"><h3><?php echo $nama_toko; ?></h3><?php echo $alamat; ?><br /><?php echo $tlp_toko; ?></td>
</tr>
<?php $b=mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_penjualan WHERE no_faktur_penjualan = '$no_faktur'")); ?>  
  <tr>
    <td colspan="2"><hr /></td></tr>
  <tr>
    <td colspan="2">NOTA.<?php echo $no_faktur; ?><br /><?php echo date('d-m-y | H:i:s');?>
	<br />Alamat pengiriman :<br /><?php echo $b['status'];?>
	
	</td>
  </tr>
  <tr><td colspan="2"><hr /></td></tr>
  <tr>
    <td>ITEM</td>
    <td>SUB</td>
  </tr>
  
  <tr><td colspan="2"><hr /></td></tr>
  
 <?php
$kembali=0; $total_item=0; $total_penjualan=0;
while($data_jual=mysqli_fetch_array($rinci_jual)){
$nm_barang		=$data_jual['nm_barang'];
$jml			=$data_jual['jumlah'];
$hrg			=$data_jual['harga'];
$discount		=$data_jual['diskon'];
$keterangan		=$data_jual['keterangan'];
//$sub_total=$data_jual['sub_total_jual'];
$sub_total		=$jml*$hrg;
$total_penjualan=$sub_total+$total_penjualan;
$ppn			=$total_penjualan*0/100;
$diskon			=($total_penjualan*$discount)/100;
$total_bayar	=$total_penjualan-$diskon;
$total_uang		=$total_bayar+$ppn;
//$total_bayar	=$total_penjualan+$ppn;
$total_item		=$jml+$total_item;
 ?> 
  <tr>
    <td><?php echo $nm_barang; ?><br /><?php echo $jml; ?>x<?php echo $hrg; ?></td>
    <td>Rp. <?php echo $sub_total; ?></td>
  </tr>
  
 <?php } $kembali=$cash_jual-$total_bayar; ?>
 <tr><td colspan="2"><hr /></td></tr>
  <tr>
    <th>TTL.<br /><?php echo $total_item; ?> pcs</th>
    <th>Rp. <?php echo $total_penjualan; ?></th>
  </tr>
  <!--tr>   
    <td>Disc.</td>    
    <td><?php echo $discount; ?>%</td>
  </tr>
  <tr>   
    <td>BYR</td>    
    <td>Rp. <?php echo $cash_jual; ?></td>
  </tr>
   <!--tr>    
    <td>KBL</td>
    <td>Rp. <?php echo $kembali; ?></td>
  </tr-->
  <tr>
    <td></td>
    <td><?php echo $keterangan; ?></td>
  </tr>
  <tr>
    <td colspan="2"><hr /></td></tr>
  <tr>

	<tr>
    <td colspan="2"><a href="../?menu=home">TERIMA KASIH<br />ATAS KUNJUNGAN ANDA</a></td>
  </tr>
  
</table>
</body>
</html>