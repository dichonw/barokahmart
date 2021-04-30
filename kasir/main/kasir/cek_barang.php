<?php
session_start();
if (!isset($_SESSION['kd_toko']) && !isset($_SESSION['status_toko'])) {
    header('location:akses/login_toko.php');
} else if (!isset($_SESSION['id_user']) && !isset($_SESSION['status_user'])) {
    header('location:akses/login_user.php');
} else {
    $status_toko = $_SESSION['status_toko'];
    $status_user = $_SESSION['status_user'];
}
?>

<link href="../script/css/boilerplate.css" rel="stylesheet" type="text/css">
<link href="../script/css/style.css" rel="stylesheet" type="text/css">
<link href="../script/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../script/css/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
<link href="../script/css/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="../script/css/bootstrap/css/icon-font.min.css" rel="stylesheet" type="text/css">
<link href="../script/css/bootstrap/css/jquery-ui.css" rel="stylesheet" type="text/css">
<link href="../script/css/paketKBK.css" rel="stylesheet" type="text/css">

<script src="../respond.min.js"></script>
<script src="../script/js/jquery.min.js"></script>
<script src="../script/js/bootstrap.min.js"></script>


<!--a href="../index.php?menu=home" class="btn btn-danger"><h4><i class="fa fa-home"></i> HOME</h4></a>
  <?php if ($status_user == "kasir" || $status_user == "manager" || $status_user == "admin") { ?> 
  <a href="kasir.php?menu=penjualan" class="btn btn-danger"><h4><i class="fa fa-calculator"></i> KASIR</h4></a-->
<?php } ?>
<hr />


<!--------SELECT DROPDOWN SELECTION------------------>
<script type="text/javascript">
    $(document).ready(function() {
        $("#txtcari").keyup(function() {
            var strcari = $("#txtcari").val(); //mendapatkan nilai dari textbox 
            if (strcari != "") //jika value strcari tidak kosong-->
            {
                $("#hasil").html("<img src='ajax.gif'/>") // menampilkan animasi loading 
                //request data ke cari.php lalu menampilkan ke <div id="hasil"></div>
                $.ajax({
                    type: "post",
                    url: "kasir/cari/cari-barang.php",
                    data: "q=" + strcari,
                    success: function(data) {
                        $("#hasil").html(data);
                    }
                });
            }
        });
    });
</script>
<div class="col-sm-10" style="background:#ddd;color:#111">
    <!------------TABEL DISINI--------------->
    <div class="form-group">
        <label class="col-sm-3 btn btn-danger">MASUKKAN NAMA BARANG <i class="fa fa-hand-o-right"></i></label>
        <div class="col-sm-9">
            <div class="input-group">
                <span class="input-group-addon" style="background:#111"><i class="fa fa-server"></i></span>
                <input class="form-control" placeholder="Nama Barang" type="text" name="textcari" id="txtcari" />
            </div>
        </div>
    </div>



    <div id="hasil" class="col-sm-12"></div>


    <!--------SELECT DROPDOWN SELECTION------------------>
    <div class="row col-md-12 custyle table-responsive">
        <table class="table table-striped custab">
            <thead>

                <tr>
                    <th>KODE TOKO</th>
                    <th>KODE</th>
                    <th>BARANG</th>
                    <th>SATUAN</th>
                    <th>KATEGORI</th>
                    <th>WARNA</th>
                    <th>UKURAN</th>
                    <th>HARGA</th>
                    <th>STOK</th>
                </tr>
            </thead>


            <?php
            include('inc/koneksi.php');
            $a = mysqli_query($koneksi, "SELECT tabel_barang.kd_barang,tabel_barang.nm_barang, tabel_barang.kd_satuan, tabel_barang.kd_kategori, tabel_barang.warna, tabel_barang.ukuran, tabel_barang.hrg_jual,tabel_stok_toko.kd_toko, tabel_stok_toko.kd_barang,tabel_stok_toko.stok FROM tabel_barang
JOIN tabel_stok_toko ON tabel_stok_toko.kd_barang = tabel_barang.kd_barang");
            while ($d = mysqli_fetch_array($a)) {
            ?>
                <tr>
                    <td><?php echo $d['kd_toko'] ?></td>
                    <td><?php echo $d['kd_barang'] ?></td>
                    <td><?php echo $d['nm_barang'] ?></td>
                    <td><?php echo $d['kd_satuan'] ?></td>
                    <td><?php echo $d['kd_kategori'] ?></td>
                    <td><?php echo $d['warna'] ?></td>
                    <td><?php echo $d['ukuran'] ?></td>
                    <td><?php echo $d['hrg_jual'] ?></td>
                    <td><?php echo $d['stok'] ?></td>
                </tr><?php } ?>


        </table>
    </div>