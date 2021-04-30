<?php
$query_cek_satuan="SELECT * FROM tabel_satuan_barang";
$cek_satuan=mysqli_query($koneksi, $query_cek_satuan);
$hitung_record=mysqli_num_rows($cek_satuan);
include('paging.php');
$query_satuan_paging="SELECT * FROM tabel_satuan_barang LIMIT ".$start_record.",".$max_data."";
$satuan_paging=mysqli_query($koneksi, $query_satuan_paging);
?>

<?php 
if(isset($_GET['kd_satuan'])){
$kd_sat_update=$_GET['kd_satuan'];
$query_sat_update="SELECT * FROM tabel_satuan_barang WHERE kd_satuan='".$kd_sat_update."'";
$sat_update=mysqli_query($koneksi, $query_sat_update);
$data_sat_update=mysqli_fetch_array($sat_update);
$kd_sat=$data_sat_update['kd_satuan'];
$nm_sat=$data_sat_update['nm_satuan'];}
?>

<!--?php echo $param; ?>)"-->


<?php if(isset($_GET['stt'])){
$stt=$_GET['stt'];
echo "query ".$stt."";}
?> 
<div class="clearfix"></div>
<div class="col-sm-3"><!------FORM---------->
  <h4 class="btn btn-primary"><i class="fa fa-navicon"></i> INPUT</h4><hr />		
    <div class="panel-body panel-warning">
     <form action="master_data/simpan_satuan.php" method="post" id="form_tambah">
    	<div class="form-group">                              
           <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>				
                 <input type="text" name="kd_satuan" id="kd_satuan" placeholder="Kode Satuan" class="form-control" />
             </div>
         </div>
         <div class="form-group">                              
           <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>				
                 <input type="text" name="nm_satuan" id="nm_satuan" placeholder="Nama" class="form-control" />
             </div>
         </div> 
        <input type="submit" name="button_tambah" id="button_tambah" value="Tambah" class="btn btn-default" />
        <input type="reset" name="button_reset" id="button_reset" value="Reset" class="btn btn-default" />
        
      </form>
    </div>
</div><!------FORM---------->
<div class="col-sm-6"><!------TABEL---------->
  <h4 class="btn btn-primary"><i class="fa fa-table"></i> DATA</h4><hr />	
    <div class="panel-body panel-default"> 
      <div class="table-responsive">
    	<table class="table table-bordered" >  
          <tr>
            <th>Kode Satuan</th>
            <th>Nama Satuan</th>
            <th>Edit</th>
            </tr>
        <?php
        if($tampil_data==true){
        while($satuan=mysqli_fetch_array($satuan_paging)){
        $kd_satuan=$satuan['kd_satuan'];
        $nm_satuan=$satuan['nm_satuan']; 
        ?>
          <tr>
            <td><?php echo $kd_satuan; ?>&nbsp;</td>
            <td><?php echo $nm_satuan; ?>&nbsp;</td>
            <td><a href="<?php echo $_SERVER['PHP_SELF'] ?>?menu=satuan&kd_satuan=<?php echo $kd_satuan; ?>&do=update"class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
            <a href="master_data/delete_satuan.php?kd_satuan=<?php echo $kd_satuan; ?>"class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></a></td>
          </tr>
        <?php }} ?>
          <tr>
            <td colspan="3"><div class="pagination pagination-centered"><?php include('navigasi_paging.php'); ?></div></td>
            </tr>
        </table>
      </div>
    </div>
</div><!------TABEL---------->
<div class="col-sm-3"><!------FORM---------->
  <h4 class="btn btn-primary"><i class="fa fa-edit"></i> EDIT</h4><hr />		
    <div class="panel-body panel-warning"> 
      <form action="master_data/update_satuan.php" method="post" id="form_update">
    	<div class="form-group">                              
           <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>				
                <input name="kd_update" type="text" id="kd_update" value="<?php echo $kd_sat ?>" readonly class="form-control" />
             </div>
         </div>
         <div class="form-group">                              
           <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>				
                 <input name="nm_update" type="text" id="nm_update" value="<?php echo $nm_sat;  ?>" class="form-control" />
             </div>
         </div>
      <input type="submit" name="button_update" id="button_update" value="Update" class="btn btn-default" />
       <input type="reset" name="button_cancel" id="button_cancel" value="Cancel" onClick="hide(0)" class="btn btn-default" />
      
      </form>
    </div>
</div><!------FORM---------->
