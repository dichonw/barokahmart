<!doctype html>
<html class="">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>.:Aplikasi Kasir:.</title>
  <link href="../script/css/boilerplate.css" rel="stylesheet" type="text/css">
  <link href="../script/css/style.css" rel="stylesheet" type="text/css">
  <link href="../script/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../script/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css">
  <link href="../script/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css">
  <link href="../script/css/font/css/fontawesome.min.css" rel="stylesheet" type="text/css">
  <link href="../script/css/font/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../script/css/bootstrap/css/jquery-ui.css" rel="stylesheet" type="text/css">
  <link href="../script/css/paketKBK.css" rel="stylesheet" type="text/css">

  <script src="../respond.min.js"></script>
  <script src="../script/js/jquery.min.js"></script>
  <script src="../script/js/bootstrap.min.js"></script>



</head>

<body>

  <!-- new login start -->
  <section class="login-block">
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-4 banner-sec bg-primary">
          <div class="signup__overlay"></div>
          <div class="banner">
            <div id="demo" class="carousel slide carousel-fade" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="../images/logo-4.png" class="img-fluid mt-5">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8 login-sec">
          <!--h2 class="text-center">Login Now</h2-->
          <h4 class="text-center text-danger">MASA AKTIF APLIKASI AKAN SEGERA BERAKHIR, SEGERA HUBUNGI ADMINISTRATOR</h4>
          <small class="text-center"><?php
                                      date_default_timezone_set('Asia/Jakarta');
                                      $sekarang = new DateTime();
                                      $menit = $sekarang->getOffset() / 60;
                                      $tanda = ($menit < 0 ? -1 : 1);
                                      $menit = abs($menit);
                                      $jam = floor($menit / 60);
                                      $menit -= $jam * 60;
                                      $offset = sprintf('%+d:%02d', $tanda * $jam, $menit);
                                      $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
                                      $bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                                      echo $hari[date("w")] . ", " . date("j") . " " . $bulan[date("n")] . " " . date("Y");
                                      ?> | <?php echo date("H:i:s"); ?></small>
          <form class="login100-form validate-form" action="p_login_toko.php" method="post" id="login_toko">
            <div class="wrap-input100 validate-input">
              <span class="label-input100">Store Name</span>
              <select name="kd_toko" id="kd_toko" class="input100 form-control bg-transparent">
                <?php include('../inc/koneksi.php');
                $query_toko = mysqli_query($koneksi, "SELECT * FROM tabel_toko");
                while ($result_toko = mysqli_fetch_array($query_toko)) {
                  $kd_toko = $result_toko['kd_toko'];
                  $nm_toko = $result_toko['nm_toko'];
                  echo "<option value=" . $kd_toko . ">" . $nm_toko . "</option>";
                }
                ?>
              </select>
              <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input">
              <span class="label-input100">Password</span>
              <input class="input100" type="password" name="password" id="password" placeholder="Type your password">
              <span class="focus-input100 password"></span>
            </div>

            <div class="text-right p-t-8 p-b-31">
              <a href="#">
                Forgot password?
              </a>
            </div>

            <div class="container-login100-form-btn">
              <div class="wrap-login100-form-btn">
                <button class="btn btn-primary mr-2" name="button_login" type="submit">
                  Login
                </button>
                <button class="btn btn-primary mr-2" name="button_reset" type="reset">
                  Reset
                </button>
              </div>
            </div>
          </form>
          <hr>
          <div class="copy-text">© <?php echo date('Y'); ?> Copyright:
            <a href="#"> <img src="../images/logo-2.png" width="150"></a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- new login end -->
</body>

</html>