<link href="../script/css/style.css" rel="stylesheet" type="text/css">
<link href="../script/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../script/css/font/css/fontawesome.min.css" rel="stylesheet" type="text/css">
<?php
session_start();
if (!isset($_SESSION['kd_toko']) && !isset($_SESSION['status_toko'])) {
  header('location:akses/login_toko.php');
} else if (!isset($_SESSION['id_user']) && !isset($_SESSION['status_user'])) {
  header('location:akses/login_user.php');
} else {
  $status_toko = $_SESSION['status_toko'];
  $status_user = $_SESSION['status_user'];
}
?>

<?php
$sql = "select * from tabel_barang Where kd_barang='$_GET[kd_barang]'";
$qry = mysqli_query($koneksi, $sql);
$a = mysqli_fetch_array($qry); ?>
<?php
if (isset($_POST["kirim"])) {
  $jumlah = count($_FILES['gambar']['name']);
  if ($jumlah > 0) {
    for ($i = 0; $i < $jumlah; $i++) {
      $file_name = $_FILES['gambar']['name'][$i];
      $tmp_name = $_FILES['gambar']['tmp_name'][$i];
      move_uploaded_file($tmp_name, "master_data/images/" . $file_name);
      mysqli_query($koneksi, "INSERT INTO tabel_barang_gambar VALUES('','$a[kd_barang]','$file_name','')");
    }
    echo "Berhasil Upload";
  } else {
    echo "Gambar tidak ada";
  }
}
?>
<h2 class="font-weight-light text-center text-lg-left mt-4 mb-0">Upload Foto untuk <?php echo $a['nm_barang']; ?> Kode <?php echo $a['kd_barang']; ?></h2>
<hr class="mt-2 mb-5">
<div class="row">
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="col">
      <h3 class="font-weight-light text-center text-lg-left mt-4 mb-0">Image Upload</h3>
      <hr class="mt-2 mb-5">
      <!-- Upload image input-->
      <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
        <input id="upload" type="file" onchange="readURL(this);" class="form-control border-0" name="gambar[]">
        <label id="upload-label" for="upload" class="font-weight-light text-muted">Pilih file</label>
        <div class="input-group-append">
          <label for="upload" class="btn btn-light m-0 rounded-pill px-4">
            <i class="fa fa-cloud-upload mr-2 text-muted"></i>
            <small class="text-uppercase font-weight-bold text-muted">Pilih file</small></label>
        </div>
      </div>
      <input type="submit" name="kirim" id="button_update" value="UPLOAD" class="btn btn-primary" />
  </form>
  <p class="font-italic text-white text-center">View image</p>
  <div class="image-area mt-4">
    <img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block">
  </div>
  <!-- Uploaded image area-->
</div>
<div class="col">
  <!-- View image area-->
  <h3 class="font-weight-light text-center text-lg-left mt-4 mb-0">Image View</h3>
  <hr class="mt-2 mb-5">
  <div class="row text-center text-lg-left">
    <?php $query = "SELECT * FROM tabel_barang_gambar WHERE id_brg='$_GET[kd_barang]' ORDER BY id_gmbr DESC";
    $result = mysqli_query($koneksi, $query);
    while ($gbr = mysqli_fetch_array($result)) {
    ?>

      <div class="col-lg-3 col-md-4 col-6">
        <div class="item d-block mb-4 h-100">
          <a href="?menu=del_gbr&id_gmbr=<?php echo $gbr['id_gmbr']; ?>">
            <span class="notify-badge bg-danger"><i class="fas fa-trash-alt"></i></span>
            <img class="img-fluid img-thumbnail" src="master_data/images/<?php echo $gbr['gambar']; ?>" />
          </a>
        </div>
      </div>
    <?php } ?>
  </div>
  <!-- View image area-->
</div>
</div>
<a href="?menu=stok" class="btn btn-block btn-primary"> SELESAI</a>
<script>
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#imageResult')
          .attr('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
  $(function() {
    $('#upload').on('change', function() {
      readURL(input);
    });
  });
  var input = document.getElementById('upload');
  var infoArea = document.getElementById('upload-label');

  input.addEventListener('change', showFileName);

  function showFileName(event) {
    var input = event.srcElement;
    var fileName = input.files[0].name;
    infoArea.textContent = 'File name: ' + fileName;
  }
</script>