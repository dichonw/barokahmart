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
<!--?php 
$q=$_POST['cari'];
$query=mysqli_query($koneksi, "SELECT * FROM tabel_barang WHERE nm_barang LIKE '%".$q."%'");
$row=mysql_num_rows($query);
if ($row > 0) {
 while ($data=mysql_fetch_array($query)) {  
}else {
 echo "<strong>Data tidak ditemukan</strong>"; 
}
?-->
<div class="container">
 <div class="row mt-5">
<?php 
$q=$_POST['cari'];
$tk = mysqli_query($koneksi, "SELECT * FROM tabel_barang,tabel_barang_gambar,tabel_stok_toko WHERE tabel_barang.nm_barang LIKE '%".$q."%' AND tabel_barang.kd_barang = tabel_barang_gambar.id_brg AND tabel_barang.kd_barang = tabel_stok_toko.kd_barang AND tabel_stok_toko.stok > 0 "); while($brg = mysqli_fetch_array($tk)){
$disc = $brg['diskon'];	
if ($disc > 1){
	$type = '<del>Rp. '.number_format($brg['diskon'],2,",",".").'</del>';
}else if ($disc == 0) {
	$type = '';
}
?>

  <div class="col-md-3 col-6">
     <div class="product-grid7">
       <div class="product-image7">
         <a href="#">
            <img class="pic-1" src="../kasir/main/master_data/images/<?php echo $brg['gambar'];?>">
            <img class="pic-2" src="../kasir/main/master_data/images/<?php echo $brg['gambar'];?>">
         </a>         
        </div>
      <div class="product-content">
         <h3 class="title"><a href="?menu=detail&kd_barang=<?php echo $brg['kd_barang'];?>"><?php echo $brg['nm_barang'];?></a></h3>
           <?php echo $type;?>
		   <div class="price">Rp.<?php echo number_format($brg['hrg_jual'],2,",",".");?></div>
		 <div class="btn-group" role="group" aria-label="Basic example">
           <form method="post" action="?menu=transaksi">
              <input type="hidden" class="form-control" name="no_nota" value="<?php echo $no_faktur;?>" />
              <input type="hidden" class="form-control" name="kd_barang" value="<?php echo $brg['kd_barang'];?>" />
              <input type="hidden" class="form-control" name="nm_barang" value="<?php echo $brg['nm_barang'];?>" />  
              <input type="hidden" class="form-control" name="jual" value="<?php echo $brg['hrg_jual'];?>" />
            <button type="submit" name="add_to_cart" class="btn btn-danger text-center" title="Masukkan Keranjang">
               <i class="fas fa-shopping-cart"></i> BELI</button>
           </form>
         </div>  
      </div>
    </div>
  </div>
<?php } ?> 
 </div>
</div> 