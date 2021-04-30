<link href="../script/style.css" rel="stylesheet" type="text/css">
<link href="../../kasir/main/script/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../../kasir/main/script/css/font/css/fontawesome.min.css" rel="stylesheet" type="text/css">

<div class="container-fluid pl-0 pr-0 ml-0 mr-0">     
<span class="btn btn-block btn-dark text-center text-light text-uppercase mt-4 pt-5"> 
	 Dapatkan penawaran terbaik <a href="#" class="btn btn-light btn-sm">Belanja sekarang</a></span>
   <div class="row">
<?php $a=mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_kategori_barang, tabel_barang,tabel_barang_gambar WHERE  tabel_barang.kd_kategori = tabel_kategori_barang.kd_kategori AND tabel_barang.kd_barang = tabel_barang_gambar.id_brg ORDER BY RAND()"));	?>        
        <div class="col-lg-4">
            <div class="product-grid8">
                <div class="product-image8">
                    <a href="?menu=detail&kd_barang=<?php echo $a['kd_barang'];?>">
                        <img class="pic-1" src="../kasir/main/master_data/images/<?php echo $a['gambar'];?>">
                        <img class="pic-2" src="../kasir/main/master_data/images/<?php echo $a['gambar'];?>">
                    </a>
                    <ul class="social">
                        <li><a href="?menu=detail&kd_barang=<?php echo $a['kd_barang'];?>" class="fa fa-search"></a></li>
                        <!--li><a href="" class="fa fa-shopping-cart"></a></li-->
                    </ul>
                    <!--span class="product-discount-label">-20%</span-->
                </div>
                <div class="product-content">
                    <div class="price">Rp.<?php echo number_format($a['hrg_jual'], 2, ".", ",");?>
                        <!--span>£ 10.00</span-->
                    </div>
                    <!--span class="product-shipping">Free Shipping</span-->
                    <h3 class="title"><a href="#"><?php echo $a['nm_barang'];?></a></h3>
                    <a class="all-deals" href="">See all <i class="fa fa-angle-right icon"></i></a>
                </div>
            </div>
        </div>
     
<?php
$d=mysqli_query($koneksi, "SELECT * FROM tabel_kategori_barang, tabel_barang,tabel_barang_gambar WHERE tabel_kategori_barang.kd_kategori = '$_GET[kd_kategori]' AND tabel_barang.kd_kategori = tabel_kategori_barang.kd_kategori AND tabel_barang.kd_barang = tabel_barang_gambar.id_brg");		
while($a=mysqli_fetch_array($d)){	
?>        
   <div class="col-md-3 col-6">
     <div class="product-grid7">
       <div class="product-image7">
         <a href="?menu=detail&kd_barang=<?php echo $a['kd_barang'];?>">
            <img class="pic-1" src="../kasir/main/master_data/images/<?php echo $a['gambar'];?>">
            <img class="pic-2" src="../kasir/main/master_data/images/<?php echo $a['gambar'];?>">
         </a>
         <ul class="social">
             <li><a href="?menu=detail&kd_barang=<?php echo $a['kd_barang'];?>" class="fa fa-search"></a></li>
             <li><a href="?menu=detail&kd_barang=<?php echo $a['kd_barang'];?>" class="fa fa-shopping-cart"></a></li>
         </ul>
        </div>
      <div class="product-content">
         <h3 class="title"><a href="#"><?php echo $a['nm_barang'];?></a></h3>
           <div class="price">Rp.<?php echo number_format($a['hrg_jual'], 2, ".", ",");?><!--span>$20.00</span--></div>
      </div>
    </div>
  </div>
   <?php } ?>     
 </div><!---------ROW-------->
</div><!---------CONTAINER-------->