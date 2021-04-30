<?php
session_start();
error_reporting(error_reporting() & ~E_NOTICE);

$query_cek_toko = "SELECT * FROM tabel_toko";
$cek_toko = mysqli_query($koneksi, $query_cek_toko);
$hitung_record = mysqli_num_rows($cek_toko);
include('paging.php');
$query_toko_paging = "SELECT * FROM tabel_toko LIMIT " . $start_record . ", " . $max_data . "";
$toko_paging = mysqli_query($koneksi, $query_toko_paging);
?>
<?php
if (isset($_GET['kd_toko'])) {
  $kd_toko = $_GET['kd_toko'];
  $query_data_update = "SELECT * FROM tabel_toko WHERE kd_toko='" . $kd_toko . "'";
  $toko_update = mysqli_query($koneksi, $query_data_update);
  $data_toko_update = mysqli_fetch_array($toko_update);
  $kd_toko_update    = $data_toko_update['kd_toko'];
  $nm_toko_update    = $data_toko_update['nm_toko'];
  $alamat_update    = $data_toko_update['almt_toko'];
  $telepon_update    = $data_toko_update['tlp_toko'];
  $fax_update      = $data_toko_update['fax_toko'];
  $status_update    = $data_toko_update['status'];
  $password_update    = $data_toko_update['password'];
  $logo_update    = $data_toko_update['logo'];
}
?>


<!--?php echo $param; ?>)"-->
<?php
if (isset($_GET['stt'])) {
  $stt = $_GET['stt'];
  echo "query " . $stt . "";
}
?>
<div class="row">
 <!--  ----FORM---------- -->
<div class="col-sm-3">
  <h4 class="btn btn-primary"><i class="fa fa-inbox"></i> INPUT</h4><hr />    
    <div class="panel-body panel-warning"> 
      <form action="master_data/simpan_cabang_toko.php" method="post" enctype="multipart/form-data" id="form_tambah">  
        <div class="form-group">                              
           <div class="input-group">       
                 <input type="text" name="kd_toko" id="kd_toko" placeholder="Kode Toko (Contoh MM001, MM002 dst)" class="form-control" />
             </div>
         </div>
         <div class="form-group">                              
           <div class="input-group">       
                 <input type="text" name="nm_toko" id="nm_toko" placeholder="Nama Toko" class="form-control" />
             </div>
         </div>
          <div class="form-group">                              
           <div class="input-group">
                 <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat" ></textarea>
             </div>
         </div>
         <div class="form-group">                              
           <div class="input-group">      
                 <input type="text" name="telepon" id="telepon" class="form-control" placeholder="No.Telepon" />
             </div>
         </div>
         <div class="form-group">                              
           <div class="input-group">     
                 <input type="text" name="fax" id="fax" class="form-control" placeholder="No.HP" />
             </div>
         </div>
         <div class="form-group">                              
           <div class="input-group">       
                 <input type="file" name="file_logo" id="file_logo" />
             </div>
         </div>
         <div class="form-group">                              
           <div class="input-group">       
                 <select name="status" id="status" class="form-control">                  
                  <option value="buka">Buka</option>
                  <option value="tutup">Tutup</option>
                </select>
             </div>
         </div>
        <div class="form-group">                              
           <div class="input-group">   
                 <input type="password" name="password" id="password" placeholder="password" class="form-control" />
             </div>
         </div> 
      <input type="submit" name="button_tambah" id="button_tambah" value="Tambah" class="btn btn-default" />
      <input type="reset" name="button_reset" id="button_reset" value="Reset" class="btn btn-default" />
       </form>  
    </div>
</div>
<!-- ------FORM-------- -->
  <div class="col-sm-6">
    <!------TABEL---------->
    <h4 class="btn btn-primary"><i class="fa fa-table"></i> DATA</h4>
    <hr />
    <div class="panel-body panel-default">
      <div class="table-responsive">
        <table class="table table-bordered" style="font-size:12px">
          <tr>
            <th>Kode</th>
            <th>Toko</th>
            <th>Alamat</th>
            <th>Tlp</th>
            <th>Hp</th>
            <th>Logo</th>
            <th>Status</th>
            <th>Edit</th>
          </tr>
          <?php
          if ($tampil_data == true) {
            while ($toko = mysqli_fetch_array($toko_paging)) {
              $kd_toko = $toko['kd_toko'];
              $nm_toko = $toko['nm_toko'];
              $alamat = $toko['almt_toko'];
              $telepon = $toko['tlp_toko'];
              $fax = $toko['fax_toko'];
              $logo = $toko['logo'];
              $status = $toko['status'];
          ?>
              <tr>
                <td><?php echo $kd_toko; ?></td>
                <td><?php echo $nm_toko; ?></td>
                <td><?php echo $alamat; ?>&nbsp;</td>
                <td><?php echo $telepon; ?>&nbsp;</td>
                <td><?php echo $fax; ?>&nbsp;</td>
                <td><img src="images/<?php echo $logo; ?>" width="80" height="auto" /> &nbsp;</td>
                <td><?php echo $status; ?>&nbsp;</td>
                <td>
                  <?php if ($kd_toko != $_SESSION['kd_toko']){?>
                    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?menu=branch-shop&kd_toko=<?php echo $kd_toko; ?>&do=update" class="btn btn-secondary btn-sm btn-xs disabled"><i class="fas fa-user-edit"></i></a>
                    <a href="master_data/delete_cabang_toko.php?kd_toko=<?php echo $kd_toko; ?>" class="btn btn-secondary btn-sm btn-xs disabled"><i class="fa fa-trash"></i></a></td>
                  <?php } else {
                  ?><a href="<?php echo $_SERVER['PHP_SELF'] ?>?menu=branch-shop&kd_toko=<?php echo $kd_toko; ?>&do=update" class="btn btn-primary btn-sm btn-xs"><i class="fas fa-user-edit"></i></a>
                    <a href="master_data/delete_cabang_toko.php?kd_toko=<?php echo $kd_toko; ?>" class="btn btn-primary btn-sm btn-xs"><i class="fa fa-trash"></i></a></td>
                  <?php }
                  ?>
                  
              </tr>
          <?php }
          } ?>
          <tr>
            <td colspan="9">
              <div class="pagination pagination-centered"><?php include('navigasi_paging.php'); ?></div>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <!------TABEL---------->
  <div class="col-sm-3">
    <!------FORM---------->
    <h4 class="btn btn-primary"><i class="fa fa-edit"></i> EDIT</h4>
    <hr />
    <div class="panel-body panel-warning">
      <form action="master_data/update_cabang_toko.php" method="post" enctype="multipart/form-data" id="form_update">
        <input name="kd_toko_update" type="hidden" id="kd_toko_update" value="<?php echo $kd_toko_update; ?>" readonly class="form-control" />
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">Nama Toko</div>
            </div>
            <input name="nm_toko_update" type="text" id="nm_toko_update" value="<?php echo $nm_toko_update; ?>" class="form-control" />
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">Alamat</div>
            </div>
            <textarea name="alamat_update" id="alamat_update" class="form-control"><?php echo $alamat_update; ?></textarea>
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">No.Telepon</div>
            </div>
            <input name="telepon_update" type="text" id="telepon_update" value="<?php echo $telepon_update; ?>" class="form-control" />
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">No.HP</div>
            </div>
            <input name="fax_update" type="text" id="fax_update" value="<?php echo $fax_update; ?>" class="form-control" />
          </div>
        </div>

        <!-- <div class="form-group"> 
        <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">Logoku</div>
            </div>
            <input type="file" name="logo_update" id="logo_update" value="<?php echo $logo_update; ?>" />
          </div>
       </div> -->

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">Sedang</div>
            </div>
            <select name="status_update" id="status_update" class="form-control">
              <option value="<?php echo $status_update; ?>"><?php echo $status_update; ?></option>
              <option>--------</option>
              <option value="tutup">Tutup</option>
              <option value="buka">Buka</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">Passwordku</div>
            </div>
            <input type="password" name="password_update" id="password_update" class="form-control" value="<?php echo $password_update; ?>" />
          </div>
        </div>


        <input type="submit" name="button_update" id="button_update" value="Update" class="btn btn-default" />
        <input type="reset" name="button_cancel" id="button_cancel" value="Cancel" onClick="hide(0)" class="btn btn-default" />
      </form>
    </div>
  </div>
  <!------FORM---------->
</div>