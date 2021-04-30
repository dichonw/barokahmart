  <?php if ($header == true); ?>
  <div id="kepala">
    <nav class="top-bar">
      <div class="container">
        <div class="col-sm-3 text-left hidden-phone" style="padding-right:0;width:10%;">
          <a href="../index.php?menu=home"><img src="../images/<?php echo $logo_toko; ?>" /></a>
        </div>
        <div class="col-sm-1 hidden-phone" style="border-right:1px solid #111;height:100px;margin:8px;width:1%"></div>
        <div class="col-sm-4 text-left" style="padding-left:0">
          <h3><?php echo $nm_toko; ?></h3>
          <span class="nav-text hidden-phone">
            <h5 style="margin-bottom:0">

              <i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $almt_toko; ?> </h5>
            <i class="fa fa-phone-square" aria-hidden="true"></i> <?php echo $tlp_toko; ?> &nbsp; | &nbsp;
            <i class="fa fa-mobile-phone" aria-hidden="true"></i> <?php echo $fax_toko; ?>
          </span>
        </div>
        <!--div class="col-sm-3 text-center">
            <a href="#" class="social"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
            <a href="#" class="social"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
            <a href="#" class="social"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            <a href="#" class="social"><i class="fa fa-youtube-square" aria-hidden="true"></i></a>
            <a href="#" class="social"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a>
            </div-->
        <div class="col-sm-6 text-right" style="padding-top:3%;padding-bottom:3%">
          <ul class="tools">
            <li><a href="../akses/logout.php" class="btn btn-danger" style="color:#FFF">
                <i class="fa fa-lock" aria-hidden="true"></i> Keluar</a></li>
            <!--li class="dropdown">
                 <a class="dropdown-toggle btn btn-danger" data-toggle="dropdown" href="akses/logout.php" style="color:#fff">
                 <i class="fa fa-lock" aria-hidden="true"></i> Keluar Aplikasi<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                   		<li><a href="akses/logout.php">keluar</a></li>
                  </ul>
                </li-->

            <!--li class="dropdown">
                 <a class="" href="#"><i class="fa fa-user" aria-hidden="true"></i> Login</a>                  
                </li-->
          </ul>
        </div>
      </div>
    </nav>
    <!--TOP-NAVBAR-END-->


    <!--====================== NAVBAR MENU START===================-->


    <nav class="navbar navbar-inverse" style="background:#111">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!--a class="navbar-brand" href="#"><img src="img/logo.png" width="50"></a-->
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-left">
            <li class=""><a href="../index.php?menu=home"><i class="fa fa-home"></i> Beranda</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </div>