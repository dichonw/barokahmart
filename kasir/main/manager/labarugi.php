<?php
//untuk koneksi database
//include "../inc/koneksi.php";

//untuk menantukan tanggal awal dan tanggal akhir data di database
$min_tanggal = mysqli_fetch_array(mysqli_query($koneksi, "SELECT MIN(tgl_penjualan) AS min_tanggal FROM tabel_penjualan"));
$max_tanggal = mysqli_fetch_array(mysqli_query($koneksi, "SELECT MAX(tgl_penjualan) AS max_tanggal FROM tabel_penjualan"));
?>

<form action="?menu=labarugi" method="post" name="postform">
  <div class="row">
    <div class="col-sm-4">
      <!------TABEL---------->
      <div class="panel-body panel-warning">
        <h4 class="box-header"><i class="fas fa-balance-scale"></i> Data Laba Penjualan</h4>

        <div class="input-group date mb-2">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
          </div>
          <input type="text" name="tanggal_awal" class="tanggal form-control" value="<?php echo $min_tanggal['min_tanggal']; ?>" />
        </div>

        <div class="input-group date mb-2">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
          </div>
          <input type="text" name="tanggal_akhir" class="tanggal2 form-control" value="<?php echo $max_tanggal['max_tanggal']; ?>" />
        </div>



        <input type="submit" value="Tampilkan Data" name="cari" class="btn btn-primary">
</form>
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
          $query = mysqli_query($koneksi, "SELECT * FROM tabel_penjualan,tabel_rinci_penjualan");
          $jumlah = mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(total_penjualan) AS total FROM tabel_penjualan"));
        } else {
      ?><i><b>Informasi : </b> Pencarian dari tanggal <b><?php echo $_POST['tanggal_awal'] ?></b> sampai dengan tanggal <b><?php echo $_POST['tanggal_akhir'] ?></b></i>
        <?php
          $query = mysqli_query($koneksi, "SELECT * FROM tabel_penjualan,tabel_rinci_penjualan WHERE tgl_penjualan BETWEEN '$tanggal_awal' AND '$tanggal_akhir' AND tabel_penjualan.no_faktur_penjualan = tabel_rinci_penjualan.no_faktur_penjualan");
          $jumlah = mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(total_penjualan) AS total FROM tabel_penjualan,tabel_rinci_penjualan WHERE tgl_penjualan BETWEEN '$tanggal_awal' AND '$tanggal_akhir' AND tabel_penjualan.no_faktur_penjualan = tabel_rinci_penjualan.no_faktur_penjualan"));
        }
        ?>
    </p>
    <div class="panel-body panel-default">
      <div class="table-responsive">
        <button class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Export excel</button>
        <table id="demo-export" class="table table-bordered" style="font-size:11px">
          <tr>
            <th>Faktur</th>
            <th>Tanggal</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Beli</th>
            <th>Jual</th>
            <th>Laba</th>
          </tr>
          <?php
          //untuk penomoran data
          $no = 0;
          //menampilkan data
          while ($row = mysqli_fetch_array($query)) {
            $barang = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_barang WHERE kd_barang='$row[kd_barang]'"));
            $beli   = $barang['hrg_beli'];
            $jual   = $barang['hrg_jual'];
            $jml   = $row['jumlah'];
            $hitung  = ($jual - $beli) * $jml;
            $total  += $hitung;

          ?>
            <tr>
              <td><?php echo $row['no_faktur_penjualan']; ?></td>
              <td><?php echo $row['tgl_penjualan']; ?></td>
              <td><?php echo $barang['nm_barang']; ?></td>
              <td><?php echo $jml; ?></td>
              <td><?php echo $beli; ?></td>
              <td><?php echo $jual; ?></td>
              <td><?php echo number_format($hitung, 2, ',', '.'); ?></td>
            </tr>
          <?php
          }
          ?>
          <tr>
            <th colspan="6">TOTAL LABA PENJUALAN</th>
            <th><?php echo number_format($total, 2, ',', '.'); ?></th>
          </tr>

          <tr>
            <td colspan="7">
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
        filename: "laporan laba rugi <?php echo $_POST['tanggal_awal'] ?>-<?php echo $_POST['tanggal_akhir'] ?>",
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