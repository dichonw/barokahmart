<?php
ini_set("display_errors", 0);
if (isset($_POST['selesai'])) {
  $no_nota    = $_POST['no_nota'];
  if (empty($no_nota)) {
  } else {
    $query = "UPDATE `tabel_penjualan` SET `sisa`='selesai' WHERE `no_faktur_penjualan`='$no_nota'";
    $hasil = mysqli_query($koneksi, $query);
    echo "<script language='JavaScript'>alert('Transaksi Selesai!');document.location='?menu=cek'</script>";
  }
}
?>
<?php
ini_set("display_errors", 0);
if (isset($_POST['yuk'])) {
  $no_faktur    = $_POST['no_faktur'];
  $ongkir      = $_POST['ongkir'];
  if (empty($no_faktur)) {
  } else {
    $query = "UPDATE `tabel_penjualan` SET `dp`='$ongkir' WHERE `no_faktur_penjualan`='$no_faktur'";
    $hasil = mysqli_query($koneksi, $query);
    echo "<script language='JavaScript'>document.location='?menu=cek'</script>";
  }
}
?>
<div class="row">
  <?php
  $query = "SELECT * FROM tabel_member,tabel_penjualan WHERE tabel_penjualan.sisa = 'wait' AND tabel_penjualan.id_user = tabel_member.id_user";
  $result = mysqli_query($koneksi, $query);
  while ($a = mysqli_fetch_array($result)) {
    $antrian   = $a['no_faktur_penjualan'];
    $ongkir   = $a['dp'];
    $total_jual  = $a['total_penjualan'];
    $total    = $ongkir + $total_jual;
  ?>
    <div class="card col-lg-4 col-12 m-1">
      <div class="card-body">

        <div class="row">
          <div class="col d-flex justify-content-between">

            <h5 class="card-title text-uppercase"><?php echo $a['nm_user']; ?></h5>
          </div>
          <h6 class="mb-2 text-dark"><?php echo $a['tgl_penjualan']; ?><br>
        </div>
        <h6 class="card-subtitle mb-2 text-dark"><?php echo $a['no_faktur_penjualan']; ?><br>
          <small><?php echo $a['ket']; ?></small>
          <hr>
          <div class="row">
            <small class="col-6"><span class="badge badge-primary">Alamat Pengiriman</span><br><?php echo $a['status']; ?></small><br>
            <small class="col-6"><span class="badge badge-primary">No.HP</span><br><?php echo $a['hp']; ?></small>
          </div>
        </h6>
        <form method="post" action="">
          <input type="hidden" name="no_faktur" value="<?php echo $a['no_faktur_penjualan']; ?>">
          <label>Ongkos Kirim</label>
          <div class="input-group mb-3">
            <input name="ongkir" class="form-control" placeholder="isikan angka saja" />
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="submit" name="yuk">OK</button>
            </div>
          </div>
        </form>
        <hr>
        <ul class="list-group">
          <?php $query_detail = "SELECT * FROM tabel_rinci_penjualan WHERE no_faktur_penjualan = '$antrian'";
          $result_detail = mysqli_query($koneksi, $query_detail);
          while ($b = mysqli_fetch_array($result_detail)) {
          ?>
            <li class="list-group-item"><i class="fas fa-caret-right"></i>
              <?php
              if (empty($b['no_hp'])) {
                echo $b['nm_barang']; ?> <?php echo "(" . $b['jumlah'] . ")";
              }elseif(empty($b['no_hp']) || empty($b['alamat'])){
                echo $b['nm_barang']; ?> <?php echo "(" . $b['jumlah'] . ")";?> <?php echo "(" . $b['no_hp'] . ")";
              }elseif(empty($b['no_hp']) || empty($b['alamat']) || empty($b['alamat_akhir'])){
                echo $b['nm_barang']; ?> <?php echo "(" . $b['jumlah'] . ")";?> <?php echo "(" . $b['no_hp'] . ")<br/>";?><?php echo "(" . $b['alamat'] . ")";
              } else {
                echo $b['nm_barang']; ?> <?php echo "(" . $b['jumlah'] . ")"; ?> <?php echo "(" . $b['no_hp'] . ")<br/>";?><?php echo "(" . $b['alamat'] . ")<br/>";?><?php echo "(" . $b['alamat_akhir'] . ")";
              }
                ?>
            </li>
          <?php } ?>
          <hr />
          <div class="row">
            <h6 class="col-6"><small class="badge badge-primary">Ongkir </small><br />
              Rp. <?php echo number_format($ongkir, 2, ',', '.'); ?></h6>
            <h6 class="col-6"><small class="badge badge-primary">Total</small><br />
              Rp. <?php echo number_format($total, 2, ',', '.'); ?></h6>
          </div>
        </ul>
        <hr>
        <div class="btn-group" role="group" aria-label="Basic example">
          <form method="post" action="">
            <input type="hidden" name="no_nota" value="<?php echo $a['no_faktur_penjualan']; ?>">
            <button type="submit" name="selesai" class="btn btn-primary"><i class="fas fa-clipboard-check"></i> Selesai</button>
          </form>
          <a href="kasir/kasir-nota.php?no_faktur=<?php echo $a['no_faktur_penjualan']; ?>" target="_blank" class="btn btn-danger"><i class="fas fa-receipt"></i> Nota</a>
        </div>
      </div>
    </div>

  <?php } ?>
</div>