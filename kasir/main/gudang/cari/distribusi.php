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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title></title>

</head>

<body>
  <div class="clearfix"></div>
  <?php if ($status_user == "manager" || $status_user == "admin") { ?>

    <div class="col-sm-4">
      <div class="panel-body panel-warning">
        <form action="update_distribusi.php" method="post" id="form_filter">

          <label>Dari Toko</label>

          <select name="kd_toko_pusat" class="form-control">
            <?php
            $a = mysqli_query($koneksi, "SELECT * FROM tabel_toko WHERE kd_toko='$_SESSION[kd_toko]'");
            while ($d = mysqli_fetch_array($a)) {
            ?>
              <option value="<?php echo $d['kd_toko'] ?>"><?php echo $d['nm_toko'] ?></option>
            <?php } ?>
          </select>


          <label>Pilih Barang</label>
          <select name="kd_barang_pusat" id="id_harga" onChange="changeValue(this.value)" class="form-control">
            <option value=0>---Pilih---</option>
            <?php
            $result = mysqli_query($koneksi, "SELECT 
				tabel_barang.kd_barang,
				tabel_barang.nm_barang,
				tabel_barang.merek,
				tabel_barang.jenis,
				tabel_barang.tipe,
				tabel_barang.model,
				tabel_stok_toko.kd_barang,
				tabel_stok_toko.stok
				FROM tabel_barang,tabel_stok_toko WHERE tabel_barang.kd_barang = tabel_stok_toko.kd_barang AND tabel_stok_toko.kd_toko='$_SESSION[kd_toko]'");
            $jsArray = "var brg = new Array();\n";
            while ($row = mysqli_fetch_array($result)) {
              echo '<option value="' . $row['kd_barang'] . '">' . $row['nm_barang'] . '&nbsp;: &nbsp;' . $row['merek'] . ' - ' . $row['jenis'] . ' - ' . $row['tipe'] . ' - ' . $row['model'] . '</option>';
              $jsArray .= "brg['" . $row['kd_barang'] . "'] = {
							stok:'" . addslashes($row['stok']) . "',
							kd_barang:'" . addslashes($row['kd_barang']) . "'};\n";
            }
            ?>
          </select>

          <label>Stok Gudang Pusat</label>
          <input type="text" name="stok_pusat" id="stok" class="form-control">
      </div>
    </div>
    <div class="col-sm-4">
      <h3 class="text-center">Di Distribusikan ke
        <br /><i class="fa fa-caret-right fa-4x"></i>
      </h3>

    </div>
    <div class="col-sm-4">
      <div class="panel-body panel-warning">
        <label>Ke Toko</label>
        <!--input type="text" name="kd_toko_cabang" class="form-control" /-->
        <select name="kd_toko_cabang" class="form-control">
          <?php
          //$a=mysql_query("SELECT * FROM tabel_toko WHERE kd_toko='$_SESSION[kd_toko]'");
          $a = mysqli_query($koneksi, "SELECT * FROM tabel_toko");
          while ($d = mysqli_fetch_array($a)) {
          ?>
            <option value="<?php echo $d['kd_toko'] ?>"><?php echo $d['nm_toko'] ?></option>
          <?php } ?>
        </select>

        <label>Kode Barang</label>
        <input name="kd_barang_cabang" id="kd_barang" class="form-control" placeholder="Kode Barang Cabang" readonly="" />
        <!--select name="kd_barang_cabang" class="form-control">
            <option value="">PILIH KODE BARANG </option>
        <!?php
        $query_barang=mysql_query("SELECT kd_barang FROM tabel_barang");
        while($result_barang=mysql_fetch_array($query_barang)){
        $kd_barang=$result_barang['kd_barang'];
        echo"<option value=".$kd_barang.">".$kd_barang."</option>";
        }
        ?>
    </select-->
        <label>Stok Barang Cabang</label>
        <input type="text" class="form-control" name="stok_cabang" placeholder="Stok Toko Cabang" />
      </div>
    </div>
    <div class="col-sm-12 text-center">
      <input type="submit" name="SIMPAN" id="button" value="Submit" class="btn btn-danger" />
    </div>

    </form>

  <?php } ?>

  <!---======================================IKLAN POPUP=================================----------->

  <div id="modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <span style="font-size:36px">PENTING</span>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <p>Untuk mendistribusikan <b>barang</b><br /> <b>Barang dan toko cabang</b> harus di daftarkan terlebih dahulu!</p>
        </div>
        <div class="modal-footer">
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!---======================================IKLAN POPUP=================================----------->

  <script type="text/javascript">
    <?php echo $jsArray; ?>

    function changeValue(kd_barang) {
      document.getElementById('kd_barang').value = brg[kd_barang].kd_barang;
      document.getElementById('stok').value = brg[kd_barang].stok;
    };
  </script>
  <script>
    $('#modal').modal('show');
  </script>
</body>

</html>