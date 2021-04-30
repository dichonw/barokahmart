<!--link href="../script/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../script/css/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
<link href="../script/css/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="../script/date/css/datepicker.css" rel="stylesheet" /-->
<link href="../script/css/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<script src="script/export/jquery.table2excel.js"></script>
<?php
//untuk koneksi database
include "inc/koneksi.php";

//untuk menantukan tanggal awal dan tanggal akhir data di database
$min_tanggal = mysqli_fetch_array(mysqli_query($koneksi, "SELECT MIN(tgl_pembelian) AS min_tanggal FROM tabel_pembelian"));
$max_tanggal = mysqli_fetch_array(mysqli_query($koneksi, "SELECT MAX(tgl_pembelian) AS max_tanggal FROM tabel_pembelian"));
?>

<form action="?menu=beli" method="post" name="postform">
  <div class="row">
    <div class="col-sm-4">
      <!------TABEL---------->
      <div class="panel-body panel-warning">
        <h4 class="box-header"><i class="fas fa-cart-arrow-down"></i> Data Pembelian</h4>

        <div class="input-group date mb-2">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
          </div>
          <input type="text" name="tanggal_awal" class="tanggal form-control" value="<?php echo $min_tanggal['min_tanggal']; ?>" />
        </div>

        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
          </div>
          <input type="text" name="tanggal_akhir" class="tanggal2 form-control" value="<?php echo $max_tanggal['max_tanggal']; ?>" />
        </div>


        <input type="submit" value="Tampilkan Data" name="cari" class="btn btn-primary">
</form>
<!--a href="javascript:printDiv('pricelist');" class="btn btn-default">PRINT <i class="fa fa-print"></i></a-->
</div>
</div>



<div class="col-sm-8">
  <!------TABEL---------->
  <div id="pricelist" class="print-area">
    <p>
      <?php
      if (isset($_POST['cari'])) {
        $tanggal_awal = $_POST['tanggal_awal'];
        $tanggal_akhir = $_POST['tanggal_akhir'];
        if (empty($tanggal_awal) and empty($tanggal_akhir)) {
          //jika tidak menginput apa2
          $query = mysqli_query($koneksi, "SELECT * FROM tabel_pembelian");
          $jumlah = mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(total_pembelian) AS total FROM tabel_pembelian"));
        } else {
      ?><i><b>Data Pembelian : </b> Pencarian dari tanggal <b><?php echo $_POST['tanggal_awal'] ?></b> sampai dengan tanggal <b><?php echo $_POST['tanggal_akhir'] ?></b></i><?php

                                                                                                                                                                              $query = mysqli_query($koneksi, "SELECT * FROM tabel_pembelian WHERE tgl_pembelian BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
                                                                                                                                                                              $jumlah = mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(total_pembelian) AS total FROM tabel_pembelian WHERE tgl_pembelian BETWEEN '$tanggal_awal' AND '$tanggal_akhir'"));
                                                                                                                                                                            }
                                                                                                                                                                              ?>
    </p>
    <div class="panel-body panel-default">
      <div class="table-responsive">
        <button class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Export excel</button>
        <table id="demo-export" class="table table-bordered" style="font-size:11px">
          <tr>
            <th>No</th>
            <th>Faktur</th>
            <th>Tanggal</th>
            <th>Konsumen</th>
            <th>Penjualan</th>
            <th>Barang</th>
            <th>Kasir</th>
          </tr>
          <?php
          //untuk penomoran data
          $no = 0;
          //menampilkan data
          while ($row = mysqli_fetch_array($query)) {
          ?>
            <tr>
              <td><?php echo $no = $no + 1; ?></td>
              <td><?php echo $row['no_faktur_pembelian']; ?></td>
              <td><?php echo $row['tgl_pembelian']; ?></td>
              <td><?php $b = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_supplier WHERE tabel_supplier.kd_supplier = '$row[kd_supplier]'")); ?><?php echo $b['nm_supplier'] ?></td>
              <td><?php echo number_format($row['total_pembelian'], 2, ',', '.'); ?></td>
              <td>
                <?php $c = mysqli_query($koneksi, "SELECT * FROM tabel_barang, tabel_rinci_pembelian WHERE tabel_barang.kd_barang = tabel_rinci_pembelian.kd_barang AND tabel_rinci_pembelian.no_faktur_pembelian = '$row[no_faktur_pembelian]' ");
                while ($d = mysqli_fetch_array($c)) {
                ?>

                  Barang : <?php echo $d['nm_barang'] ?> Jumlah : <?php echo $d['jumlah'] ?> <br>
                <?php } ?>
              </td>
              <td><?php $e = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_user WHERE tabel_user.id_user = '$row[id_user]'")); ?><?php echo $e['nm_user'] ?></td>
            </tr>
          <?php
          }
          ?>
          <tr>
            <th colspan="6">TOTAL</th>
            <th><?php echo number_format($jumlah['total'], 2, ',', '.'); ?></th>
          </tr>

          <tr>
            <td colspan="6">
              <?php
              //jika data tidak ditemukan
              if (mysqli_num_rows($query) == 0) {
                echo "<font color=red><blink>Tidak ada data yang dicari!</blink></font>";
              }
              ?>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
<?php } else {
        unset($_POST['cari']);
      } ?>

<script src="../script/date/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.tanggal').datepicker({
      format: "yyyy-mm-dd",
      autoclose: true
    });
  });
  $(document).ready(function() {
    $('.tanggal2').datepicker({
      format: "yyyy-mm-dd",
      autoclose: true
    });
  });
</script>
<script>
  $(function() {
    $("button").click(function() {
      $("#demo-export").table2excel({
        filename: "laporan beli",
        name: "Hosting Packages",
        fileext: ".xls",
        exclude_img: true,
        exclude_links: true,
        exclude: ".dntinclude",
        exclude_inputs: true
      });
    });
  });
</script>