<?php
// session_start();
error_reporting(error_reporting() & ~E_NOTICE);


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
error_reporting(error_reporting() & ~E_NOTICE);

$query_cek_kategori = "SELECT * FROM tabel_kategori_barang";
$cek_kategori = mysqli_query($koneksi, $query_cek_kategori);
$hitung_record = mysqli_num_rows($cek_kategori);
include('paging.php');
$query_kategori_paging = "SELECT * FROM tabel_kategori_barang LIMIT " . $start_record . ", " . $max_data . "";
$kategori_paging = mysqli_query($koneksi, $query_kategori_paging);
$query_data_satuan = "SELECT * FROM tabel_satuan_barang";
?>

<?php
if (isset($_GET['kd_kategori'])) {
  $kd_kategori = $_GET['kd_kategori'];
  $query_kat_update = "SELECT * FROM tabel_kategori_barang WHERE kd_kategori='" . $kd_kategori . "'";
  $kat_update = mysqli_query($koneksi, $query_kat_update);
  $data_kat_update = mysqli_fetch_array($kat_update);
  $kd_kat_update = $data_kat_update['kd_kategori'];
  $nm_kat_update = $data_kat_update['nm_kategori'];
  $gbr_kat_update = (empty($data_kat_update['ikon_kategori']) ? '' : $data_kat_update['ikon_kategori']);
}
?>

<?php
if (isset($_GET['kd_kurir'])) {
  $kd_kurir = $_GET['kd_kurir'];
  $query_kur_update = "SELECT * FROM tabel_kurir WHERE id_kurir ='" . $kd_kurir . "'";
  $kur_update = mysqli_query($koneksi, $query_kur_update);
  $data_kur_update = mysqli_fetch_array($kur_update);
  $kd_kur_update = $data_kur_update['id_kurir'];
  $nm_titikawal_update = $data_kur_update['titik_awal'];
  $nm_titikakhir_update = $data_kur_update['titik_akhir'];
  $nm_harga_update = $data_kur_update['harga'];
}
?>


<!--?php echo $param; ?>)"-->
<?php if (isset($_GET['stt'])) {
  $stt = $_GET['stt'];
  echo "query " . $stt . "";
}
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card mt-3 tab-card">
        <div class="card-header tab-card-header">
          <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One" aria-selected="true">Kategori Barang</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two" aria-selected="false">Kategori Tagihan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="three-tab" data-toggle="tab" href="#three" role="tab" aria-controls="Three" aria-selected="false">Kategori Kurir</a>
            </li>
          </ul>
        </div>

        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">

            <div class="row">
              <div class="col-sm-3">
                <!------FORM---------->
                <h4 class="btn btn-primary"><i class="fas fa-project-diagram"></i> Buat Kategori</h4>
                <hr />
                <div class="panel-body panel-warning">
                  <form action="master_data/simpan_kategori.php" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Kode</div>
                        </div>
                        <input name="kd_kategori" type="text" id="kd_kategori" placeholder="Kode" class="form-control" />
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Nama</div>
                        </div>
                        <input type="text" name="nm_kategori" id="nm_kategori" placeholder="Kategori" class="form-control" />
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" id="gambar" name="gambar">
                        <label class="custom-file-label" for="gambar">Pilih file</label>
                      </div>
                    </div>
                    <input type="submit" name="button_tambah" id="button_tambah" value="Tambah" class="btn btn-primary" />
                  </form>
                </div>
              </div>
              <!------FORM---------->
              <div class="col-sm-6">
                <!------TABEL---------->
                <h4 class="btn btn-default"><i class="fa fa-table"></i> DATA KATEGORI</h4>
                <hr />
                <div class="panel-body panel-default">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <th>Kode</th>
                      <th>Ikon</th>
                      <th>Kategori</th>
                      <th>Edit</th>
                      </tr>
                      <?php
                      if ($tampil_data == true) {


                        while ($kategori = mysqli_fetch_array($kategori_paging)) {
                          $kd_kategori = $kategori['kd_kategori'];
                          $nm_kategori = $kategori['nm_kategori'];
                          $gbr_kategori = empty($kategori['ikon_kategori']) ? '' : $kategori['ikon_kategori'];
                      ?>
                          <tr>
                            <td><?php echo $kd_kategori; ?>&nbsp;</td>
                            <td class="text-center"><img class="img-circle" src="master_data/img/<?php echo $gbr_kategori; ?>" width="100" /></td>
                            <td><?php echo $nm_kategori; ?>&nbsp;</td>
                            <td class="text-center">
                              <!--a href="<?php echo $_SERVER['PHP_SELF']; ?>?menu=kategori&kd_kategori=<?php echo $kd_kategori; ?>&do=update" class="btn btn-primary btn-xs"><i class="far fa-edit"></i></a-->
                              <a href="<?php echo $_SERVER['PHP_SELF']; ?>?menu=kategori&kd_kategori=<?php echo $kd_kategori; ?>&do=update" class="btn btn-primary btn-xs"><i class="far fa-edit"></i></a>
                              <a href="master_data/delete_kategori.php?kd_kategori=<?php echo $kd_kategori; ?>" class="btn btn-primary btn-xs"><i class="fas fa-eraser"></i></a></td>
                          </tr>
                      <?php }
                      } ?>
                      <tr>
                        <td colspan="3">
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
                <h4 class="btn btn-primary"><i class="far fa-edit"></i> Edit Kategori</h4>
                <hr />
                <div class="panel-body panel-warning">
                  <form action="master_data/update_kategori.php" method="post" enctype="multipart/form-data">
                    <input name="kd_update" type="hidden" value="<?php echo $kd_kat_update; ?>" class="form-control" />
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fas fa-project-diagram"></i></div>
                        </div>
                        <input name="nm_update" type="text" value="<?php echo (empty($nm_kat_update) ? '' : $nm_kat_update); ?>" class="form-control" />
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" id="gambare" name="gambare">
                        <label class="custom-file-label" for="gambare">Ganti file</label>
                      </div>
                    </div>
                    <!--input type="submit" name="button_update" value="Update" class="btn btn-primary" /-->
                    <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
                  </form>
                </div>
              </div>
              <!------FORM---------->
            </div>
          </div>
          <div class="tab-pane fade p-3" id="two" role="tabpanel" aria-labelledby="two-tab">
            <div class="row">
              <div class="col-md-12">

                <!------FORM---------->
                <div class="row">
                  <div class="col-md-4">
                    <h4 class="btn btn-primary"><i class="fas fa-project-diagram"></i> Buat Tagihan</h4>
                    <hr />
                    <div class="panel-body panel-warning">
                      <form action="master_data/simpan_kategori_baru.php" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Nama</div>
                            </div>
                            <input type="text" name="nm_kategori_baru" id="nm_kategori" placeholder="Kategori Tagihan" class="form-control" />
                          </div>
                        </div>

                        <input type="submit" name="button_tambah_kategori_baru" id="button_tambah" value="Tambah" class="btn btn-primary" />
                      </form>
                    </div>
                  </div>

                  <div class="col-md-8">
                    <!------TABEL---------->
                    <h4 class="btn btn-default"><i class="fa fa-table"></i> DATA KATEGORI</h4>
                    <hr />
                    <div class="panel-body panel-default">
                      <div class="table-responsive">
                        <table class="table table-bordered">
                          <th>Kode</th>
                          <th>Nama Kategori</th>
                          <th>Aksi</th>
                          </tr>
                          <?php
                          if ($tampil_data == true) {
                            $query = "SELECT * FROM `tabel_kategori_baru`";
                            $executeQuery = mysqli_query($koneksi, $query);
                            while ($kategori = mysqli_fetch_array($executeQuery)) {
                              $kd_kategori = $kategori['id_kategori_baru'];
                              $nm_kategori = $kategori['nama_kategori_baru'];
                          ?>
                              <tr>
                                <td><?php echo $kd_kategori; ?>&nbsp;</td>
                                <td><?php echo $nm_kategori; ?>&nbsp;</td>
                                <td class="text-center">
                                  <a href="master_data/simpan_kategori_baru.php?kd_kategori=<?php echo $kd_kategori; ?>" class="btn btn-danger btn-xs"><i class="fas fa-eraser"></i></a></td>
                              </tr>
                          <?php }
                          } ?>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>


                <hr />

                <!--FORM JENIS TAGIHAN-->
                <div class="row">
                  <div class="col-md-4">
                    <h4 class="btn btn-success my-1"><i class="fas fa-project-diagram"></i> Buat Jenis Tagihan</h4>
                    <hr />
                    <div class="panel-body panel-warning">
                      <form action="master_data/simpan_kategori_baru.php" method="post">

                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Nama</div>
                            </div>
                            <input type="text" name="nm_jenis_baru" id="nm_kategori" placeholder="Jenis" class="form-control" />
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Jenis</div>
                            </div>
                            <select name="kat_jenis_baru" class="form-control">
                              <?php
                              $ambil_kat_update = mysqli_query($koneksi, "Select * FROm tabel_kategori_baru");
                              while ($kat_update = mysqli_fetch_array($ambil_kat_update)) {
                                $kd_kat_update = $kat_update['id_kategori_baru'];
                                $nm_kat_update = $kat_update['nama_kategori_baru'];
                                echo "<option value=" . $kd_kat_update . ">" . $nm_kat_update . "</option>";
                              }
                              ?>
                            </select>
                          </div>
                        </div>

                        <input type="submit" name="button_tambah_jenis_baru" id="button_tambah" value="Tambah" class="btn btn-success" />

                      </form>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <!------TABEL---------->
                    <h4 class="btn btn-default"><i class="fa fa-table"></i> DATA JENIS TAGIHAN</h4>
                    <hr />
                    <div class="panel-body panel-default">
                      <div class="table-responsive">
                        <table class="table table-bordered">
                          <th>Kode</th>
                          <th>Nama Kategori</th>
                          <th>Nama Jenis</th>
                          <th>Aksi</th>
                          </tr>
                          <?php
                          if ($tampil_data == true) {
                            $query = "SELECT * FROM `tabel_jenis_baru`,tabel_kategori_baru WHERE tabel_jenis_baru.id_kategori_baru = tabel_kategori_baru.id_kategori_baru";
                            $executeQuery = mysqli_query($koneksi, $query);
                            while ($kategori = mysqli_fetch_array($executeQuery)) {
                              $kd_kategori = $kategori['id_jenis_baru'];
                              $nm_kategori = $kategori['nama_kategori_baru'];
                              $nm_jenis_baru = $kategori['nama_jenis_baru'];
                          ?>
                              <tr>
                                <td><?php echo $kd_kategori; ?>&nbsp;</td>
                                <td><?php echo $nm_kategori; ?>&nbsp;</td>
                                <td><?php echo $nm_jenis_baru; ?>&nbsp;</td>
                                <td class="text-center">
                                  <a href="master_data/simpan_kategori_baru.php?id_jenis=<?php echo $kd_kategori; ?>" class="btn btn-danger btn-xs"><i class="fas fa-eraser"></i></a></td>
                              </tr>
                          <?php }
                          } ?>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                <hr />
                <div class="row">
                  <div class="col-md-4">
                    <h4 class="btn btn-warning my-1"><i class="fas fa-project-diagram"></i> Buat Nominal Tagihan</h4>
                    <hr />
                    <div class="panel-body panel-warning">
                      <form action="master_data/simpan_kategori_baru.php" method="post">
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Kode Barang</div>
                            </div>
                            <input type="text" name="kode" id="kd_barang" placeholder="Kode Barang" class="form-control" />
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Nama dan Nominal</div>
                            </div>
                            <input type="text" name="nominal" id="nm_brg" placeholder="Pulsa 10000" class="form-control" />
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Harga Beli</div>
                            </div>
                            <input type="text" name="beli" id="hrg_beli" placeholder="Harga Beli" class="form-control" />
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Harga Jual</div>
                            </div>
                            <input type="text" name="jual" id="hrg_jual" placeholder="Harga Jual" class="form-control" />
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Jenis Tagihan</div>
                            </div>
                            <select name="satuan" class="form-control">
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

                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                          </div>
                        </div>

                        <input type="submit" name="button_tambah_data" id="button_tambah_data" value="Tambah" class="btn btn-warning" />

                      </form>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <!------TABEL---------->
                    <h4 class="btn btn-default"><i class="fa fa-table"></i> DATA JENIS NOMINAL</h4>
                    <hr />
                    <div class="panel-body panel-default">
                      <div class="table-responsive">
                        <table class="table table-bordered">
                          <th>Kode</th>
                          <th>Nominal</th>
                          <th>Aksi</th>
                          </tr>
                          <?php
                          if ($tampil_data == true) {
                            $query = "SELECT * FROM tabel_barang where nm_barang like '%pulsa%' or nm_barang like '%pln%' ";
                            $executeQuery = mysqli_query($koneksi, $query);
                            while ($kategori = mysqli_fetch_array($executeQuery)) {
                              $kd_kategori = $kategori['kd_barang'];
                              $nm_kategori = $kategori['nm_barang'];
                          ?>
                              <tr>
                                <td><?php echo $kd_kategori; ?>&nbsp;</td>
                                <td><?php echo $nm_kategori; ?>&nbsp;</td>
                                <td class="text-center">
                                  <a href="master_data/simpan_kategori_baru.php?kd_jenis_nominal=<?php echo $kd_kategori; ?>" class="btn btn-danger btn-xs"><i class="fas fa-eraser"></i></a></td>
                              </tr>
                          <?php }
                          } ?>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>


              </div>
              <!------FORM---------->


              <!------TABEL---------->


            </div>
          </div>
          <div class="tab-pane fade show active p-3" id="three" role="tabpanel" aria-labelledby="three-tab">
            <div class="row">
              <div class="col-sm-3">
                <!------FORM---------->
                <h4 class="btn btn-primary"><i class="fas fa-project-diagram"></i> Buat Kurir</h4>
                <hr />
                <div class="panel-body panel-warning">
                  <form action="master_data/simpan_kurir.php" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="kd_toko" value="<?php echo $_SESSION['kd_toko'] ?>" />

                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Kode</div>
                        </div>
                        <input name="kd_kurir" type="text" id="kd_kurir" placeholder="Kode" class="form-control" />
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Titik Awal</div>
                        </div>
                        <input type="text" name="nm_titikawal" id="nm_titikawal" placeholder="Titik Awal" class="form-control" />
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Titik Akhir</div>
                        </div>
                        <input type="text" name="nm_titikakhir" id="nm_titikakhir" placeholder="Titik Akhir" class="form-control" />
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Harga</div>
                        </div>
                        <input type="text" name="nm_harga" id="nm_harga" placeholder="Harga" class="form-control" />
                      </div>
                    </div>
                    <hr>
                    <h4 class="btn btn-default"><i class="fa fa-table"></i> DATA STOK KURIR</h4><br/>

                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Nama Kurir</div>
                        </div>
                        <input type="text" name="nm_kurir" id="nm_kurir" placeholder="Nama Kurir" class="form-control" />
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Satuan</div>
                        </div>
                        <select name="nm_satuan" class="form-control">
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
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Spesifikasi</div>
                        </div>
                        <input type="text" name="nm_spesifikasi" id="nm_spesifikasi" placeholder="Tulis Deskripsi Kurir" class="form-control" />
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Stok Awal</div>
                        </div>
                        <input type="text" name="nm_stok" id="nm_stok" placeholder="Jumlah Stok" class="form-control" />
                      </div>
                    </div>

                    <input type="submit" name="button_tambah" id="button_tambah" value="Tambah" class="btn btn-primary" />
                  </form>
                </div>
              </div>
              <!------FORM---------->
              <div class="col-sm-6">
                <!------TABEL---------->
                <h4 class="btn btn-default"><i class="fa fa-table"></i> DATA KURIR</h4>
                <hr />
                <div class="panel-body panel-default">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <th>Kode</th>
                      <th>Titik Awal</th>
                      <th>Titik Akhir</th>
                      <th>Harga</th>
                      <th>Edit</th>
                      </tr>
                      <?php
                          if ($tampil_data == true) {
                            $query_cek_kurir = "SELECT * FROM tabel_kurir";
                            $cek_kurir = mysqli_query($koneksi, $query_cek_kurir);
                            $hitung_record = mysqli_num_rows($cek_kurir);
                            include('paging.php');
                            $query = "SELECT * FROM `tabel_kurir` LIMIT " . $start_record . ", " . $max_data . "";
                            $executeQuery = mysqli_query($koneksi, $query);
                            while ($kurir = mysqli_fetch_array($executeQuery)) {
                              $kd_kurir = $kurir['id_kurir'];
                              $nm_titikawal = $kurir['titik_awal'];
                              $nm_titikakhir = $kurir['titik_akhir'];
                              $nm_harga = $kurir['harga'];
                          ?>
                          <tr>
                            <td><?php echo $kd_kurir; ?>&nbsp;</td>
                            <td><?php echo $nm_titikawal; ?>&nbsp;</td>
                            <td><?php echo $nm_titikakhir; ?>&nbsp;</td>
                            <td><?php echo $nm_harga; ?>&nbsp;</td>
                            <td class="text-center">
                              <!--a href="<?php echo $_SERVER['PHP_SELF']; ?>?menu=kategori&kd_kategori=<?php echo $kd_kurir; ?>&do=update" class="btn btn-primary btn-xs"><i class="far fa-edit"></i></a-->
                              <a href="<?php echo $_SERVER['PHP_SELF']; ?>?menu=kategori&kd_kurir=<?php echo $kd_kurir; ?>&do=update" class="btn btn-primary btn-xs"><i class="far fa-edit"></i></a>
                              <a href="master_data/delete_kurir.php?kd_kurir=<?php echo $kd_kurir; ?>" class="btn btn-primary btn-xs"><i class="fas fa-eraser"></i></a></td>
                          </tr>
                      <?php }
                      } ?>
                      <tr>
                        <td colspan="3">
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
                <h4 class="btn btn-primary"><i class="far fa-edit"></i> Edit Kurir</h4>
                <hr />
                <div class="panel-body panel-warning">
                  <form action="master_data/update_kurir.php" method="post" enctype="multipart/form-data">
                    <input name="kd_update" type="hidden" value="<?php echo $kd_kur_update; ?>" class="form-control" />
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fas fa-map-marked-alt"></i></div>
                        </div>
                        <input name="nm_titikawal_update" type="text" value="<?php echo (empty($nm_titikawal_update) ? '' : $nm_titikawal_update); ?>" class="form-control" />
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fas fa-map-marked-alt"></i></div>
                        </div>
                        <input name="nm_titikakhir_update" type="text" value="<?php echo (empty($nm_titikakhir_update) ? '' : $nm_titikakhir_update); ?>" class="form-control" />
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fas fa-money-bill"></i></div>
                        </div>
                        <input name="nm_harga_update" type="text" value="<?php echo (empty($nm_harga_update) ? '' : $nm_harga_update); ?>" class="form-control" />
                      </div>
                    </div>

                    <!-- <div class="form-group">
                      <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" id="gambare" name="gambare">
                        <label class="custom-file-label" for="gambare">Ganti file</label>
                      </div> -->
                    </div>
                    <!--input type="submit" name="button_update" value="Update" class="btn btn-primary" /-->
                    <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
                  </form>
                </div>
              </div>
              <!------FORM---------->
            </div>
          
          </div>

        </div>
      </div>
    </div>
  </div>
</div>


<script>
  // Add the following code if you want the name of the file appear on select
  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
</script>