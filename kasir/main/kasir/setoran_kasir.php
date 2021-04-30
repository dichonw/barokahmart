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
<?php
if (isset($_POST['button'])) {
      $tgl_awal = $_POST['tgl_awal'];
      $bln_awal = $_POST['bln_awal'];
      $thn_awal = $_POST['thn_awal'];
      $tanggal_awal = $thn_awal . $bln_awal . $tgl_awal;
      $tgl_akhir = $_POST['tgl_akhir'];
      $bln_akhir = $_POST['bln_akhir'];
      $thn_akhir = $_POST['thn_akhir'];
      $tanggal_akhir = $thn_akhir . $bln_akhir . $tgl_akhir;
      $id_user = $_POST['id_user'];
      $query_setoran = mysqli_query($koneksi, "SELECT * FROM tabel_penjualan WHERE id_user='" . $id_user . "' AND tgl_penjualan BETWEEN '" . $tanggal_awal . "' AND '" . $tanggal_akhir . "'");
} else {
      $id_user = $_SESSION['id_user'];
      $query_setoran = mysqli_query($koneksi, "SELECT * FROM tabel_penjualan WHERE id_user='" . $id_user . "'");
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

<body>
      <div class="panel-body panel-warning">
            <!---------------------------------KIRI----------------------------------------->
            <div class="col-sm-6">
                  <h5 class="btn btn-primary"><i class="fa fa-search"></i> Form</h5>
                  <hr />
                  <div class="col-sm-4">
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="form_filter">
                              <label>Tanggal Awal </label>
                              <select name="tgl_awal" size="1" id="tgl_awal" class="form-control">
                                    <?php
                                    for ($i = 1; $i <= 31; $i++) {
                                          if ($i < 10) {
                                                $i = "0" . $i;
                                          }
                                          echo "<option value=" . $i . ">" . $i . "</option>";
                                    }
                                    ?>
                              </select>
                              <label>Bulan</label>
                              <select name="bln_awal" size="1" id="bln_awal" class="form-control">
                                    <?php
                                    for ($i = 1; $i <= 12; $i++) {
                                          if ($i < 10) {
                                                $i = "0" . $i;
                                          }
                                          echo "<option value=" . $i . ">" . $i . "</option>";
                                    }
                                    ?>

                              </select>
                              <label>Tahun</label>
                              <select name="thn_awal" size="1" id="thn_awal" class="form-control">
                                    <?php
                                    for ($i = 2017; $i <= date('Y'); $i++) {
                                          if ($i < 10) {
                                                $i = "0" . $i;
                                          }
                                          echo "<option value=" . $i . ">" . $i . "</option>";
                                    }
                                    ?>

                              </select>
                  </div>
                  <!---------------------------------TENGAH----------------------------------------->
                  <div class="col-sm-4">
                        <label>Tanggal Akhir</label>
                        <select name="tgl_akhir" size="1" id="tgl_akhir" class="form-control">
                              <?php
                              for ($i = 1; $i <= 31; $i++) {
                                    if ($i < 10) {
                                          $i = "0" . $i;
                                    }
                                    echo "<option value=" . $i . ">" . $i . "</option>";
                              }
                              ?>
                        </select>

                        <label>Bulan Akhir</label>
                        <select name="bln_akhir" size="1" id="bln_akhir" class="form-control">
                              <?php
                              for ($i = 1; $i <= 12; $i++) {
                                    if ($i < 10) {
                                          $i = "0" . $i;
                                    }
                                    echo "<option value=" . $i . ">" . $i . "</option>";
                              }
                              ?>
                        </select>
                        <label>Tahun Akhir</label>
                        <select name="thn_akhir" size="1" id="thn_akhir" class="form-control">
                              <?php
                              for ($i = 2017; $i <= date('Y'); $i++) {
                                    if ($i < 10) {
                                          $i = "0" . $i;
                                    }
                                    echo "<option value=" . $i . ">" . $i . "</option>";
                              }
                              ?>
                        </select>
                  </div>
                  <div class="col-sm-4">
                        <label>Id User</label>
                        <input name="id_user" type="text" id="id_user" value="<?php echo $_SESSION['id_user']; ?>" size="10" readonly class="form-control" />
                        <input type="submit" name="button" id="button" value="Submit" class="btn btn-default btn-lg" />
                        <input type="submit" name="button2" id="button2" value="All" class="btn btn-default btn-lg" /></td>

                        </form>
                  </div>
            </div>
            <!---------------------------------KANAN----------------------------------------->
            <div class="col-sm-6">
                  <h5 class="btn btn-primary"><i class="fa fa-database"></i> Data</h5>
                  <hr />
                  <table class="table stats caps">
                        <thead>
                              <tr class="header_footer">
                                    <th>No. Faktur</th>
                                    <th class="hidden-phone">Tanggal Penjualan</th>
                                    <th>Total Penjualan</th>
                                    <?php if ($status_user == "manager" || $status_user == "admin") { ?>
                                          <th>Edit</th><?php } ?>
                              </tr>
                              <?php
                              $total_seluruh = 0;
                              while ($setoran = mysqli_fetch_array($query_setoran)) {
                                    $no_faktur = $setoran['no_faktur_penjualan'];
                                    $tgl_penjualan = $setoran['tgl_penjualan'];
                                    $total_penjualan = $setoran['total_penjualan'];
                                    $total_seluruh = $total_penjualan + $total_seluruh;
                              ?>

                                    <tr class="isi_tabel">
                                          <td><?php echo $no_faktur; ?>&nbsp;</td>
                                          <td class="hidden-phone"><?php echo $tgl_penjualan; ?>&nbsp;</td>
                                          <td>Rp. <?php echo number_format($total_penjualan, 0, ".", "."); ?></td><?php } ?>
                                    <td><a href="delete_setoran.php?no_faktur_penjualan=<?php echo $no_faktur; ?>" class="btn btn-danger btn-xs fa fa-trash-o" title="Hapus Setoran"><i class="icon icon-trash"></i></a></td>
                                    </tr>

                                    <tr class="header_footer">
                                          <th colspan="2" align="right">Total Setoran</th>
                                          <td align="left">Rp. <?php echo number_format($total_seluruh, 0, ".", "."); ?></td>
                                    </tr>
                  </table>
            </div>
      </div>

</body>

</html>