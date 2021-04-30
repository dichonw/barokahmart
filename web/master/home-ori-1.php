<link href="../script/style.css" rel="stylesheet" type="text/css">
<link href="../../kasir/main/script/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../../kasir/main/script/css/font/css/fontawesome.min.css" rel="stylesheet" type="text/css">


<div class="container-fluid pl-0 pr-0 ml-0 mr-0">
	<span class="btn btn-block btn-dark text-center text-light text-uppercase mt-4 pt-5"> 
	 <?php echo $nm_member;?> Dapatkan penawaran terbaik <a href="#" class="btn btn-light btn-sm">Belanja sekarang</a></span>
  

    	
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
$tab_query = "SELECT DISTINCT tabel_barang.kd_kategori,nm_kategori FROM tabel_kategori_barang,tabel_barang WHERE tabel_kategori_barang.kd_kategori = tabel_barang.kd_kategori ORDER BY RAND()";
$tab_result = mysqli_query($koneksi, $tab_query);
$tab_menu = '';
$tab_content = '';
$i = 0;
while($row = mysqli_fetch_array($tab_result)){
 if($i == 0){
  $tab_menu .= '
   <li class="nav-item">
    <a class="nav-link active" href="#'.$row["kd_kategori"].'" role="tab" data-toggle="tab">'.$row["nm_kategori"].'</a>
  </li>   
   ';
  $tab_content .= '   
   <div role="tabpanel" class="tab-pane fade in active" id="'.$row["kd_kategori"].'">            
   <div class="row mt-3">	       
   ';
 }
 else{
  $tab_menu .= '
   <li class="nav-item">
    <a class="nav-link" href="#'.$row["kd_kategori"].'" role="tab" data-toggle="tab">'.$row["nm_kategori"].'</a>
  </li>   
   ';
  $tab_content .= '
  <div role="tabpanel" class="tab-pane fade" id="'.$row["kd_kategori"].'">          
  <div class="row mt-3">
  ';
  
 }$product_query = "SELECT * FROM tabel_barang, tabel_barang_gambar WHERE tabel_barang.kd_kategori = '".$row["kd_kategori"]."' AND tabel_barang.kd_barang = tabel_barang_gambar.id_brg ORDER BY tabel_barang.kd_barang DESC";
 $product_result = mysqli_query($koneksi, $product_query);
 while($sub_row = mysqli_fetch_array($product_result)){
  $tab_content .= '
   
   <div class="col-md-3 col-6">
     <div class="product-grid7">
       <div class="product-image7">
         <a href="#">
            <img class="pic-1" src="../kasir/main/master_data/images/'.$sub_row["gambar"].'">
            <img class="pic-2" src="../kasir/main/master_data/images/'.$sub_row["gambar"].'">
         </a>         
        </div>
      <div class="product-content">
         <h3 class="title"><a href="#">'.$sub_row["nm_barang"].'</a></h3>
           <div class="price">Rp.'.number_format($sub_row["hrg_jual"],2,",",".").'</div>
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


<ul class="nav nav-tabs m-3 p-3" role="tablist">
  <?php echo $tab_menu; ?>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <?php echo $tab_content;?> 
</div>        

</div><!---------CONTAINER-------->