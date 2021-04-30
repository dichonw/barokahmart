<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="refresh" content="300">
  <title>.:LOGIN:.</title>
  <link href="../../kasir/main/script/css/boilerplate.css" rel="stylesheet" type="text/css">
  <link href="../script/style.css" rel="stylesheet" type="text/css">
  <link href="../../kasir/main/script/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../../kasir/main/script/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css">
  <link href="../../kasir/main/script/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css">
  <link href="../../kasir/main/script/css/font/css/fontawesome.min.css" rel="stylesheet" type="text/css">
  <link href="../../kasir/main/script/css/font/css/all.min.css" rel="stylesheet" type="text/css">

  <script src="../../kasir/main/script/js/respond.min.js"></script>
  <script src="../../kasir/main/script/js/jquery.min.3.2.1.js"></script>
  <script src="../../kasir/main/script/js/bootstrap.min.js"></script>
</head>

<body>
  <?php
  include("../../kasir/main/inc/koneksi.php");
  ini_set("display_errors", 0);
  if (isset($_POST['daftarin'])) {
    $nm_user    = $_POST['nm_user'];
    $password    = $_POST['password'];
    $hp        = $_POST['hp'];
    $almt      = $_POST['almt'];
    $cekdulu = "select * from tabel_member where hp='$_POST[hp]'"; //username dan $_POST[un] diganti sesuai dengan yang kalian gunakan
    $prosescek = mysqli_query($koneksi, $cekdulu);
    if (mysqli_num_rows($prosescek) > 0) { //proses mengingatkan data sudah ada
      echo "<script>alert('Nomer $hp sudah digunakan, silahkan gunakan nomer lain');history.go(-1) </script>";
    } else {
      $query = "INSERT INTO tabel_member VALUES ('','$nm_user','$almt',md5('$password'),'$password','default.png','$hp','','inactive','','')";
      $hasil = mysqli_query($koneksi, $query);
      echo "<script language='JavaScript'>;document.location='cek_daftar.php?hp=$hp'</script>";
    }
  }
  ?>

  <?php $toko = mysqli_query($koneksi, "SELECT * FROM tabel_toko");
  $t = mysqli_fetch_array($toko);
  $status     = $t['status'];
  if ($status == 'buka') {
    $tampil = ' 
        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">
                	<i class="fas fa-user-lock"></i> Masuk</label> 
        <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">
                	<i class="fas fa-user-edit"></i> Daftar</label>
        <div class="login-space">
          <div class="login">
           <form action="login_member.php" method="post"> 
            <div class="group"> <label class="label">Nomer Handphone</label> 
               <input type="text" class="input" name="hp"> </div>
            <div class="group"> <label class="label">Kata sandi</label> 
               <input type="password" class="input" name="password"> </div>
            <div class="group"> <input type="checkbox" class="check" checked> <label for="check">
            	<span class="icon"></span> Biarkan saya tetap masuk</label> </div>
            <div class="group"> <input type="submit" class="button" value="Masuk" name="button_login"> </div>
            </form>
            <div class="hr"></div>
            <div class="foot"> <a href="#">Lupa password?</a> </div>
         </div>
         
      <div class="sign-up-form">
        <form method="post" action=""> 
         <div class="group"> <label for="user" class="label">Nama pengguna</label> 
          <input type="text" class="input" name="nm_user" required></div>
         <div class="group"> <label for="pass" class="label">Kata sandi</label> 
           <input type="password" class="input" name="password"></div>         
         <div class="group"> <label for="pass" class="label">Nomer Handphone</label> 
           <input type="text" class="input" name="hp"></div>
         <div class="group"> <label for="pass" class="label">Alamat</label> 
           <input type="text" class="input" name="almt"></div>  
         <div class="group"> <input type="submit" class="button" value="Daftar" name="daftarin"> </div>
        </form> 
        <div class="hr"></div>
         <div class="foot"> <label for="tab-1">Sudah Menjadi Pengguna?</label> </div>
        </div>
       </div>
      ';
  } else if ($status == 'tutup') {
    $tampil = '
		<input id="tab-1" type="radio" name="tab" class="sign-in text-center" checked><label for="tab-1" class="tab">
          <strong>Mohon maaf kami sedang</strong></label> 
        <input id="tab-2" type="hidden" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
        <div class="login-space">
          <div class="login">             
            <div class="group"><input type="button" class="button" value="Tutup"></div>             
         </div>
		';
  }
  ?>

  <div class="container bg-faded py-3">
    <div class="card bg-light">
       <!--Carousel Wrapper-->
            <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel" style="margin:auto; padding-top:10px; padding-bottom: 10px; max-width: 525px;; position: relative;">
              <ol class="carousel-indicators">
                <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-2" data-slide-to="1"></li>
                <li data-target="#carousel-example-2" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner" role="listbox">
                <?php

                error_reporting(0);
                $d = mysqli_query($koneksi, "SELECT * FROM tabel_slide WHERE kat_slide = 'utama' ORDER BY id_slide DESC limit 1");
                while ($c = mysqli_fetch_array($d)) {
                ?>

                  <div class="carousel-item active">
                    <div class="view">
                      <img class="d-block w-100" src="../../kasir/main/master_data/slide/<?php echo $c['gbr_slide']; ?>" alt="<?php echo $c['gbr_slide']; ?>" style="max-height:200px">
                      <div class="mask rgba-black-light"></div>
                    </div>
                  </div>
                <?php
                }
                ?>

                <?php
                $e = mysqli_query($koneksi, "SELECT * FROM tabel_slide WHERE kat_slide = 'utama' ORDER BY RAND()");
                while ($f = mysqli_fetch_array($e)) {
                ?>
                  <div class="carousel-item">
                    <div class="view">
                      <img class="d-block w-100" src="../../kasir/main/master_data/slide/<?php echo $f['gbr_slide']; ?>" alt="<?php echo $f['gbr_slide']; ?>" style="max-height:200px">
                      <div class="mask rgba-black-strong"></div>
                    </div>
                  </div>
                <?php } ?>

              </div>
              <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
            <!--/.Carousel Wrapper-->
      <div class="login-box">
        <div class="login-snip">
          <!-----------------FORM---START----------------------------------------------------------------------->
          <?php echo $tampil; ?>
          <!-----------------FORM---START----------------------------------------------------------------------->
        </div>
      </div>
      <div class="promo" style="margin:auto; padding-top:10px; padding-bottom: 10px; max-width: 525px; position: relative;">
            <h2 class="text-center p-2" style="font-size:1rem">Promo Hari Ini</h2>
            <div class="row">
              <div class="col-6">
                <!--Carousel Wrapper-->
                <div id="carousel-example-3" class="carousel slide carousel-fade" data-ride="carousel" style="margin-bottom:15px">
                  <ol class="carousel-indicators">
                    <li data-target="#carousel-example-3" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-3" data-slide-to="1"></li>
                    <li data-target="#carousel-example-3" data-slide-to="2"></li>
                  </ol>
                  <div class="carousel-inner" role="listbox">
                    <?php
                    $d = mysqli_query($koneksi, "SELECT * FROM tabel_slide WHERE kat_slide = 'thumbnail' ORDER BY id_slide DESC limit 1");
                    while ($c = mysqli_fetch_array($d)) {
                    ?>
                      <div class="carousel-item active">
                        <div class="view">
                          <img class="d-block w-100 img-responsive img-thumbnail"  src="../../kasir/main/master_data/slide/<?php echo $c['gbr_slide']; ?>" alt="<?php echo $c['gbr_slide']; ?>" style="max-height:200px">
                          <div class="mask rgba-black-light"></div>
                        </div>
                      </div>
                    <?php  }
                    ?>

                    <?php
                    $e = mysqli_query($koneksi, "SELECT * FROM tabel_slide WHERE kat_slide = 'thumbnail' ORDER BY RAND()");
                    while ($f = mysqli_fetch_array($e)) {
                    ?>
                      <div class="carousel-item">
                        <div class="view">
                          <img class="d-block w-100 img-responsive img-thumbnail" src="../../kasir/main/master_data/slide/<?php echo $f['gbr_slide']; ?>" alt="<?php echo $f['gbr_slide']; ?>" style="max-height:200px">
                          <div class="mask rgba-black-strong"></div>
                        </div>
                      </div>
                    <?php }
                    ?>

                  </div>
                  <a class="carousel-control-prev" href="#carousel-example-3" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carousel-example-3" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
                <!--/.Carousel Wrapper-->
              </div>
              <div class="col-6">
                <!--Carousel Wrapper-->
                <div id="carousel-example-4" class="carousel slide carousel-fade" data-ride="carousel" style="margin-bottom:15px">
                  <ol class="carousel-indicators">
                    <li data-target="#carousel-example-4" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-4" data-slide-to="1"></li>
                    <li data-target="#carousel-example-4" data-slide-to="2"></li>
                  </ol>
                  <div class="carousel-inner" role="listbox">
                    <?php
                    $d = mysqli_query($koneksi, "SELECT * FROM tabel_slide WHERE kat_slide = 'thumbnail' ORDER BY id_slide DESC limit 1");
                    while ($c = mysqli_fetch_array($d)) {
                    ?>
                      <div class="carousel-item active">
                        <div class="view">
                          <img class="d-block w-100 img-responsive img-thumbnail" src="../../kasir/main/master_data/slide/<?php echo $c['gbr_slide']; ?>" alt="<?php echo $c['gbr_slide']; ?>" style="max-height:200px">
                          <div class="mask rgba-black-light"></div>
                        </div>
                      </div>
                    <?php }
                    ?>

                    <?php
                    $e = mysqli_query($koneksi, "SELECT * FROM tabel_slide WHERE kat_slide = 'thumbnail' ORDER BY RAND()");
                    while ($f = mysqli_fetch_array($e)) {
                    ?>
                      <div class="carousel-item">
                        <div class="view">
                          <img class="d-block w-100 img-responsive img-thumbnail" src="../../kasir/main/master_data/slide/<?php echo $f['gbr_slide']; ?>" alt="<?php echo $f['gbr_slide']; ?>" style="max-height:200px">
                          <div class="mask rgba-black-strong"></div>
                        </div>
                      </div>
                    <?php  }
                    ?>

                  </div>
                  <a class="carousel-control-prev" href="#carousel-example-4" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carousel-example-4" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
                <!--/.Carousel Wrapper-->
              </div>
            </div>
          </div>

    </div>
  </div>

</body>

</html>