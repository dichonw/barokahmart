<?php
include('inc/koneksi.php');
ini_set("display_errors",0);
if(isset($_POST['button_tambah'])){
$kategori	=$_POST ['kat_slide'];
$gambar		=$_POST ['gambar'];
$tipe_gambar 	= array('image/jpeg','image/bmp','image/png','image/jpg');
$nama 			= $_FILES['gambar']['name'];
$ukuran 		= $_FILES['gambar']['size'];
$tipe 			= $_FILES['gambar']['type'];
$error 			= $_FILES['gambar']['erorr'];
?>
<?php
if($nama==''){
mysqli_query($koneksi, "INSERT INTO tabel_slide VALUES ('','$kategori','$nama')");
echo $nama;
?><script language="JavaScript">document.location='?menu=promo'</script>
<?php 
}elseif($nama!=''){ 
if($nama !=="" && $ukuran > 0 && $error == 0){
if(in_array(strtolower($tipe), $tipe_gambar)){
unlink("master_data/slide/$nama");
move_uploaded_file($_FILES['gambar']['tmp_name'], 'master_data/slide/'.$nama);
mysqli_query($koneksi, "INSERT INTO tabel_slide VALUES ('','$kategori','$nama')");
?><script language="JavaScript">document.location='?menu=promo'</script>
<?php
}else{
echo "<script>alert('Maaf jangan memasukkan gambar selain JPG ,JPEG, BMP, dan PNG Max.Size 1Mb');window.history.go(-1);</script>"; }
}else{ echo"<script>alert('Gambar Tidak Boleh Kosong ');window.history.go(-1);";
} } }
?>
<?php
if(isset($_GET['id_slide'])){
$id_slide=$_GET['id_slide'];
$query_slide_update="SELECT * FROM tabel_slide WHERE id_slide='".$id_slide."'";
$slide_update=mysqli_query($koneksi, $query_slide_update);
$data_slide_update=mysqli_fetch_array($slide_update);
$id_slide_update	=$data_slide_update['id_slide'];
$kat_slide_update	=$data_slide_update['kat_slide'];
$gbr_slide_update	=$data_slide_update['gbr_slide'];
}
?>
<div class="row">
<div class="col-sm-3"><!------FORM---------->
  <h4 class="btn btn-primary"><i class="fas fa-project-diagram"></i> Buat Kategori</h4><hr />		
    <div class="panel-body panel-warning"> 
      <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">	
        
       <div class="form-group"> 
        <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">Kategori</div>
            </div>        
            <select name="kat_slide" class="form-control">
               <option value="utama">Utama</option>
               <option value="thumbnail">Thumbnail</option>
            </select>
          </div>
       </div>      
             
       <div class="form-group"> 
        <div class="custom-file mb-3">
          <input type="file" class="custom-file-input" id="customFile" name="gambar">
          <label class="custom-file-label" for="customFile">Pilih file</label>
        </div>    
       </div>
        <input type="submit" name="button_tambah" id="button_tambah" value="Tambah" class="btn btn-primary" />  
       </form>  
    </div>
</div><!------FORM---------->
<div class="col-sm-6"><!------TABEL---------->
  <h4 class="btn btn-default"><i class="fa fa-table"></i> DATA PROMO</h4><hr />	
    <div class="panel-body panel-default"> 
      <div class="table-responsive">
    		<table class="table table-bordered" > 
                <th>Kategori</th>
                <th>Ikon</th>
                <th>Edit</th>
                </tr>
<?php $query = "SELECT * FROM tabel_slide ORDER BY id_slide DESC";$result = mysqli_query($koneksi, $query);while ($sl = mysqli_fetch_array($result)){ 
$id_slide 	= $sl['id_slide'];
$kat_slide	= $sl['kat_slide'];
$gbr_slide	= $sl['gbr_slide'];
?>
              <tr>
                <td><?php echo $kat_slide; ?>&nbsp;</td>
                <td><img src="master_data/slide/<?php echo $gbr_slide; ?>" width="100" /></td>
                <td>
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>?menu=promo&id_slide=<?php echo $id_slide; ?>&do=update" class="btn btn-primary btn-xs"><i class="far fa-edit"></i></a>
                <a href="master_data/delete_slide.php?id_slide=<?php echo $id_slide; ?>"class="btn btn-primary btn-xs"><i class="fas fa-eraser"></i></a></td>
              </tr>
            <?php } ?>
              <tr>
                <td colspan="3"><div class="pagination pagination-centered"><?php include('navigasi_paging.php'); ?></div></td>
                </tr>
            </table>
      </div>
    </div>
</div><!------TABEL---------->
<div class="col-sm-3"><!------FORM---------->
  <h4 class="btn btn-primary"><i class="far fa-edit"></i> Edit Kategori</h4><hr />		
    <div class="panel-body panel-warning"> 
     <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
     	<input name="id_update" type="hidden" value="<?php echo $id_slide_update; ?>" class="form-control"/>
       <div class="form-group"> 
            <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-project-diagram"></i></div>
                </div>
                <select name="kat_update" class="form-control">
                  <option value="<?php echo $kat_slide_update; ?>"><?php echo $kat_slide_update; ?></option>
                  <option>--------------</option>
                  <option value="utama">Utama</option>
                  <option value="thumbnail">Thumbnail</option>
                </select>
              </div>
           </div>
        
       <div class="form-group"> 
        <div class="custom-file mb-3">
          <input type="file" class="custom-file-input" id="customFile" name="gbr_update">
          <label class="custom-file-label" for="customFile">Ganti file</label>
        </div>    
       </div> 
        <!--input type="submit" name="button_update" value="Update" class="btn btn-primary" /-->
        <button type="submit" name="button_ubah" class="btn btn-primary">Ubah</button>
     </form>
    </div>
</div><!------FORM---------->
</div>
<?php
include('inc/koneksi.php');
ini_set("display_errors",0);
if(isset($_POST['button_ubah'])){
$id			=$_POST ['id_update'];	
$kat		=$_POST ['kat_update'];
$gbr		=$_POST ['gbr_update'];
$tipe_gambar 	= array('image/jpeg','image/bmp','image/png','image/jpg');
$namax 			= $_FILES['gbr_update']['name'];
$ukuran 		= $_FILES['gbr_update']['size'];
$tipe 			= $_FILES['gbr_update']['type'];
$error 			= $_FILES['gbr_update']['erorr'];
?>
<?php
if($namax==''){
mysqli_query($koneksi, "UPDATE `tabel_slide` SET `kat_slide`='$kat',`gbr_slide`='$namax' WHERE `id_slide`='$id' ");
echo $namax;
?><script language="JavaScript">document.location='?menu=promo'</script>
<?php 
}elseif($namax!=''){ 
if($namax !=="" && $ukuran > 0 && $error == 0){
if(in_array(strtolower($tipe), $tipe_gambar)){
unlink("master_data/slide/$namax");
move_uploaded_file($_FILES['gbr_update']['tmp_name'], 'master_data/slide/'.$namax);
mysqli_query($koneksi, "UPDATE `tabel_slide` SET `kat_slide`='$kat',`gbr_slide`='$namax' WHERE `id_slide`='$id' ");
?><script language="JavaScript">document.location='?menu=promo'</script>
<?php
}else{
echo "<script>alert('Maaf jangan memasukkan gambar selain JPG ,JPEG, BMP, dan PNG Max.Size 1Mb');window.history.go(-1);</script>"; }
}else{ echo"<script>alert('Gambar Tidak Boleh Kosong ');window.history.go(-1);";
} } }
?>
<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>