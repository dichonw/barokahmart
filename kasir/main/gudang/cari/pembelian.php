<?php
$kd_toko = $_SESSION['kd_toko'];
$date = date('ymd');
$query = mysqli_query($koneksi, "SELECT MAX(no_faktur_pembelian) as maxid FROM tabel_pembelian WHERE no_faktur_pembelian LIKE '" . $kd_toko . "%'");
$result = mysqli_fetch_array($query);
$maxid = $result['maxid'];
$no_urut = substr($maxid, -5);
$new_urut = $no_urut + 1;
$no_faktur = $kd_toko . $date . sprintf("%05s", $new_urut);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="../script/css/boilerplate.css" rel="stylesheet" type="text/css">
  <link href="../script/css/style.css" rel="stylesheet" type="text/css">
  <link href="../script/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../script/css/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
  <link href="../script/css/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="../script/css/bootstrap/css/icon-font.min.css" rel="stylesheet" type="text/css">
  <link href="../script/css/bootstrap/css/jquery-ui.css" rel="stylesheet" type="text/css">
  <link href="../script/css/paketKBK.css" rel="stylesheet" type="text/css">

  <script src="../respond.min.js"></script>
  <script src="../script/js/jquery.min.js"></script>
  <script src="../script/js/bootstrap.min.js"></script>

  <script language="javascript">
    function createRequestObject() {
      var ajax;
      if (navigator.appName == 'Microsoft Internet Explorer') {
        ajax = new ActiveXObject('Msxml2.XMLHTTP');
      } else {
        ajax = new XMLHttpRequest();
      }
      return ajax;
    }

    var http = createRequestObject();

    function sendRequest(kd_barang) {
      if (kd_barang == "") {
        alert("Anda belum memilih kode barang !");
      } else {
        http.open('GET', 'ajax.php?kd_barang=' + encodeURIComponent(kd_barang), true);
        http.onreadystatechange = handleResponse;
        http.send(null);
      }
    }

    function handleResponse() {
      if (http.readyState == 4) {
        var string = http.responseText.split('&&&');
        document.getElementById('nm_barang').value = string[0];
        document.getElementById('satuan').value = string[1];
        document.getElementById('harga').value = string[2];
        document.getElementById('jumlah').value = "";
        document.getElementById('sub_total').value = "";
        document.getElementById('jumlah').focus();
      }
    }

    function kalkulator() {
      var jml = document.getElementById('jumlah').value;
      var hrg = document.getElementById('harga').value;
      var hasil = hrg * jml;
      document.getElementById('sub_total').value = hasil;
    }
  </script>
</head>

<body>
  <div class="col-sm-6">
    <!-----------TABEL------->
    <div class="table-responsive">
      <table class="table table-bordered">
        <tr>
          <th>Kode</th>
          <th>Item</th>
          <th>Satuan</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Sub Total</th>
          <th>Edit</th>
        </tr>
        <?php
        $total_harga = 0;
        $total_item = 0;
        $query_data_pembelian = mysqli_query($koneksi, "SELECT * FROM tabel_rinci_pembelian WHERE no_faktur_pembelian='" . $no_faktur . "'");
        while ($hasil_data_pembelian = mysqli_fetch_array($query_data_pembelian)) {
          $no_faktur = $hasil_data_pembelian['no_faktur_pembelian'];
          $kd_barang = $hasil_data_pembelian['kd_barang'];
          $nm_barang = $hasil_data_pembelian['nm_barang'];
          $satuan = $hasil_data_pembelian['satuan'];
          $jml = $hasil_data_pembelian['jumlah'];
          $harga = $hasil_data_pembelian['harga'];
          $sub_total = $hasil_data_pembelian['sub_total_beli'];
          $total_harga = $sub_total + $total_harga;
          $total_item = $jml + $total_item;
        ?>
          <tr>
            <td class="hidden-phone"><?php echo $kd_barang; ?></td>
            <td><?php echo $nm_barang; ?></td>
            <td><?php echo $satuan; ?></td>
            <td>Rp.<?php echo number_format($harga, 0, ".", "."); ?></td>
            <td><?php echo $jml; ?></td>
            <td>Rp.<?php echo number_format($sub_total, 0, ".", "."); ?></td>
            <td><a href="hapus_pembelian.php?kd_barang=<?php echo $kd_barang ?>&no_faktur=<?php echo $no_faktur; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a></a></td>
          </tr>
        <?php } ?>
        <tr>
          <th colspan="3">Total</th>
          <td><?php echo $total_item; ?>Items</td>
          <td>Rp.<?php echo $total_harga; ?></td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div>
  </div>
  <!-----------TABEL------->

  <div class="col-sm-3">
    <!-----------FORM------->
    <div class="panel-body panel-warning">
      <form action="simpan_pembelian.php" method="post" id="form_pembelian">

        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"> Barang</span>
            <select name="kd_barang" id="kd_barang" onchange="new sendRequest(this.value)" class="form-control">
              <option value="">PILIH BARANG </option>
              <?php
              $query_barang = mysqli_query($koneksi, "SELECT * FROM tabel_barang");
              while ($result_barang = mysqli_fetch_array($query_barang)) {
                $kd_barang = $result_barang['kd_barang'];
                $nm_barang = $result_barang['nm_barang'];
                echo "<option value=" . $kd_barang . ">" . $nm_barang . "</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <input name="nm_barang" type="hidden" id="nm_barang" readonly="readonly" class="form-control" />
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"> Satuan &nbsp;</span>
            <input name="satuan" type="text" id="satuan" readonly="readonly" class="form-control" />
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"> Harga &nbsp;&nbsp;&nbsp;</span>
            <input name="harga" type="text" id="harga" readonly="readonly" class="form-control" />
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"> Jumlah&nbsp;</span>
            <input name="jumlah" type="text" id="jumlah" onkeyup="kalkulator()" class="form-control" />
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"> Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <input name="sub_total" type="text" id="sub_total" readonly="readonly" class="form-control" />
          </div>
        </div>
        <input type="submit" name="button_add" id="button_add" value="Tambah Stok" class="btn btn-danger" />
    </div>
  </div>
  <!-----------FORM------->

  <div class="col-sm-3">
    <!-----------FORM------->
    <div class="panel-body panel-warning">

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"> Nota &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
          <input name="no_faktur" type="text" id="no_faktur" value="<?php echo $no_faktur; ?>" readonly="readonly" class="form-control" />
        </div>
      </div>

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"> ID Kasir &nbsp;&nbsp;&nbsp;</span>
          <input name="id_user" type="text" id="id_user" value="<?php echo $_SESSION['id_user']; ?>" readonly="readonly" class="form-control" />
        </div>
      </div>

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"> Supplier &nbsp;</span>
          <select name="kd_supplier" size="1" id="kd_supplier" class="form-control" style="background:#fff">
            <?php
            $query_supplier = mysqli_query($koneksi, "SELECT kd_supplier FROM tabel_supplier WHERE kategori='supplier'");
            while ($result_supplier = mysqli_fetch_array($query_supplier)) {
              $kd_supplier = $result_supplier['kd_supplier'];
              $nm_supplier = $result_supplier['nm_supplier'];
              echo "<option value=" . $kd_supplier . ">" . $nm_supplier . "</option>";
            }
            ?>
          </select>
        </div>
      </div>

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"> Tanggal &nbsp;</span>
          <input name="tanggal" type="text" id="tanggal" value="<?php echo date('d-m-Y'); ?>" readonly="readonly" class="form-control" />
        </div>
      </div>
      <input type="submit" name="button_selesai" id="button_selesai" value="Selesai Beli" class="btn btn-danger" />
      </form>
    </div>
  </div>
  <!-----------FORM------->


</body>

</html>