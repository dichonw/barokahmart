<?php
$query_cek_supplier="SELECT * FROM tabel_supplier";
$cek_supplier=mysqli_query($koneksi, $query_cek_supplier);
$hitung_record=mysqli_num_rows($cek_supplier);
include('paging.php');
$query_supplier_paging="SELECT * FROM tabel_supplier LIMIT ".$start_record.",".$max_data."";
$supplier_paging=mysqli_query($koneksi, $query_supplier_paging);
?>

<?php
if(isset($_GET['kd_supplier'])){
$kd_supplier=$_GET['kd_supplier'];
$query_supplier_update="SELECT * FROM tabel_supplier WHERE kd_supplier='".$kd_supplier."'";
$supplier_update=mysqli_query($koneksi, $query_supplier_update);
$data_to_update=mysqli_fetch_array($supplier_update);
$kategori_update=$data_to_update['kategori'];
$kd_update		=$data_to_update['kd_supplier'];
$nm_update		=$data_to_update['nm_supplier'];
$almt_update	=$data_to_update['almt_supplier'];
$tlp_update		=$data_to_update['tlp_supplier'];
$fax_update		=$data_to_update['fax_supplier'];
$ats_nm_update	=$data_to_update['atas_nama'];}
?>


<!--?php echo $param; ?-->
<?php if(isset($_GET['stt'])){
$stt=$_GET['stt'];
echo "query ".$stt."";}
?> 
<div class="row">
<div class="col-sm-3"><!------FORM---------->
  <h4 class="btn btn-primary"><i class="fa fa-inbox"></i> Input Suplier</h4><hr />		
    <div class="panel-body panel-warning"> 
    	<form action="master_data/simpan_supplier.php" method="post" id="form_tambah">
            <div class="form-group"> 
                <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">ID Suplier</div>
                    </div>
                    <input type="text" name="kd_supplier" id="kd_supplier" class="form-control" placeholder="ID Member" /> 
                  </div>
               </div>
             <div class="form-group"> 
                <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Nama Suplier</div>
                    </div>
                    <input type="text" name="nm_supplier" id="nm_supplier" class="form-control" placeholder="Nama" />
                  </div>
               </div>  
              <div class="form-group"> 
                <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Alamat Suplier</div>
                    </div>
                    <textarea name="alamat" id="alamat" class="form-control" placeholder="Detail Alamat"></textarea>
                  </div>
               </div> 
               <div class="form-group"> 
                <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">No.Tlp Suplier</div>
                    </div>
                    <input type="text" name="telepon" id="telepon" class="form-control" placeholder="No.Telepon" />
                  </div>
               </div>
               <div class="form-group"> 
                <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">No.Hp Suplier</div>
                    </div>
                    <input type="text" name="fax" id="fax" class="form-control" placeholder="No.HP" />
                  </div>
               </div>                
                  
                <input type="submit" name="button_tambah" id="button_tambah" value="Tambah" class="btn btn-primary" />
                <input type="reset" name="button_reset" id="button_reset" value="Reset" class="btn btn-primary" />
               </form>
    </div>
</div><!------FORM---------->
<div class="col-sm-6"><!------TABEL---------->
  <h4 class="btn btn-default"><i class="fas fa-truck-loading"></i> DATA SUPLIER</h4><hr />	
    <div class="panel-body panel-default"> 
      <div class="table-responsive">
    	<table class="table table-bordered" >   
          <tr>
            <th>Kode</th>
            <th>Suplier</th>
            <th colspan="2">Alamat</th>           
            <th>Status</th>
            <th>Edit</th>
            </tr>
            <?php
            if($tampil_data==true){
        while($supplier=mysqli_fetch_array($supplier_paging)){        
        $kd_supplier	=$supplier['kd_supplier'];
        $nm_supplier	=$supplier['nm_supplier'];
        $alamat			=$supplier['almt_supplier'];
        $detail			=$supplier['almt'];
        $telepon		=$supplier['tlp_supplier'];
        $fax			=$supplier['fax_supplier'];
        $atas_nama		=$supplier['atas_nama'];
            ?>
          <tr class="isi_tabel">
            <td><?php echo $kd_supplier; ?><br /><?php echo $kategori; ?></td>
            <td><?php echo $nm_supplier; ?>&nbsp;</td>
            <td>
			<i class="fa fa-map"></i><br />
            <i class="fa fa-phone-square"></i><br />
			<i class="fa fa-mobile-phone"></i></td>
            <td>
            <?php echo $alamat; ?><br />
            <?php echo $telepon; ?><br />
			<?php echo $fax; ?>
            </td>
            <td><span class="btn btn-primary"><b><?php echo $atas_nama; ?>&nbsp;</b></span></td>
            <td><a href="<?php echo $_SERVER['PHP_SELF'] ?>?menu=data_sup&kd_supplier=<?php echo $kd_supplier; ?>&do=update"class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
            <a href="master_data/delete_supplier.php?kd_supplier=<?php echo $kd_supplier; ?>"class="btn btn-primary btn-xs"><i class="fa fa-trash"></i></a></td>
          </tr>
        <?php }} ?>
          <tr>
            <td colspan="8"><div class="pagination pagination-centered"><?php include('navigasi_paging.php'); ?></div></td>
            </tr>
        </table>
      </div>
    </div>
</div><!------TABEL---------->
<div class="col-sm-3"><!------FORM---------->
  <h4 class="btn btn-primary"><i class="fa fa-edit"></i> Edit Suplier</h4><hr />		
    <div class="panel-body panel-warning"> 
    	<form action="master_data/update_supplier.php" method="post" id="form_update">
         <div class="form-group"> 
                <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">ID Suplier</div>
                    </div>
                    <input name="kd_update" type="text" id="kd_update" value="<?php echo $kd_update; ?>" class="form-control" readonly />
                  </div>
               </div>
             <div class="form-group"> 
                <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Nama Suplier</div>
                    </div>
                    <input name="nm_update" type="text" id="nm_update" value="<?php echo $nm_update; ?>" class="form-control" />
                  </div>
               </div>  
              <div class="form-group"> 
                <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Alamat Suplier</div>
                    </div>
                    <textarea name="almt_update" id="almt_update" class="form-control" placeholder="<?php echo $almt_update; ?>"></textarea>
                  </div>
               </div> 
               <div class="form-group"> 
                <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">No.Tlp Suplier</div>
                    </div>
                    <input name="tlp_update" type="text" id="tlp_update" value="<?php echo $tlp_update; ?>" class="form-control" />
                  </div>
               </div>
               <div class="form-group"> 
                <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">No.Hp Suplier</div>
                    </div>
                    <input name="fax_update" type="text" id="fax_update" value="<?php echo $fax_update; ?>" class="form-control" />
                  </div>
               </div>
              
          
          <input type="submit" name="button_update" id="button_update" value="Update" class="btn btn-primary" />
          <input type="button" name="button_cancel" id="button_cancel" value="Cancel" onclick="hide(0)" class="btn btn-primary"/>
        </form>
    </div>
</div><!------FORM---------->
</div>
