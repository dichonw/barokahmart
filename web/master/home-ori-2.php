<link href="../script/style.css" rel="stylesheet" type="text/css">
<link href="../../kasir/main/script/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../../kasir/main/script/css/font/css/fontawesome.min.css" rel="stylesheet" type="text/css">


<!--div class="container-fluid pl-0 pr-0 ml-0 mr-0"-->
<div class="container">
	<span class="btn btn-block btn-light text-center text-light text-uppercase mt-4 pt-5"></span>
 
<!--Carousel Wrapper-->
        <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">          
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-2" data-slide-to="1"></li>
            <li data-target="#carousel-example-2" data-slide-to="2"></li>
          </ol>          
          <div class="carousel-inner" role="listbox">
<?php $d=mysqli_query($koneksi, "SELECT * FROM tabel_slide ORDER BY id_slide DESC limit 1");while($c=mysqli_fetch_array($d)){?>            
            <div class="carousel-item active">              
              <div class="view">
                <img class="d-block w-100" src="../kasir/main/master_data/slide/<?php echo $c['gbr_slide'];?>" alt="<?php echo $c['gbr_slide'];?>" style="max-height:300px">
                <div class="mask rgba-black-light"></div>
              </div>              
            </div>
<?php } ?>            

<?php $e=mysqli_query($koneksi, "SELECT * FROM tabel_slide ORDER BY RAND()");while($f=mysqli_fetch_array($e)){?>            
            <div class="carousel-item">
              <div class="view">
                <img class="d-block w-100" src="../kasir/main/master_data/slide/<?php echo $f['gbr_slide'];?>" alt="<?php echo $f['gbr_slide'];?>" style="max-height:300px">
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
 	
<?php
$hp_user= substr("$_SESSION[hp]",7);
$date=date('ymd');
$query=mysqli_query($koneksi, "SELECT MAX(no_faktur_penjualan) as maxid FROM tabel_penjualan WHERE no_faktur_penjualan LIKE '".$hp_user."%'");
$result=mysqli_fetch_array($query);
$maxid=$result['maxid'];
$no_urut=substr($maxid,-5);
$new_urut=$no_urut+1;
$no_faktur=$hp_user.$date.sprintf("%05s",$new_urut);
?>
<?php
$tab_query = "SELECT DISTINCT tabel_barang.kd_kategori,nm_kategori,ikon_kategori FROM tabel_kategori_barang,tabel_barang WHERE tabel_kategori_barang.kd_kategori = tabel_barang.kd_kategori ORDER BY RAND()";
$tab_result = mysqli_query($koneksi, $tab_query);
$tab_menu = '';
$tab_content = '';
$i = 0;
while($row = mysqli_fetch_array($tab_result)){
 if($i == 0){
  $tab_menu .= '
  <li role="presentation" class="active">
    <a href="#'.$row["kd_kategori"].'" aria-controls="1" role="tab" data-toggle="tab" class="btn btn-lg">
	<img width="45px" src="../kasir/main/master_data/img/'.$row["ikon_kategori"].'"><br>
	<small>'.$row["nm_kategori"].'</small></a>
  </li>   
   ';
  $tab_content .= '      
   <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="'.$row["kd_kategori"].'">             
   <div class="row">	       
   ';
 }
 else{
  $tab_menu .= '
   <li role="presentation">
    <a href="#'.$row["kd_kategori"].'" aria-controls="2" role="tab" data-toggle="tab" class="btn btn-lg">
	<img width="45px" src="../kasir/main/master_data/img/'.$row["ikon_kategori"].'"><br>
	<small>'.$row["nm_kategori"].'</small></a>
  </li>   
   ';
  $tab_content .= '   
  <div role="tabpanel" class="tab-pane" id="'.$row["kd_kategori"].'">          
  <div class="row mt-3">
  ';
  
 }$product_query = "SELECT * FROM tabel_barang, tabel_barang_gambar,tabel_stok_toko WHERE tabel_barang.kd_kategori = '".$row["kd_kategori"]."' AND tabel_barang.kd_barang = tabel_barang_gambar.id_brg AND tabel_barang.kd_barang = tabel_stok_toko.kd_barang AND tabel_stok_toko.stok > 0 ORDER BY tabel_barang.kd_barang DESC";
 $product_result = mysqli_query($koneksi, $product_query);
 while($sub_row = mysqli_fetch_array($product_result)){
	$jual = $sub_row["hrg_jual"];
	$disc = $sub_row["diskon"];	
	if ($disc > 1){
	$type = '<del>Rp. '.number_format($sub_row['diskon'],2,",",".").'</del>';
	}else if ($disc == 0) {
	$type = '';
	} 
  $tab_content .= '
   
   <div class="col-md-4 col-6 p-3">
     <div class="product-grid7">
       <div class="product-image7 img-thumbnail p-3">
         <a href="?menu=detail&kd_barang='.$sub_row["kd_barang"].'">		    
            <img class="pic-1" src="../kasir/main/master_data/images/'.$sub_row["gambar"].'">
            <img class="pic-2" src="../kasir/main/master_data/images/'.$sub_row["gambar"].'">
         </a>         
        </div>
      <div class="product-content">         
		 <h3 class="title"><a href="?menu=detail&kd_barang='.$sub_row["kd_barang"].'">'.$sub_row["nm_barang"].'</a></h3>
           '.$type.'
		   <div class="price">Rp.'.number_format($jual,2,",",".").'</div>
		 <div class="btn-group" role="group" aria-label="Basic example">
           <form method="post" action="?menu=transaksi">
              <input type="hidden" class="form-control" name="no_nota" value="'.$no_faktur.'" />
              <input type="hidden" class="form-control" name="kd_barang" value="'.$sub_row["kd_barang"].'" />
              <input type="hidden" class="form-control" name="nm_barang" value="'.$sub_row["nm_barang"].'" />  
              <input type="hidden" class="form-control" name="jual" value="'.$sub_row["hrg_jual"].'" />
            <button type="submit" name="add_to_cart" class="btn btn-danger text-center" title="Masukkan Keranjang">
               <i class="fas fa-shopping-cart"></i> BELI</button>
           </form>
         </div>  
      </div>
    </div>
  </div>
  ';
 }$tab_content .= '<div style="clear:both"><a href="?menu=list&jenis='.$row["kd_kategori"].'"></a></div></div></div>';
 $i++;
}?>        
<div class="container"><hr />
<h2 class="text-right p-2" style="font-size:1rem">PILIH KATEGORI</h2>
<div class="row">
<!--ul class="nav nav-tabs col-4" role="tablist"-->
<ul class="nav nav-tabs" role="tablist">
  <?php echo $tab_menu; ?>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <?php echo $tab_content;?> 
</div>
</div>
</div>
</div>
</div><!---------CONTAINER-------->