<?php
// session_start();
error_reporting(error_reporting() & ~E_NOTICE);


if (!isset($_SESSION['kd_toko']) && !isset($_SESSION['status_toko'])) {
  header('location:akses/login_toko.php');
} else if (!isset($_SESSION['id_user']) && !isset($_SESSION['status_user'])) {
  header('location:akses/login_user.php');
} else if (!isset($_SESSION['kd_kurir'])) {
  header('location:../?menu=kurir');
  } else {
  $status_toko = $_SESSION['status_toko'];
  $status_user = $_SESSION['status_user'];
}
?>
<?php
$query_data_satuan = "SELECT * FROM tabel_satuan_barang";
$query_data_kategori = "SELECT * FROM tabel_kategori_barang ORDER BY nm_kategori ASC";
$ambil_satuan = mysqli_query($koneksi, $query_data_satuan);
$ambil_kategori = mysqli_query($koneksi, $query_data_kategori);


$query_cek_barang = "SELECT * FROM tabel_barang";
$cek_barang = mysqli_query($koneksi, $query_cek_barang);
$hitung_record = mysqli_num_rows($cek_barang);
include('paging.php');
$query_barang_paging = "SELECT tabel_barang.* ,tabel_satuan_barang.nm_satuan, tabel_kategori_barang.nm_kategori 
FROM tabel_barang,tabel_satuan_barang,tabel_kategori_barang 
WHERE tabel_barang.kd_satuan=tabel_satuan_barang.kd_satuan AND tabel_barang.kd_kategori=tabel_kategori_barang.kd_kategori ORDER BY kd_barang ASC LIMIT " . $start_record . "," . $max_data . "";
$barang_paging = mysqli_query($koneksi, $query_barang_paging);


if (isset($_GET['kd_barang'])) {
  $kd_barang = $_GET['kd_barang'];
  $query_barang_update = "SELECT * FROM tabel_barang WHERE kd_barang='" . $kd_barang . "'";
  $barang_update = mysqli_query($koneksi, $query_barang_update);
  $data_barang_update = mysqli_fetch_array($barang_update);
  $kd_update    = $data_barang_update['kd_barang'];
  $nm_update    = $data_barang_update['nm_barang'];
  $deskripsi    = $data_barang_update['deskripsi'];
  $jual_update  = $data_barang_update['hrg_jual'];
  $grosir_update  = $data_barang_update['hrg_grosir'];
  $beli_update  = $data_barang_update['hrg_beli'];
}
?>

<script>
  function proses() {
    var kd_barang = document.getElementById('kd_barang').value;
    document.location.href = "master_data/data_barang_kode.php?kd_barang=" + kd_barang;
  }
</script>
<!--?php echo $param; ?-->
<?php if (isset($_GET['stt'])) {
  $stt = $_GET['stt'];
  echo "Perubahan Data " . $stt . "!!!";
} ?>
<div class="row">

  <div class="col-sm-6 col-12">
    <!------TABEL---------->
    <h4 class="btn btn-primary">DAFTARKAN BARANG BARU</h4>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fa fa-barcode"></i></div>
        </div>
        <input type="text" name="kd_barang" id="kd_barang" class="form-control" autofocus="autofocus" onchange="proses()" placeholder="Masukkan barcode barang" value="<?php echo $_SESSION['kd_kurir']?>" />
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-12">
    <!------TABEL---------->
    <form action="master_data/update_barang.php" method="post" id="form_update">
      <input type="hidden" name="kd_toko" value="<?php echo $_SESSION['kd_toko'] ?>" />

      <div class="form-group">
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text">Kode Barang &nbsp;</div>
          </div>
          <input type="text" name="kd_update" class="form-control" value="<?php echo (empty($kd_update) ? '' : $kd_update); ?>" readonly />
        </div>
      </div>

      <div class="form-group">
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text"><abbr title="wajib diisi">*</abbr> Nama Barang</div>
          </div>
          <input type="text" name="nm_update" class="form-control" value="<?php echo (empty($nm_update) ? '' : $nm_update); ?>" placeholder="Nama Barang" required="required" />
        </div>
      </div>

      <div class="form-group">
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text">Satuan</div>
          </div>
          <select name="sat_update" class="form-control">
            <?php
            $ambil_sat_update = mysqli_query($koneksi, $query_data_satuan);
            while ($sat_update = mysqli_fetch_array($ambil_sat_update)) {
              $kd_sat_update = $sat_update['kd_satuan'];
              $nm_sat_update = $sat_update['nm_satuan'];
              echo "<option value=" . $kd_sat_update . ">" . $nm_sat_update . "</option>";
            }
            ?>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-6">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">Kategori</div>
              </div>
              <select name="kat_update" class="form-control">
                <option disabled selected>Pilih Kategori</option>
                <?php
                $ambil_kat_update = mysqli_query($koneksi, $query_data_kategori);
                while ($kat_update = mysqli_fetch_array($ambil_kat_update)) {
                  $kd_kat_update = $kat_update['kd_kategori'];
                  $nm_kat_update = $kat_update['nm_kategori'];
                  echo "<option value=" . $kd_kat_update . ">" . $nm_kat_update . "</option>";
                }
                ?>
              </select>
            </div>
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">Tagihan</div>
              </div>
              <select name="kat_update" class="form-control">
                <option disabled selected>Pilih Tagihan</option>
                <?php
                $ambil_kat_update = mysqli_query($koneksi, "SELECT * FROM `tabel_jenis_baru`, tabel_kategori_baru WHERE tabel_jenis_baru.id_kategori_baru = tabel_kategori_baru.id_kategori_baru");
                while ($kat_update = mysqli_fetch_array($ambil_kat_update)) {
                  $kd_kat_update = $kat_update['id_jenis_baru'];
                  $nm_kat_update = $kat_update['nama_kategori_baru'];
                  $nm_jen_update = $kat_update['nama_jenis_baru'];

                  echo "<option value=" . $kd_kat_update . ">" . $nm_kat_update . " " . $nm_jen_update . "</option>";
                }
                ?>
              </select>
            </div>
          </div>
        </div>
      </div>


      <div class="form-group">
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text">Spesifikasi</div>
          </div>
          <textarea name="deskripsi" class="form-control" value="<?php echo $deskripsi_update; ?>"> Tulis Deskripsi barang </textarea>
        </div>
      </div>

      <!--div class="form-group"> 
    <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">Deskripsi</div>
        </div>
         <input type="text" name="ukuran" class="form-control" value="<?php echo $ukuran_update; ?>" placeholder="Deskripsi" />
      </div>
   </div-->

      <div class="form-group">
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text">Harga Beli</div>
          </div>
          <input type="text" name="beli_update" class="form-control" value="<?php echo (empty($beli_update)) ? '' : $beli_update; ?>" placeholder="Harga Beli" />
        </div>
      </div>

      <div class="form-group">
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text">Harga Jual</div>
          </div>
          <input type="text" name="jual_update" class="form-control" value="<?php echo (empty($jual_update) ? '' : $jual_update); ?>" placeholder="Harga Jual" />
        </div>
      </div>

      <div class="form-group">
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text">Harga Grosir</div>
          </div>
          <input type="text" name="grosir_update" class="form-control" value="<?php echo (empty($grosir_update)) ? '' : $grosir_update; ?>" placeholder="Harga Jual Grosir" />
        </div>
      </div>

      <div class="form-group">
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text"><abbr title="wajib diisi">*</abbr> Stok Awal</div>
          </div>
          <input type="text" name="stok" id="stok" class="form-control" placeholder="Jumlah Stok" required="required" />
        </div>
      </div>



      <input type="submit" name="button_update" id="button_update" value="Daftarkan Barang" class="btn btn-primary" />
      <input type="reset" name="button_cancel" id="button_cancel" value="Cancel" onClick="hide(0)" class="btn btn-primary" />

    </form>
  </div>

</div>














</div>
<!------FORM---------->

<!----------FILTER TABEL-------------------------------------------->
</div>