<?php
$kd_toko = $_SESSION['kd_toko'];
$date = date('ymd');
$query = mysqli_query($koneksi, "SELECT MAX(no_faktur_penjualan) as maxid FROM tabel_penjualan WHERE no_faktur_penjualan LIKE '" . $kd_toko . "%'");
$result = mysqli_fetch_array($query);
$maxid = $result['maxid'];
$no_urut = substr($maxid, -5);
$new_urut = $no_urut + 1;
$no_faktur = $kd_toko . $date . sprintf("%05s", $new_urut);
?>
<?php
$query_rinci_jual = "SELECT * FROM tabel_rinci_penjualan WHERE no_faktur_penjualan='" . $no_faktur . "'";
$get_hitung_rinci = mysqli_query($koneksi, $query_rinci_jual);
$hitung = mysqli_num_rows($get_hitung_rinci);
$total_jual = 0;
$total_item = 0;
while ($hitung_total = mysqli_fetch_array($get_hitung_rinci)) {
  $jml = $hitung_total['jumlah'];
  //$sub_total=$hitung_total['sub_total_jual'];
  //$total_jual=$sub_total+$total_jual;
  //$ppn=$total_jual*10/100;
  //$total_bayar=$total_jual+$ppn;
  //$total_item=$jml+$total_item;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="../script/autocomplete/jquery-ui.min.css" rel="stylesheet" />
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
        document.getElementById('warna').value = string[1];
        document.getElementById('ukuran').value = string[2];
        document.getElementById('harga').value = string[3];
        document.getElementById('jumlah').value = "";
        document.getElementById('sub_total').value = "";
        //document.getElementById('harga').focus();
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
  <div class="panel-body panel-warning">
    <div class="col-sm-6">
      <!------TABEL---------->
      <h3 class="box-header"><i class="fa fa-shopping-cart"></i> Penjualan Kredit</h3>
      <div class="table-responsive">
        <table class="table table-bordered" style="font-size:11px">
          <tr>
            <th>No</th>
            <th>Item</th>
            <th>Spec.</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Sub Total</th>
            <th>Edit</th>
          </tr>
          <?php
          $total_harga = 0;
          $total_item = 0;
          $no = 0;
          $query_data_penjualan = mysqli_query($koneksi, "SELECT * FROM tabel_rinci_penjualan WHERE no_faktur_penjualan='" . $no_faktur . "'");
          while ($hasil_data_penjualan = mysqli_fetch_array($query_data_penjualan)) {
            $no++;
            $no_faktur  = $hasil_data_penjualan['no_faktur_penjualan'];
            $kd_barang  = $hasil_data_penjualan['kd_barang'];
            $nm_barang  = $hasil_data_penjualan['nm_barang'];
            $warna    = $hasil_data_penjualan['warna'];
            $ukuran    = $hasil_data_penjualan['ukuran'];
            $harga    = $hasil_data_penjualan['hrg_jual'];
            $jml    = $hasil_data_penjualan['jumlah'];
            $harga    = $hasil_data_penjualan['harga'];
            $sub_total  = $hasil_data_penjualan['sub_total_jual'];
            $total_harga = $sub_total + $total_harga;
            $total_item  = $jml + $total_item;
          ?>
            <?php
            if (isset($_POST['cash'])) {
              $cash = $_POST['cash'];
              $kembali = $total_harga - $cash;
              //echo $kembali;
            } else {
              //echo "0";
            }
            ?>

            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $nm_barang; ?></td>
              <td><?php echo $warna; ?> <?php echo $ukuran; ?></td>
              <td><?php echo $jml; ?></td>
              <td><?php echo $harga; ?></td>
              <td>Rp.<?php echo number_format($sub_total, 0, ".", "."); ?></td>
              <td><a href="hapus_penjualan.php?kd_barang=<?php echo $kd_barang ?>&no_faktur=<?php echo $no_faktur; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a></a></td>
            </tr>
          <?php } ?>
          <tr>
            <th colspan="6">Total</th>
            <td><?php echo $total_item; ?></td>
            <td></td>
            <td>Rp.<?php echo number_format($total_harga, 0, ".", "."); ?></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <th colspan="6">Bayar</th>
            <td></td>
            <td></td>
            <td>Rp.<?php echo number_format($cash, 0, ".", "."); ?></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <th colspan="6">Sisa Angsuran</th>
            <td></td>
            <td></td>
            <td>Rp.<?php echo number_format($kembali, 0, ".", "."); ?></td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </div>
    </div>
    <div class="col-sm-3">
      <!------FORM---------->
      <h5 class="box-header"><i class="fa fa-shopping-cart"></i> Penjualan Kredit (Member)</h5>
      <?php
      $sql = "SELECT * FROM tabel_kategori_barang ORDER BY nm_kategori ASC";
      $result = mysqli_query($koneksi, $sql);
      $sql_barang = "SELECT * FROM tabel_barang ORDER BY nm_barang ASC";
      $result_barang = mysqli_query($koneksi, $sql_barang);
      ?>
      <form action="penjualan_member-kredit.php" method="post" id="form_pembelian">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
            <select id="combo_kategori_barang" class="form-control">
              <option value="">PILIH KATEGORI </option>
              <?php while ($a = mysqli_fetch_assoc($result)) { ?>
                <option value="<?php echo $a['kd_kategori']; ?>"><?php echo $a['nm_kategori']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
            <select name="kd_barang" id="combo_barang" onchange="new sendRequest(this.value)" class="form-control">
              <option value="">PILIH BARANG </option>
              <?php
              while ($b = mysqli_fetch_assoc($result_barang)) {
                echo '<option class="dt ' . $b['kd_kategori'] . '" value="' . $b['kd_barang'] . '">' . $b['nm_barang'] . '&nbsp;' . $b['warna'] . '&nbsp;' . $b['ukuran'] . '</option>';
              }
              ?>

            </select>
          </div>
        </div>
        <input name="nm_barang" type="hidden" id="nm_barang" class="form-control" />

        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
            <input name="warna" type="text" id="warna" readonly="readonly" class="form-control" placeholder="Merk" />
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
            <input name="ukuran" type="text" id="ukuran" readonly="readonly" class="form-control" placeholder="Jenis" />
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
            <input name="harga" type="text" id="harga" class="form-control" placeholder="Harga" />
          </div>
        </div>


        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
            <input name="jumlah" type="text" id="jumlah" class="form-control" placeholder="Jumlah" />
          </div>
        </div>
        <input type="submit" name="button_add" id="button_add" value="Tambah Item" class="btn btn-default pull-right" />
        <hr /><br />

    </div>
    <!------FORM---------->
    <div class="col-sm-3">
      <!------FORM---------->
      <h5 class="box-header"><i class="fa fa-id-card"></i> Cari Data Member</h5>
      <input name="dp" type="hidden" value="<?php echo $cash; ?>" class="form-control">
      <input name="sisa" type="hidden" value="<?php echo $kembali; ?>" class="form-control">
      <input name="no_faktur" type="hidden" id="no_faktur" value="<?php echo $no_faktur; ?>" />
      <input name="id_user" type="hidden" id="id_user" value="<?php echo $_SESSION['id_user']; ?>" />


      <div class="form-group">
        <div class="input-group">
          <input type="text" id="cari_member" autocomplete="off" placeholder="Masukkan Nama Pelanggan" class="form-control">
          <span class="input-group-addon"><i class="fa fa-search"></i></span>
        </div>
      </div>
      <input name="kd_supplier" type="hidden" id="kd_supplier" class="form-control" />
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
          <input name="nm_supplier" type="text" id="nm_supplier" readonly="readonly" class="form-control" placeholder="Nama" />
        </div>
      </div>

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
          <input name="almt_supplier" type="text" id="almt_supplier" readonly="readonly" class="form-control" placeholder="Alamat" />
        </div>
      </div>

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
          <input name="almt" type="text" id="almt" readonly="readonly" class="form-control" placeholder="Alamat Detail" />
        </div>
      </div>

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
          <input name="tlp_supplier" type="text" id="tlp_supplier" readonly="readonly" class="form-control" placeholder="No.Tlp" />
        </div>
      </div>

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
          <input name="fax_supplier" type="text" id="fax_supplier" readonly="readonly" class="form-control" placeholder="No.KTP" />
        </div>
      </div>

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
          <input name="atas_nama" type="text" id="atas_nama" readonly="readonly" class="form-control" />
        </div>
      </div>
      <input name="keterangan" type="hidden" class="form-control" value="KREDIT" />


      <input type="submit" name="button_selesai" id="button_selesai" value="Simpan Data" class="btn btn-default pull-right" />
      <hr /><br />
      </form>
      <h5 class="box-header"><i class="fa fa-calculator"></i> Uang Muka/DP</h5>
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-money"></i></span>
          <input type="text" disabled class="form-control" value="Rp.<?php echo number_format($total_harga, 0, ".", "."); ?>" />
        </div>
      </div>

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-money"></i></span>
          <input type="text" disabled class="form-control" value="Rp.<?php echo number_format($kembali, 0, ".", "."); ?>" />
        </div>
      </div>

      <form id="form_kalkulator" name="form_kalkulator" method="post" action="<?php $_SERVER['PHP_SELF'];  ?>">

        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">DP</span>
            <input name="cash" type="text" id="cash" class="form-control" placeholder="Masukkan Jumlah Uang" autofocus />
          </div>
        </div>
        <input type="submit" name="button" id="button" value="Hitung" class="btn btn-default pull-right" />

      </form>
    </div>
  </div>
  <!------FORM---------->

  <script src="../script/autocomplete/jquery.js"></script>
  <script src="../script/autocomplete/jquery-ui.min.js"></script>
  <script>
    /* autocomplete */
    $('#cari_member').autocomplete({
      delay: 0,
      source: function(request, response) {

        $.ajax({
          url: 'carimember.php',
          dataType: "json",
          data: 'carimember=' + request.term,
          success: function(data) {

            response($.map(data, function(item) {
              return {
                label: item.nm_supplier,
                kd_supplier: item.kd_supplier,
                nm_supplier: item.nm_supplier,
                almt_supplier: item.almt_supplier,
                almt: item.almt,
                tlp_supplier: item.tlp_supplier,
                fax_supplier: item.fax_supplier,
                atas_nama: item.atas_nama

              }
            }));
          },
          error: function(e) {
            alert('Error: ' + request);
          }
        });
      },
      minLength: 1,
      select: function(event, ui) {
        /* ketika nama yang dicari diklik, maka ditampilkan di form */
        $('#nm_supplier').val(ui.item.label);
        $('#kd_supplier').val(ui.item.kd_supplier);
        $('#almt_supplier').val(ui.item.almt_supplier);
        $('#almt').val(ui.item.almt);
        $('#tlp_supplier').val(ui.item.tlp_supplier);
        $('#fax_supplier').val(ui.item.fax_supplier);
        $('#atas_nama').val(ui.item.atas_nama);
        $('#cari_member').val("");
        return false;
      },
      focus: function(event, ui) {
        return false;
      }

    });

    /* @end autocomplete */
  </script>
  <!-- js untuk jquery -->
  <script src="../script/js/jquery-1.11.2.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      var combo_barang = $("#combo_barang");

      temp = combo_barang.children(".dt").clone();
      $("#combo_kategori_barang").change(function() {
        var value = $(this).val();
        combo_barang.children(".dt").remove();
        if (value !== '') {
          temp.clone().filter("." + value).appendTo(combo_barang);
        } else {
          temp.clone().appendTo(combo_barang);
        }
      });
    });
  </script>
</body>

</html>