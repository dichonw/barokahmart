<link href="../script/style.css" rel="stylesheet" type="text/css">
<link href="../../kasir/main/script/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../../kasir/main/script/css/font/css/fontawesome.min.css" rel="stylesheet" type="text/css">
<div class="container-fluid pl-0 pr-0 ml-0 mr-0">
  <span class="btn btn-block btn-dark text-center text-light text-uppercase mt-4 pt-5"> 
	 Data <?php echo $nm_member; ?></span>	
  <div class="container">
<?php
ini_set("display_errors",0);
if(isset($_POST['edit_data'])){	
$kd_member		=$_POST ['id_member'];
$nm_member		=$_POST ['nm_member'];
$hp_member		=$_POST ['hp_member'];
$pass_member	=$_POST ['pass_member'];
$almt_member	=$_POST ['almt_member'];
if(empty($kd_member)) { 
}else {
$query = "UPDATE `tabel_member` SET `nm_user`='$nm_member',`hp`='$hp_member',`password`=md5('$pass_member'),`pass_user`='$pass_member',`alamat_user`='$almt_member' WHERE `id_user`='$kd_member'" ;
$hasil = mysqli_query($koneksi, $query);
echo "<script language='JavaScript'>document.location='?menu=akun'</script>";
}
}
?>
        <div class="row py-4">        
        <div class="col-lg-6 mx-auto"> 
        
          <!--img src="master/foto/<?php echo $foto; ?>" class="img-fluid text-center" width="250" />          
            <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                <input id="upload" type="file" onchange="readURL(this);" class="form-control border-0">
                <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose file</label>
                <div class="input-group-append">
                    <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Pilih file</small></label>
                </div>
            </div>
            <p class="font-italic text-white text-center">Gambar yang diunggah akan ditampilkan di dalam kotak di bawah ini.</p>
            <div class="image-area mt-4">
            <img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>

        </div>
    </div-->
        

    <div class="form-group"> 
      <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>"> 
      <input name="id_member" type="hidden" value="<?php echo $kd_member; ?>" /> 
         <label class="text-capitalize">Pengguna</label>
          <div class="input-group">
           <div class="input-group-prepend">
            <div class="input-group-text"><i class="far fa-user"></i></div>
             </div> 
                 <input type="text" name="nm_member" class="form-control" value="<?php echo $nm_member; ?>">
           </div>     
        </div>
    <div class="form-group"> 
         <label class="text-capitalize">Nomer Handphone</label>
          <div class="input-group">
           <div class="input-group-prepend">
            <div class="input-group-text"><i class="fab fa-whatsapp"></i></div>
             </div> 
                 <input type="text" name="hp_member" class="form-control" value="<?php echo $hp_member; ?>">
           </div>     
        </div> 
     <div class="form-group"> 
         <label class="text-capitalize">Password</label>
          <div class="input-group">
           <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-unlock-alt"></i></div>
             </div> 
                 <input type="text" name="pass_member" class="form-control" value="<?php echo $pass_member; ?>">
           </div>     
        </div>  
      <div class="form-group"> 
         <label class="text-capitalize">Alamat</label>
          <div class="input-group">
           <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-map-marker-alt"></i></div>
             </div> 
                 <input type="text" name="almt_member" class="form-control" value="<?php echo $almt_member; ?>">
           </div>     
        </div>  
        <button name="edit_data" class="btn btn-primary" type="submit">UPDATE</button>     
      </form>     
  
  </div>
</div><!---------CONTAINER-------->