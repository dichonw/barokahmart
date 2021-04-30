<?php
if (isset($_POST['button'])) {
  $kategori_request = $_POST['kategori'];
  $stok_request = $_POST['stok'];
  $kd_toko = $_POST['kd_toko'];
  if ($stok_request == 0) {
    $query_stok_barang = "SELECT * FROM tabel_stok_toko,tabel_barang,tabel_toko WHERE tabel_stok_toko.kd_barang=tabel_barang.kd_barang AND tabel_barang.kd_kategori='" . $kategori_request . "' AND tabel_stok_toko.stok=0 AND tabel_stok_toko.kd_TOKO='" . $kd_toko . "' AND tabel_toko.kd_TOKO='" . $kd_toko . "'";
  } else if ($stok_request == 1) {
    $query_stok_barang = "SELECT * FROM tabel_stok_toko,tabel_barang,tabel_toko WHERE tabel_stok_toko.kd_barang=tabel_barang.kd_barang AND tabel_barang.kd_kategori='" . $kategori_request . "' AND tabel_stok_toko.stok<50 AND tabel_stok_toko.kd_TOKO='" . $kd_toko . "' AND tabel_toko.kd_TOKO='" . $kd_toko . "'";
  } else if ($stok_request == 2) {
    $query_stok_barang = "SELECT * FROM tabel_stok_toko,tabel_barang, tabel_toko WHERE tabel_stok_toko.kd_barang=tabel_barang.kd_barang AND tabel_barang.kd_kategori='" . $kategori_request . "' AND tabel_stok_toko.kd_TOKO='" . $kd_toko . "' AND tabel_toko.kd_TOKO='" . $kd_toko . "'";
  }
} else {
  $kd_toko = $_SESSION['kd_toko'];
  $query_stok_barang = "SELECT * FROM tabel_stok_toko,tabel_barang, tabel_toko WHERE tabel_stok_toko.kd_barang=tabel_barang.kd_barang AND tabel_stok_toko.kd_toko='" . $kd_toko . "' AND tabel_toko.kd_TOKO='" . $kd_toko . "'";
}

?>
<div class="clearfix"></div>
<div class="col-sm-3">
  <div class="panel-body panel-warning">
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="form_filter">
      <label>Kategori</label>
      <select name="kategori" id="kategori" class="form-control">
        <?php
        $query_barang = mysqli_query($koneksi, "SELECT * FROM tabel_barang");
        while ($barang = mysqli_fetch_array($query_barang)) {
          $kd_barang = $barang['kd_barang'];
          $nm_barang = $barang['nm_barang'];
          echo "<option value=" . $kd_barang . ">" . $nm_barang . "</option>";
        }
        ?>
      </select>
      <label>Stok</label>
      <select name="stok" id="stok" class="form-control">
        <option value="0">0</option>
        <option value="1">Dibawah 50</option>
        <option value="2">Semua</option>
      </select>

      <label>Kode Toko</label>
      <!--select name="kd_toko" id="kd_toko" class="form-control">
      <!?php
		if($_SESSION['status_toko']=="pusat"&&$_GET['view'] =="cabang"){
		$query_toko=mysql_query("SELECT * FROM tabel_toko WHERE status='cabang'");
		while($toko=mysql_fetch_array($query_toko)){
		$kd_toko=$toko['kd_toko'];}}
		else{
		$kd_toko=$_SESSION['kd_toko'];}
		echo "<option value=".$kd_toko.">".$kd_toko."</option>";	  
	  ?>
      <br /><br />
      </select-->


      <select name="kd_toko" id="kd_toko" class="form-control">
        <?php
        //$a=mysql_query("SELECT DISTINCT kd_toko FROM tabel_stok_toko, tabel_toko");	
        $a = mysqli_query($koneksi, "SELECT DISTINCT kd_toko FROM tabel_stok_toko, tabel_toko WHERE tabel_stok_toko.kd_toko = tabel_toko.kd_toko");
        while ($d = mysqli_fetch_array($a)) {
        ?>
          <option value="<?php echo $d['kd_toko'] ?>"><?php echo $d['nm_toko'] ?></option>
        <?php } ?>
      </select>


      <input type="submit" name="button" id="button" value="Submit" class="btn btn-danger" />
      <input type="submit" name="button2" id="button2" value="All" class="btn btn-success" /></td>

    </form>
  </div>
</div>

<div id="stok_barang" class="col-sm-9">
  <div class="panel-body panel-default">
    <div class="tabel-responsive">
      <table class="table table-bordered">
        <tr>
          <th>Kode Barang</th>
          <th>Kode Toko</th>
          <th>Toko</th>
          <th>Barang</th>
          <th>Merk</th>
          <th>Jenis</th>
          <th>Type</th>
          <th>Model</th>
          <th>Stok</th>
          <!--th>Harga Jual</th-->
        </tr>
        <?php
        $stok_barang = mysqli_query($koneksi, $query_stok_barang);
        while ($stok = mysqli_fetch_array($stok_barang)) {
          $kd_barang = $stok['kd_barang'];
          $nm_toko = $stok['nm_toko'];
          $nm_barang = $stok['nm_barang'];
          $merek = $stok['merek'];
          $jenis = $stok['jenis'];
          $tipe = $stok['tipe'];
          $model = $stok['model'];
          $jumlah = $stok['stok'];
          //$hrg_jual=$stok['hrg_jual'];  
        ?>
          <tr>
            <td><?php echo $kd_barang; ?></td>
            <td><?php echo $kd_toko; ?></td>
            <td><?php echo $nm_toko; ?></td>
            <td><?php echo $nm_barang; ?></td>
            <td><?php echo $merek; ?></td>
            <td><?php echo $jenis; ?></td>
            <td><?php echo $tipe; ?></td>
            <td><?php echo $model; ?></td>
            <td><?php echo $jumlah; ?></td>
            <!--td><?php echo $hrg_jual; ?></td-->
          </tr>
        <?php } ?>
      </table>
    </div>
  </div>
</div>