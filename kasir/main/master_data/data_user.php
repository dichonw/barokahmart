<?php
session_start();
$query_cek_tabel="SELECT u.*, t.* FROM tabel_user u INNER JOIN tabel_toko t ON u.kd_toko = t.kd_toko";
$cek_tabel=mysqli_query($koneksi, $query_cek_tabel);
$hitung_record=mysqli_num_rows($cek_tabel);
include('paging.php');
$query_user_paging="SELECT u.*, t.* FROM tabel_user u INNER JOIN tabel_toko t ON u.kd_toko = t.kd_toko LIMIT ".$start_record.", ".$max_data."";
$user_paging=mysqli_query($koneksi, $query_user_paging);
?>

<?php
if(isset($_GET['id_user'])){
$id_user=$_GET['id_user'];
$query_user_for_update="SELECT * FROM tabel_user WHERE id_user='".$id_user."'";
$user_for_update=mysqli_query($koneksi, $query_user_for_update);
$user_update=mysqli_fetch_array($user_for_update);
$id_update=$user_update['id_user'];
$nm_update=$user_update['nm_user'];
$akses_update=$user_update['akses'];}
?>

<!--?php echo $param; ?-->
<?php
if(isset($_GET['stt'])){
$stt=$_GET['stt'];
echo "query ".$stt."";}
?> 
<div class="row">
<div class="col-sm-3"><!------FORM---------->
  <h4 class="btn btn-primary"><i class="fa fa-inbox"></i> INPUT</h4><hr />		
    <div class="panel-body panel-warning"> 
      <form action="master_data/simpan_user.php" method="post" id="form_tambah">	
        
       <div class="form-group"> 
        <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">Nama</div>
            </div>
            <input type="text" name="nm_user" id="nm_user" class="form-control" placeholder="Nama" />
          </div>
       </div> 
       <div class="form-group"> 
        <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">Store</div>
            </div>
            <select name="kd_toko" id="kd_toko" class="form-control">
					<?php
                    $query_kd_toko=mysqli_query($koneksi, "SELECT * FROM tabel_toko");
                    while($result_kd_toko=mysqli_fetch_array($query_kd_toko)){  
					$kd_toko=$result_kd_toko['kd_toko'];  
					$nm_toko=$result_kd_toko['nm_toko'];               
                    echo "<option value=".$kd_toko.">".$nm_toko."</option>";}
                    ?>
                </select>
          </div>
       </div> 
       <div class="form-group"> 
        <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">Password</div>
            </div>
            <input type="password" name="password" id="password" class="form-control" placeholder="password" />
          </div>
       </div> 
       <div class="form-group"> 
        <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">Jabatan</div>
            </div>
             <select name="akses" id="akses" class="form-control">
                    <option value="manager">Manager</option>
                    <option value="admin">Admin</option>
                    <option value="kasir">Kasir</option>
                    <option value="gudang">Gudang</option>
      			</select>
          </div>
       </div>
        <input type="submit" name="button_tambah" id="button_tambah" value="Tambah" class="btn btn-primary" />
        <input type="reset" name="button_reset" id="button_reset" value="Reset" class="btn btn-primary" />
       </form>  
    </div>
</div><!------FORM---------->

<div class="col-sm-6"><!------TABEL---------->
  <h4 class="btn btn-primary"><i class="fa fa-table"></i> DATA</h4><hr />	
    <div class="panel-body panel-default"> 
    	<div class="table-responsive">
            <table class="table table-bordered" >    
              <tr>
                <th class="hidden-phone">Id User</th>
                <th class="hidden-phone">Kode Toko</th>
                <th>Nama User</th>
                <th>Jabatan</th>
                <th>Toko</th>
                <th>Pilihan</th>
                </tr>
            <?php
            if($tampil_data==true){
            while($data_user=mysqli_fetch_array($user_paging)){
            $id_user=$data_user['id_user'];
            $nm_user=$data_user['nm_user'];
            $akses=$data_user['akses'];
            $kd_toko=$data_user['kd_toko'];
            $nm_toko=$data_user['nm_toko'];
            ?>
              <tr>
                <td class="hidden-phone"><?php echo $id_user; ?>&nbsp;</td>
                <td class="hidden-phone"><?php echo $kd_toko; ?>&nbsp;</td>
                <td><?php echo $nm_user; ?>&nbsp;</td>
                <td><?php echo $akses; ?>&nbsp;</td>
                <td><?php echo $nm_toko; ?>&nbsp;</td>
                <?php if ($kd_toko != $_SESSION['kd_toko']){?>
                      <td><a href="<?php echo $_SERVER['PHP_SELF']; ?>?menu=user&id_user=<?php echo $id_user; ?>&do=update"class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
                      <a href="master_data/delete_user.php?id_user=<?php echo $id_user; ?>"class="btn btn-secondary btn-xs disabled"><i class="fa fa-trash"></i></a></td>
                <?php } else {
                    ?><td><a href="<?php echo $_SERVER['PHP_SELF']; ?>?menu=user&id_user=<?php echo $id_user; ?>&do=update"class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
                    <a href="master_data/delete_user.php?id_user=<?php echo $id_user; ?>"class="btn btn-default btn-xs"><i class="fa fa-trash"></i></a></td>
                <?php }
                ?>   
              </tr>
            <?php }} ?>
              <tr>
                <td colspan="5"><div class="pagination pagination-centered"><?php include('navigasi_paging.php'); ?></div></td>
                </tr>
            </table>
            </div>
    </div>
</div><!------TABEL---------->

<div class="col-sm-3"><!------FORM---------->
  <h4 class="btn btn-primary"><i class="fa fa-edit"></i> EDIT</h4><hr />		
    <div class="panel-body panel-warning"> 
      <form action="master_data/update_user.php" method="post" id="form_update">	
        <div class="form-group">                              
           <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>				
                 <input name="id_update" type="text" id="id_update" value="<?php echo $id_update; ?>" readonly class="form-control" />
             </div>
         </div>         
         <div class="form-group">                              
           <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>				
                 <input name="nm_update" type="text" id="nm_update" value="<?php echo $nm_update; ?>" class="form-control" />
             </div>
         </div>
         <div class="form-group">                              
           <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>				
                 <input type="text" name="pass_update" id="pass_update" class="form-control" placeholder="password" />
             </div>
         </div>
       	 <div class="form-group">                              
           <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>				
                 <select name="kd_toko_update" id="kd_toko_update" class="form-control">
					<?php
                    $query_kd_toko=mysqli_query($koneksi, "SELECT * FROM tabel_toko");
                    while($result_kd_toko=mysqli_fetch_array($query_kd_toko)){  
					$kd_toko=$result_kd_toko['kd_toko'];  
					$nm_toko=$result_kd_toko['nm_toko'];               
                    echo "<option value=".$kd_toko.">".$nm_toko."</option>";}
                    ?>
     			 </select>
             </div>
         </div>
         <div class="form-group">                              
           <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>				
                 <select name="akses_update" id="akses_update" class="form-control">
                    <option value="manager">Manager</option>
                    <option value="admin">Admin</option>
                    <option value="kasir">Kasir</option>
                    <option value="gudang">Gudang</option>
                  </select>
             </div>
         </div>
        <input type="submit" name="button_update" id="button_update" value="Update" class="btn btn-default" />
        <input type="reset" name="button_cancel" id="button_cancel" value="Cancel" onClick="hide(0)" class="btn btn-default" />
       </form>  
    </div>
</div><!------FORM---------->

</div>