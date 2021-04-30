<?php include('../inc/koneksi.php');
if($_POST['idx']) {
$id 	= $_POST['idx'];      
$data 	= mysqli_query($koneksi, "SELECT * FROM tabel_barang,tabel_stok_toko WHERE tabel_barang.kd_barang = '$id' AND tabel_barang.kd_barang = tabel_stok_toko.kd_barang ");
$d 		= mysqli_fetch_array($data);
}?>   

     
       
        <form action="master_data/ganti_barang.php" method="post">
            
        <div class="form-group">                                  
           <div class="input-group">                  
                <input type="text" name="kd_barang" class="form-control" value="<?php echo $d['kd_barang'];?>" readonly> 
           </div>     
        </div>
        <div class="form-group">                                  
           <div class="input-group">                  
                <input type="text" name="nm_barang" class="form-control" value="<?php echo $d['nm_barang'];?>">
           </div>     
        </div>
        <div class="form-group">                                  
           <div class="input-group">                  
                <select name="satuan" class="form-control">
                	<option value="<?php echo $d['kd_satuan'] ;?>"><?php echo $d['kd_satuan'] ;?></option>
<?php $query = "SELECT * FROM tabel_satuan_barang"; $result=mysqli_query($koneksi, $query); while ($sat = mysqli_fetch_array($result)){?>
                    <option value="<?php echo $sat['kd_satuan'] ;?>"><?php echo $sat['nm_satuan'] ;?></option>
					<?php } ?>
                </select>
           </div>     
        </div>
        <div class="form-group">                                  
           <div class="input-group">                  
                <select name="kategori" class="form-control">
                	<option value="<?php echo $d['kd_kategori'] ;?>"><?php echo $d['kd_kategori'] ;?></option>
<?php $query = "SELECT * FROM tabel_kategori_barang"; $result=mysqli_query($koneksi, $query); while ($kat = mysqli_fetch_array($result)){?>
                    <option value="<?php echo $kat['kd_kategori'] ;?>"><?php echo $kat['nm_kategori'] ;?></option>
					<?php } ?>
                </select>
           </div>     
        </div>
        <div class="form-group">                                  
           <div class="input-group">                  
                <input type="text" name="hrg_beli" class="form-control" value="<?php echo $d['hrg_beli'];?>">
           </div>     
        </div>
        <div class="form-group">                                  
           <div class="input-group">                  
                <input type="text" name="hrg_jual" class="form-control" value="<?php echo $d['hrg_jual'];?>">
           </div>     
        </div>
        <div class="form-group">                                  
           <div class="input-group">                  
                <input type="text" name="hrg_grosir" class="form-control" value="<?php echo $d['hrg_grosir'];?>">
           </div>     
        </div>
        <div class="form-group">                                  
           <div class="input-group">                  
                <input type="text" name="diskon" class="form-control" value="<?php echo $d['diskon'];?>">
           </div>     
        </div>
        <div class="form-group">                                  
           <div class="input-group">                  
                <input type="text" name="stok" class="form-control" value="<?php echo $d['stok'];?>">
           </div>     
        </div>
        
        <button type="submit" name="edit" class="btn btn-primary btn-lg">Ubah Data</button>
       </form>

              
    
	
 