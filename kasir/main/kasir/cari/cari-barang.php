<link href="../../script/css/boilerplate.css" rel="stylesheet" type="text/css">
<link href="../../script/css/style.css" rel="stylesheet" type="text/css">
<link href="../../script/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../../script/css/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
<link href="../../script/css/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="../../script/css/bootstrap/css/icon-font.min.css" rel="stylesheet" type="text/css">
<link href="../../script/css/bootstrap/css/jquery-ui.css" rel="stylesheet" type="text/css">
<link href="../../script/css/paketKBK.css" rel="stylesheet" type="text/css">


<ul class="nav nav-text">
  <?php include("../../inc/koneksi.php");
  $q = $_POST['q'];
  $produk = mysqli_query($koneksi, "SELECT tabel_barang.kd_barang,tabel_barang.nm_barang, tabel_barang.kd_satuan, tabel_barang.kd_kategori, tabel_barang.warna, tabel_barang.ukuran, tabel_barang.hrg_jual,tabel_stok_toko.kd_toko, tabel_stok_toko.kd_barang,tabel_stok_toko.stok FROM tabel_barang
JOIN tabel_stok_toko ON tabel_stok_toko.kd_barang = tabel_barang.kd_barang WHERE nm_barang LIKE '%" . $q . "%'");
  while ($a = mysqli_fetch_array($produk)) {
  ?>
    <li>
      <div class="col-sm-3">
        <i class="fa fa-building-o"></i> Kode Toko <?php echo $a['kd_toko']; ?></div>
      </div>
      <div class="col-sm-9">
        <h4 class="title"><i class="fa fa-caret-right"></i> <?php echo $a['kd_barang']; ?>
          <p class="pull-right">Stok <?php echo $a['stok']; ?></p>
        </h4>
        <p><i class="fa fa-caret-right"></i>
          <?php echo $a['nm_barang']; ?>/<?php echo $a['warna']; ?>/<?php echo $a['ukuran']; ?></p>
        <span class="col-md-3"><?php echo $a['harga']; ?> </span>
      </div>
    </li><?php } ?>
</ul>