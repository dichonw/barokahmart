<link href="../../script/css/boilerplate.css" rel="stylesheet" type="text/css">
<link href="../../script/css/style.css" rel="stylesheet" type="text/css">
<link href="../../script/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../../script/css/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
<link href="../../script/css/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="../../script/css/bootstrap/css/icon-font.min.css" rel="stylesheet" type="text/css">
<link href="../../script/css/bootstrap/css/jquery-ui.css" rel="stylesheet" type="text/css">
<link href="../../script/css/paketKBK.css" rel="stylesheet" type="text/css">


<ul class="nav nav-pills" style="background:none">
    <?php include("../../inc/koneksi.php");
    $q = $_POST['q'];
    $produk = mysqli_query($koneksi, "select * from tabel_barang where nm_barang like '%" . $q . "%'");
    while ($a = mysqli_fetch_array($produk)) {
    ?>
        <li>



            <div class="col-md-3">
                <i class="fa fa-product-hunt"></i><?php echo $a['kd_barang']; ?></div>
            </div>

            <div class="col-md-6">
                <h5 class="title"><?php echo $a['nm_barang']; ?></h5>
                <p><i class="fa fa-database"></i> <?php echo $a['warna']; ?>/<?php echo $a['ukuran']; ?></p>
            </div>

            <div class="col-md-3"><?php echo $a['harga']; ?>
                <span class="btn btn-primary">Status <?php echo $a['stok']; ?></span>
            </div>



        </li><?php } ?>
</ul>