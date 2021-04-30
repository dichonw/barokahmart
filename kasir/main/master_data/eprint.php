<link href="../script/css/style.css" rel="stylesheet" type="text/css">
<link href="../../../script/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../../../script/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css">
<link href="../../../script/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css">
<link href="../../../script/css/font/css/fontawesome.min.css" rel="stylesheet" type="text/css">
<style>
@media screen {
  #printSection {
      display: none;
  }
}

@media print {
  body * {
    visibility:hidden;
  }
  #printSection, #printSection * {
    visibility:visible;
  }
  #printSection {
    position:absolute;
    left:0;
    top:0;
  }
}
</style>

<?php include('../inc/koneksi.php');
if($_POST['idx']) {
$id 	= $_POST['idx'];      
$data 	= mysqli_query($koneksi, "SELECT * FROM tabel_barang,tabel_stok_toko WHERE tabel_barang.kd_barang = '$id' AND tabel_barang.kd_barang = tabel_stok_toko.kd_barang ");
$d 		= mysqli_fetch_array($data);
}?>   

    <div class="row border">
      <div class="col-6 border">         
         <h3><?php echo $d['nm_barang'];?></h3>
         <h1>Rp.<?php echo number_format($d['hrg_jual'], 2, ".", ",");?></h1>
      </div>
      <div class="col-6 border"> 
         <h3><?php echo $d['nm_barang'];?></h3>
         <h1>Rp.<?php echo number_format($d['hrg_grosir'], 2, ".", ",");?></h1> 
      </div>    
    </div> 
      