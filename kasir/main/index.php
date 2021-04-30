<?php
session_start();
error_reporting(0);
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
include('inc/koneksi.php');
if (isset($_SESSION['kd_toko'])) {
  $query_info_toko = mysqli_query($koneksi, "SELECT * FROM tabel_toko,tabel_user WHERE tabel_toko.kd_toko='" . $_SESSION['kd_toko'] . "' AND tabel_user.kd_toko='" . $_SESSION['kd_toko'] . "'");
  $info_toko = mysqli_fetch_array($query_info_toko);
  $nm_toko  = $info_toko['nm_toko'];
  $almt_toko  = $info_toko['almt_toko'];
  $tlp_toko  = $info_toko['tlp_toko'];
  $fax_toko  = $info_toko['fax_toko'];
  $logo_toko  = $info_toko['logo'];
  $id_user  = $info_toko['id_user'];
  $nm_user  = $info_toko['nm_user'];
  $header = true;
}
?>

<!doctype html>
<html class="">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="refresh" content="1000; url=">
  <title>.:Kasir <?php echo $status_user ?>:.</title>
  <link href="script/css/boilerplate.css" rel="stylesheet" type="text/css">
  <link href="script/css/style.css" rel="stylesheet" type="text/css">
  <link href="script/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="script/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css">
  <link href="script/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css">
  <link href="script/css/font/css/fontawesome.min.css" rel="stylesheet" type="text/css">
  <link href="script/css/font/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="script/css/bootstrap/css/jquery-ui.css" rel="stylesheet" type="text/css">
  <link href="script/css/paketKBK.css" rel="stylesheet" type="text/css">
  <link href="script/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css">
  <link href="script/date/css/datepicker.css" rel="stylesheet" type="text/css">
  <link data-require="bootstrap-select@*" data-semver="1.13.5" rel="stylesheet" href="script/autocomplete/bootstrap-select.css">


  <script src="script/respond.min.js"></script>
  <!--script src="script/js/jquery.min.js"></script>
<script src="script/js/bootstrap.min.js"></script-->



  <script data-require="jquery@*" data-semver="3.2.1" src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
  <script data-require="popper.js@*" data-semver="1.12.9" src="https://unpkg.com/popper.js@1.12.9/dist/umd/popper.min.js"></script>
  <script data-require="bootstrap@*" data-semver="4.1.3" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script data-require="bootstrap-select@*" data-semver="1.13.5" src="script/autocomplete/bootstrap-select.js"></script>

  <?php
  if (isset($_GET['do']) == "update") {
    $param = 2;
  } else {
    $param = 1;
  }
  ?>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="?menu=home"><i class="fas fa-calculator"></i> Kasir</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?menu=stok"><i class="fas fa-clipboard-list"></i> Data barang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?menu=kategori"><i class="fas fa-th-list"></i> Kategori Barang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?menu=barang"><i class="fas fa-box-open"></i> Input Barang Baru</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?menu=promo"><i class="fas fa-bullhorn"></i> Promo</a>
        </li>

        <!--li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-box-open"></i> Barang </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="?menu=stok"><i class="fas fa-clipboard-list"></i> Data Barang</a>                      
                      <div class="dropdown-divider"></div>                      
                      <a class="dropdown-item" href="?menu=general"><i class="fas fa-qrcode"></i> Buat Code Barang</a>
                      <a class="dropdown-item" href="?menu=kategori"><i class="fas fa-th-list"></i> Kategori Barang</a>
                      <a class="dropdown-item" href="?menu=data_sup"><i class="fas fa-truck-loading"></i> Buat Data Suplier</a>                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="?menu=barang"><i class="fas fa-box-open"></i> Input Barang Baru</a>
                      <a class="dropdown-item" href="?menu=pembelian"><i class="fas fa-cart-arrow-down"></i> Belanja Barang</a>
                      <a class="dropdown-item" href="?menu=suplier"><i class="fas fa-luggage-cart"></i> Retur Barang</a>
                      
                    </div>
                  </li-->
        <li class="nav-item">
          <a class="nav-link" href="?menu=jual"><i class="fas fa-shopping-cart"></i> Penjualan</a>
        </li>
        <!--li class="nav-item">
                    <a class="nav-link" href="?menu=sirkulasi"><i class="fas fa-chart-bar"></i> Sirkulasi Barang</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="?menu=labarugi"><i class="fas fa-balance-scale"></i> Laba</a>
                  </li-->
        <li class="nav-item">
          <a class="nav-link" href="?menu=member"><i class="fas fa-user"></i> Member</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?menu=shop"><i class="fas fa-store"></i> Toko Saya</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?menu=branch-shop"><i class="fas fa-store"></i> Tambah Cabang</a>
        </li>
        <!--li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-paste"></i> Laporan </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="?menu=jual"><i class="fas fa-shopping-cart"></i> Penjualan</a>
                      <a class="dropdown-item" href="?menu=sirkulasi"><i class="fas fa-chart-bar"></i> Sirkulasi Barang</a>
                      <a class="dropdown-item" href="?menu=labarugi"><i class="fas fa-balance-scale"></i> Laba</a>
                      <a class="dropdown-item" href="?menu=beli"><i class="fas fa-cart-arrow-down"></i> Pembelian</a>
                      <a class="dropdown-item" href="?menu=retur"><i class="fas fa-luggage-cart"></i> Retur</a>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="?menu=laporan"></a>
                  </li-->

      </ul>
      <ul class="navbar-nav mr-0 float-right">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-lock"></i> Pengguna</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="?menu=user">Edit Pengguna</a>
            <a class="dropdown-item" href="akses/logout.php">Keluar</a>
          </div>
        </li>
      </ul>
      <!--form class="form-inline my-2 my-lg-0">
                  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form-->
    </div>
  </nav>
  <!-- MAIN -->
  <div class="col p-4 mb-5">
    <?php $sql_user = mysqli_query($koneksi, "select * from tabel_penjualan WHERE sisa = 'WAIT'");
    $jumlah_tunggu = mysqli_num_rows($sql_user); ?>
    <a href="?menu=cek" class="btn btn-dark float-right">Ada
      <span class="badge badge-primary"><?php echo $jumlah_tunggu ?></span> daftar tunggu pengiriman, Cek sekarang juga</a>

    <h3 class="text-uppercase"><img src="images/logo-2.png" width="150"> | <small><strong>Kasir : </strong><?php echo $_SESSION['nm_user']; ?></small></h3>

    <div class="card">
      <div class="card-body">

        <?php
        if (isset($_GET['menu'])) {
          $menu = $_GET['menu'];
          switch ($menu) {
            case ('home');
              include('kasir/penjualan.php');
              break;
            case ('grosir');
              include('kasir/grosir.php');
              break;
            case ('jumlah');
              include('kasir/proses_hitung_barang.php');
              break;
            case ('jml');
              include('kasir/proses_hitung_grosir.php');
              break;
            case ('simpantr');
              include('kasir/update_stok.php');
              break;
            case ('cek');
              include('manager/cek_jual.php');
              break;
            case ('barang');
              include('master_data/data_barang.php');
              break;
            case ('gambar');
              include('master_data/data_barang_gambar.php');
              break;
            case ('stok');
              include('gudang/stok_barang.php');
              break;
            case ('del_brg');
              include('master_data/delete_barang.php');
              break;
            case ('del_gbr');
              include('master_data/delete_barang_gambar.php');
              break;
            case ('kategori');
              include('master_data/kategori_barang.php');
              break;
            case ('promo');
              include('master_data/data_promosi.php');
              break;
              /*=====================EDITOR======================================*/
            case ('user');
              include('master_data/data_user.php');
              break;
            case ('member');
              include('master_data/data_member.php');
              break;
            case ('jual');
              include('manager/lap-jual.php');
              break;
            case ('shop');
              include('master_data/data_toko.php');
              break;
            case ('branch-shop');
              include('master_data/data_cabang_toko.php');
              break;
          }
        }
        ?>
      </div>
    </div>
  </div><!-- Main Col END -->
  </div><!-- body-row END -->
  <!-- Footer -->
  <footer class="font-small bg-primary">
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© <?php echo date('Y'); ?> Copyright:
      <a href="#"> <img src="images/logo-3.png" width="150"></a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->

  <script src="script/fancybox/jquery.fancybox.js"></script>
  <script>
    $(document).ready(function() {
      $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
      });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#ngedit_brg').on('show.bs.modal', function(e) {
        var idx = $(e.relatedTarget).data('id');
        //menggunakan fungsi ajax untuk pengambilan data
        $.ajax({
          type: 'post',
          url: 'master_data/edit_barang.php',
          data: 'idx=' + idx,
          success: function(data) {
            $('.hasil-data').html(data); //menampilkan data ke dalam modal
          }
        });
      });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#ngeprint').on('show.bs.modal', function(e) {
        var idx = $(e.relatedTarget).data('id');
        //menggunakan fungsi ajax untuk pengambilan data
        $.ajax({
          type: 'post',
          url: 'master_data/eprint.php',
          data: 'idx=' + idx,
          success: function(data) {
            $('.hasil-data').html(data); //menampilkan data ke dalam modal
          }
        });
      });
    });
  </script>

  <textarea id="printing-css" style="display:none;">.no-print{display:none}</textarea>
  <iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
  <script type="text/javascript">
    function printDiv(elementId) {
      var a = document.getElementById('printing-css').value;
      var b = document.getElementById(elementId).innerHTML;
      window.frames["print_frame"].document.title = document.title;
      window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
      window.frames["print_frame"].window.focus();
      window.frames["print_frame"].window.print();
    }
  </script>
  <script src="script/date/js/bootstrap-datepicker.js"></script>
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
    document.getElementById("btnPrint").onclick = function() {
      printElement(document.getElementById("printThis"));
    }

    function printElement(elem) {
      var domClone = elem.cloneNode(true);

      var $printSection = document.getElementById("printSection");

      if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
      }

      $printSection.innerHTML = "";
      $printSection.appendChild(domClone);
      window.print();
    }
  </script>
  <script src="script/export/jquery.table2excel.min.js"></script>
  <script src="script/chained/jquery.chained.min.js"></script>
  <script>
    $("#kota").chained("#provinsi");
    $("#kecamatan").chained("#kota");
  </script>

</body>

</html>