<?php
if (isset($_GET['no_faktur_penjualan']) && ($_GET['kd_barang'])) {
  $faktur    = $_GET['no_faktur_penjualan'];
  $kd_barang  = $_GET['kd_barang'];
  $query_update = "SELECT * FROM 
				tabel_penjualan,
				tabel_rinci_penjualan,
				tabel_barang WHERE 
				tabel_penjualan.no_faktur_penjualan='" . $faktur . "' AND 
				tabel_rinci_penjualan.no_faktur_penjualan='" . $faktur . "' AND 
				tabel_rinci_penjualan.kd_barang='" . $kd_barang . "' AND 
				tabel_barang.kd_barang ='" . $kd_barang . "' ";
  $retur_update = mysqli_query($koneksi, $query_update);
  $data_retur_update = mysqli_fetch_array($retur_update);

  $faktur_update    = $data_retur_update['no_faktur_penjualan'];
  $tgl_update      = $data_retur_update['tgl_penjualan'];
  $barang_update    = $data_retur_update['kd_barang'];
  $supplier_update  = $data_retur_update['kd_supplier'];
  $user_update    = $data_retur_update['id_user'];
  $nama_update    = $data_retur_update['nm_barang'];
  $warna_update    = $data_retur_update['warna'];
  $ukuran_update    = $data_retur_update['ukuran'];
  $jual_update    = $data_retur_update['hrg_jual'];
}
?>
<!doctype html>
<html class="">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>.:Aplikasi Kasir:.</title>
  <?php
  if (isset($_GET['do']) == "update") {
    $param = 2;
  } else {
    $param = 1;
  }
  ?>
</head>

<body>
  <div class="panel-body panel-warning">
    <div class="col-sm-8">
      <!------TABEL---------->

      <?php
      include "../inc/koneksi.php";
      ?>

      <form class="navbar-form navbar-search" role="search" method="post">
        <div class="input-group">
          <input type="text" name="no_faktur_penjualan" placeholder="Cari Faktur" class="form-control">
          <div class="input-group-btn">
            <button type="submit" class="btn btn-search btn-info" name="cari2">
              <span class="glyphicon glyphicon-search"></span>
              <span class="label-icon">Search</span>
            </button>
          </div>
        </div>
      </form>

      <table class="table table-bordered">
        <tr>
          <th>No Faktur</th>
          <th>Tanggal</th>
          <th>Nama Barang</th>
          <th>Spec.</th>
          <th>Jumlah</th>
          <th>Retur</th>
          <th>Total</th>
          <th>Edit</th>
        </tr>
        <?php if (isset($_POST['cari2'])) {
          $cari = $_POST['no_faktur_penjualan'];
          $sql = "SELECT * FROM tabel_penjualan,tabel_rinci_penjualan WHERE tabel_penjualan.no_faktur_penjualan LIKE '%$cari%' AND tabel_rinci_penjualan.no_faktur_penjualan LIKE '%$cari%'  ";
          $query = mysqli_query($koneksi, $sql);
          while ($data = mysqli_fetch_array($query)) {
        ?>
            <tr>
              <td><?php echo $data['no_faktur_penjualan']; ?></td>
              <td><?php echo $data['tgl_penjualan']; ?></td>
              <td><?php echo $data['nm_barang']; ?></td>
              <td><?php echo $data['warna']; ?> <?php echo $data['ukuran']; ?>
              <td><?php echo $data['jumlah']; ?></td>
              <td><?php $c = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_rinci_retur WHERE kd_barang = '$data[kd_barang]' AND no_faktur_retur = '$data[no_faktur_penjualan]' ")); ?>
                <?php echo $c['jumlah'] ?>
              </td>
              <td>Rp. <?php echo number_format($sub_total_retur, 0, ".", "."); ?></td>
              <td>
                <a href="<?php echo $_SERVER['PHP_SELF'] ?>?menu=retur&kd_barang=<?php echo $data['kd_barang']; ?>&no_faktur_penjualan=<?php echo $data['no_faktur_penjualan']; ?>&do=update" class="btn btn-default"><i class="fa fa-refresh"></i> Retur</a>
              </td>

          <?php }
        } ?>
            </tr>
      </table>

    </div>
    <div class="col-sm-4">
      <!------FORM---------->
      <h4 class="btn btn-default"><i class="fa fa-eject"></i> Retur Pembelian</h4>
      <hr />
      <form action="proses_faktur_pelanggan.php" method="post">
        <input name="supplier" type="hidden" class="form-control" value="<?php echo $supplier_update; ?>" readonly />
        <input name="user" type="hidden" class="form-control" value="<?php echo $user_update; ?>" readonly />
        <input name="kd_barang" type="hidden" class="form-control" value="<?php echo $barang_update; ?>" readonly />
        <input name="warna" type="hidden" class="form-control" value="<?php echo $warna_update; ?>" readonly />
        <input name="hrg_jual" type="hidden" class="form-control" value="<?php echo $jual_update; ?>" readonly />

        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
            <input name="no_faktur_retur" type="text" class="form-control" value="<?php echo $faktur_update; ?>" readonly />
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
            <input name="tgl_retur" type="text" id="tgl_penjualan" class="form-control" value="<?php echo $tgl_update; ?>" readonly />
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
            <input type="text" name="nm_barang" id="kd_barang" value="<?php echo $nama_update; ?>" class="form-control" readonly />
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
            <input name="ukuran" type="text" class="form-control" value="<?php echo $ukuran_update; ?>" readonly />
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
            <input name="jumlah" id="jumlah" type="text" class="form-control" placeholder="Jumlah yang di retur" />
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
            <textarea name="ket" class="form-control" placeholder="Tulis keterangan retur"></textarea>
          </div>
        </div>

        <input type="submit" name="button_edit" id="button_edit" value="RETUR PEMBELIAN" class="btn btn-default" />
      </form>

    </div>
  </div>
  <!------FORM---------->


</body>

</html>