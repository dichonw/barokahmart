<?php include('../inc/koneksi.php');
if ($_POST['idx']) {
     $id      = $_POST['idx'];
     $data      = mysqli_query($koneksi, "SELECT * FROM tabel_barang WHERE kd_barang = '$id'");
     $d           = mysqli_fetch_array($data);
}
$idbrg               = $d['kd_barang'];
$hrg_jual          = $d['hrg_jual'];
$hrg_grosir          = $d['hrg_grosir'];
?>

<form action="master_data/update_harga.php" method="post">
     <input type="hidden" name="kd_barang" class="form-control" value="<?php echo $idbrg; ?>" readonly>
     <div class="form-group">
          <label>Harga Normal</label>
          <div class="input-group">
               <input type="text" name="diskon" class="form-control" value="<?php echo $hrg_jual; ?>" readonly>
          </div>
     </div>
     <div class="form-group">
          <label>Harga Diskon</label>
          <div class="input-group">
               <input type="text" name="hrg_jual" class="form-control">
          </div>
     </div>
     <button type="submit" name="edit" class="btn btn-primary btn-lg">Ubah Data</button>
</form>