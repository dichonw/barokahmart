<link href="../script/style.css" rel="stylesheet" type="text/css">
<link href="../../kasir/main/script/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../../kasir/main/script/css/font/css/fontawesome.min.css" rel="stylesheet" type="text/css">
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<!-- touchscreen -->
<!-- <link rel="stylesheet" href="//increstedbutte.com/wp-content/themes/crestedbutte/style.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//jquery-scrollview.googlecode.com/svn-history/r2/trunk/jquery.scrollview.js"></script>
<script src="//cdn.rawgit.com/vpanga/jquery.mouse2touch/master/src/jquery.mouse2touch.min.js"></script> -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js"></script>
<script src="http://stephband.info/jquery.event.move/js/jquery.event.move.js"></script>
<script src="js/jquery.event.swipe.js"></script>

<style>
  div.scrollmenu {
    overflow: auto;
    white-space: nowrap;
    color: black;
  }

  div.scrollmenu a {
    display: inline-block;
    color: black;
    text-align: center;
    padding: 14px;
    text-decoration: none;
  }

  div.scrollmenu a:hover {
    background-color: #777;
  }

  /* Dropdown Button */
  .dropbtn {
    background-color: #3498DB;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
  }

  /* Dropdown button on hover & focus */
  .dropbtn:hover,
  .dropbtn:focus {
    background-color: #2980B9;
  }

  /* The container <div> - needed to position the dropdown content */
  .dropdown {
    position: relative;
    display: inline-block;
  }

  /* Dropdown Content (Hidden by Default) */
  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
  }

  /* Links inside the dropdown */
  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }

  /* Change color of dropdown links on hover */
  .dropdown-content a:hover {
    background-color: #ddd
  }

  /* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
  .show {
    display: block;
  }

  ::-webkit-scrollbar { width:0; height:0 }
  ::-webkit-scrollbar-thumb { background: transparent}
  ::-webkit-scrollbar-track { background-color: transparent}

  .items{
    max-height: 120px;
    overflow: auto;
    display: flex;
  }

  .items li{
    list-style-type: none;
  }

  ul{
  list-style: none;
  padding: 0
  }

  .nav.nav-tabs {
  -webkit-overflow-scrolling: touch; 
  display: block;
  white-space: nowrap
  }

  .nav.nav-tabs li {
    display: inline-block
  }

  .tabbable .nav-tabs {
    overflow-x: auto;
    overflow-y: hidden;
    flex-wrap: nowrap;
  }

  .nav {
    display: flex !important;
    flex-wrap: nowrap !important;
  }

  /* .tabbable .nav-tabs {
    overflow-x: auto;
    overflow-y: hidden;
    flex-wrap: nowrap;
  } */

  .tabbable .nav-tabs .nav-link {
    white-space: nowrap;
  }
</style>




<!--div class="container-fluid pl-0 pr-0 ml-0 mr-0"-->
<div class="container">
  <span class="btn btn-block btn-light text-center text-light text-uppercase mt-4 pt-2"></span>

  <!--Carousel Wrapper-->
  <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
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
            <img class="d-block w-100" src="../kasir/main/master_data/slide/<?php echo $c['gbr_slide']; ?>" alt="<?php echo $c['gbr_slide']; ?>" style="max-height:300px">
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
            <img class="d-block w-100" src="../kasir/main/master_data/slide/<?php echo $f['gbr_slide']; ?>" alt="<?php echo $f['gbr_slide']; ?>" style="max-height:300px">
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

  <!-- <div class="container">
    <div class="row ml-10 mr-0">
        <?php 
        $satQuery = "SELECT DISTINCT tabel_barang.kd_kategori,nm_kategori,ikon_kategori FROM tabel_kategori_barang,tabel_barang WHERE tabel_kategori_barang.kd_kategori = tabel_barang.kd_kategori AND tabel_kategori_barang.kd_kategori != 'K0031' AND tabel_kategori_barang.kd_kategori != 'K0032' ORDER BY RAND()";
        $executeSat = mysqli_query($koneksi, $satQuery);
        while ($barang=mysqli_fetch_array($executeSat)) {
        ?>
        <div class="col-1">
            <a href="#<?php echo $barang['kd_kategori'];?>" data-toggle="tab">
            <button class="btn btn-lg"> <div style="text-align:center;">
            <img width="45px" src="../kasir/main/master_data/img/<?php echo $barang['ikon_kategori'];?>" alt=""><br>
            <small style="font-size:50%;"><?php echo $barang['nm_kategori'];?></small>
            </button></a>
        </div> 
        <?php } ?>    
  </div> -->

  <?php
  $hp_user = substr("$_SESSION[hp]", 7);
  $date = date('ymd');
  $query = mysqli_query($koneksi, "SELECT MAX(no_faktur_penjualan) as maxid FROM tabel_penjualan WHERE no_faktur_penjualan LIKE '" . $hp_user . "%'");
  $result = mysqli_fetch_array($query);
  $maxid = $result['maxid'];
  $no_urut = substr($maxid, -5);
  $new_urut = $no_urut + 1;
  $no_faktur = $hp_user . $date . sprintf("%05s", $new_urut);
  ?>
  <?php
  $tab_query = "SELECT DISTINCT tabel_barang.kd_kategori,nm_kategori,ikon_kategori FROM tabel_kategori_barang,tabel_barang WHERE tabel_kategori_barang.kd_kategori = tabel_barang.kd_kategori AND tabel_kategori_barang.kd_kategori != 'K0031' AND tabel_kategori_barang.kd_kategori != 'K0032' ORDER BY RAND()";
  $tab_result = mysqli_query($koneksi, $tab_query);
  $tab_menu = '';
  $tab_content = '';
  $i = 0;
  while ($row = mysqli_fetch_array($tab_result)) {
    if ($i == 0) {
      $tab_menu .= '
  <li role="presentation" class="active">
    <a href="#' . $row["kd_kategori"] . '" class="btn btn-lg" >
    <img width="35px" src="../kasir/main/master_data/img/' . $row["ikon_kategori"] . '"><br>
    <small>' . $row["nm_kategori"] . '</small></a>
    <a href="?menu=tagihan" class="btn btn-lg">
    <img width="35px" src="../kasir/main/master_data/img/pulsa.png"><br>
    <small>Tagihan</small></a>
    <a href="?menu=kurir" class="btn btn-lg">
    <img width="35px" src="../kasir/main/master_data/img/kurir.png"><br>
    <small>Kurir</small></a>
    <a href="?menu=pu_jelantah" class="btn btn-lg">
    <img width="35px" src="../kasir/main/master_data/img/jelantah.png"><br>
    <small>PU Jelantah</small></a>
  </li>   
   ';
      $tab_content .= '     
   <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="' . $row["kd_kategori"] . '">             
   <div class="row">	       
   ';
    } else {
      $tab_menu .= '
   <li role="presentation">
    <a href="#' . $row["kd_kategori"] . '" data-toggle="tab" class="btn btn-lg">
	<img width="35px" src="../kasir/main/master_data/img/' . $row["ikon_kategori"] . '"><br>
	<small>' . $row["nm_kategori"] . '</small></a>
  </li>   
   ';
      $tab_content .= '   
  <div role="tabpanel" class="tab-pane" id="' . $row["kd_kategori"] . '">          
  <div class="row mt-3">
  ';
    }
    $product_query = "SELECT * FROM tabel_barang, tabel_barang_gambar,tabel_stok_toko WHERE tabel_barang.kd_kategori = '" . $row["kd_kategori"] . "' AND tabel_barang.kd_barang = tabel_barang_gambar.id_brg AND tabel_barang.kd_barang = tabel_stok_toko.kd_barang ORDER BY tabel_barang.kd_barang DESC";
    $product_result = mysqli_query($koneksi, $product_query);
    while ($sub_row = mysqli_fetch_array($product_result)) {
      $jual = $sub_row["hrg_jual"];
      $stok = $sub_row["stok"];
      if ($stok > 1) {
        $button = 'BELI';
        $button_type = 'submit';
        $style_button = 'btn-danger';
      } else if ($stok == 0) {
        $button = 'STOK HABIS';
        $button_type = 'reset';
        $style_button = 'btn-dark';
      }
      $kd_toko = $sub_row["kd_toko"];
       $shop_query = "SELECT nm_toko FROM tabel_toko WHERE kd_toko = '" . $kd_toko . "' ";
       $shop_result = mysqli_query($koneksi, $shop_query);
       while ($sub_row_shop = mysqli_fetch_array($shop_result)) {
      $tab_content .= '
   
   <div class="col-md-4 col-6 p-3">
     <div class="product-grid7" style="padding-left:15px;padding-right:15px;" >
       <div class="product-image7 img-thumbnail">
         <!--a href="?menu=detail&kd_barang=' . $sub_row["kd_barang"] . '"-->
		 <a href="#">		    
            <img class="pic-1" src="../kasir/main/master_data/images/' . $sub_row["gambar"] . '">
            <img class="pic-2" src="../kasir/main/master_data/images/' . $sub_row["gambar"] . '">
         </a>         
        </div>
      <div class="product-content">         
		 <h3 class="title"><!--a href="?menu=detail&kd_barang=' . $sub_row["kd_barang"] . '">' . $sub_row["nm_barang"] . '</a-->
		 <a href="#">' . $sub_row["nm_barang"] . '</a>
		 </h3>
           <del>' . $sub_row["diskon"] . '</del>
       <h3 class="title">
       <a href="#">' . $sub_row_shop["nm_toko"] . '</a>
       </h3>
		   <div class="price">Rp.' . number_format($jual, 2, ",", ".") . '</div>
		 <div class="btn-group" role="group" aria-label="Basic example">
           <form method="post" action="?menu=transaksi">
              <input type="hidden" class="form-control" name="no_nota" value="' . $no_faktur . '" />
              <input type="hidden" class="form-control" name="kd_barang" value="' . $sub_row["kd_barang"] . '" />
              <input type="hidden" class="form-control" name="nm_barang" value="' . $sub_row["nm_barang"] . '" />  
              <input type="hidden" class="form-control" name="jual" value="' . $sub_row["hrg_jual"] . '" />
            <button type="' . $button_type . '" name="add_to_cart" class="btn ' . $style_button . ' text-center" title="Masukkan Keranjang">
               <i class="fas fa-shopping-cart"></i> ' . $button . '</button>
           </form>
         </div>  
      </div>
    </div>
  </div>
  ';
    } }
    $tab_content .= '<div style="clear:both"><a href="?menu=list&jenis=' . $row["kd_kategori"] . '"></a></div></div></div>';
    $i++;
  } ?>

    <hr />

    <div class="row">
      <!--ul class="nav nav-tabs col-4" role="tablist"-->
      <div class="scrollmenu">
        <div class="nav nav-tabs items" id="nav-tab" role="tablist">
          <ul class="nav nav-tabs">
          <?php echo $tab_menu; ?>
          </div>
          </ul>
      </div>

      <!-- Tab panes -->
      <div class="tab-content">
        <?php echo $tab_content; ?>
      </div>
    </div>
  </div>

  <hr />

  <h2 class="text-right p-2" style="font-size:1rem">Promo Hari Ini</h2>

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
                <img class="d-block w-100 img-responsive img-thumbnail"  src="../kasir/main/master_data/slide/<?php echo $c['gbr_slide']; ?>" alt="<?php echo $c['gbr_slide']; ?>" style="max-height:400px">
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
                <img class="d-block w-100 img-responsive img-thumbnail" src="../kasir/main/master_data/slide/<?php echo $f['gbr_slide']; ?>" alt="<?php echo $f['gbr_slide']; ?>" style="max-height:400px">
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
                <img class="d-block w-100 img-responsive img-thumbnail" src="../kasir/main/master_data/slide/<?php echo $c['gbr_slide']; ?>" alt="<?php echo $c['gbr_slide']; ?>" style="max-height:400px">
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
                <img class="d-block w-100 img-responsive img-thumbnail" src="../kasir/main/master_data/slide/<?php echo $f['gbr_slide']; ?>" alt="<?php echo $f['gbr_slide']; ?>" style="max-height:400px">
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
<!---------CONTAINER-------->
<script>
      const slider = document.querySelector('.items');
      let isDown = false;
      let startX;
      let scrollLeft;

      slider.addEventListener('mousedown', (e) => {
        isDown = true;
        slider.classList.add('active');
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
      });
      slider.addEventListener('mouseleave', () => {
        isDown = false;
        slider.classList.remove('active');
      });
      slider.addEventListener('mouseup', () => {
        isDown = false;
        slider.classList.remove('active');
      });
      slider.addEventListener('mousemove', (e) => {
        if(!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 3; //scroll-fast
        slider.scrollLeft = scrollLeft - walk;
        console.log(walk);
      });
     
</script>