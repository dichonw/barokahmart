<?php
error_reporting(error_reporting() & ~E_NOTICE);

$kd_toko = $_SESSION['kd_toko'];
$date = date('ymd');
$query = mysqli_query($koneksi, "SELECT MAX(no_faktur_penjualan) as maxid FROM tabel_penjualan WHERE no_faktur_penjualan LIKE '" . $kd_toko . "%'");
$result = mysqli_fetch_array($query);

// if (empty($result['maxid'])) {
// } else {
//   $maxid = $result['maxid'];
//   $no_urut = substr($maxid, -5);
// }

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
  $jml  = $hitung_total['jumlah'];
  //$sub_total=$hitung_total['sub_total_jual'];
  //$total_jual=$sub_total+$total_jual;
  //$ppn=$total_jual*10/100;
  //$total_bayar=$total_jual+$ppn;
  //$total_item=$jml+$total_item;
}
?>


<script language="javascript">
  function onEnter(e) {
    var key = e.keyCode || e.which;
    var kd_barang = document.getElementById('kd_barang').value;
    var no_faktur = document.getElementById('no_faktur').value;
    //var jumlah=document.getElementById('jumlah').value;
    if (key == 13) {
      //document.location.href="proses_kode_barang.php?kd_barang="+kd_barang+"&no_faktur="+no_faktur;} }
      document.location.href = "kasir/proses_kode_barang.php?kd_barang=" + kd_barang + "&no_faktur=" + no_faktur;
    }
  }
</script>
<script>
  function proses() {
    var kd_barang = document.getElementById('kd_barang2').value;
    var no_faktur = document.getElementById('no_faktur').value;
    document.location.href = "kasir/proses_kode_barang.php?kd_barang=" + kd_barang + "&no_faktur=" + no_faktur;
  }
</script>

<script>
  function prosesPulsa() {
    var kd_barang = document.getElementById('kd_barang_baru').value;
    var no_faktur = document.getElementById('no_faktur').value;
    var no_hp = document.getElementById('no_hp').value;
    document.location.href = "kasir/proses_kode_barang.php?kd_barang=" + kd_barang + "&no_faktur=" + no_faktur + "&no_hp=" + no_hp;
  }
</script>

</head>

<body>

  <div class="panel-body panel-warning">

    <!------------///////////////////////TABEL TRANSAKSI///////////////////////////////--------------->
    <div class="row">
      <div class="col-lg-8">

        <a href="?menu=home" class="btn btn-primary"><i class="fa fa-calculator"></i> PENJUALAN TUNAI</a>
        <a href="?menu=grosir" class="btn btn-danger"><i class="fas fa-box-open"></i> GROSIR</a>
        <hr />
        <div class="col-lg-12">
          <div class="row">
            <div class="form-group col-lg-6">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                </div>
                <input type="text" name="kd_barang" id="kd_barang" onKeyPress="onEnter(event)" placeholder="Masukkan Barcode" class="form-control" autofocus />
              </div>
            </div>

            <div class="form-group col-lg-6">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-box-open"></i></div>
                </div>
                <select name="kd_barang2" id="kd_barang2" onChange="proses()" class="selectpicker form-control" data-live-search="true">
                  <option>Pilih Barang</option>
                  <?php $rinci_barang = mysqli_query($koneksi, "SELECT * FROM tabel_barang ORDER BY nm_barang ASC");
                  while ($data_barang = mysqli_fetch_array($rinci_barang)) {
                    $kd_barang    = $data_barang['kd_barang'];
                    $nm_barang    = $data_barang['nm_barang'];
                  ?>
                    <option value="<?php echo $kd_barang; ?>"><?php echo $nm_barang; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

          </div>
          <div class="col-lg-12 my-3">

            <div class="card card-signin flex-row">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <div class="card tab-card">
                      <div class="card-header tab-card-header" style="height: 70px;">
                        <h1>Tagihan</h1>
                      </div>

                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">
                          <div class="row">

                            <div class="col-xl-12">
                              <form method="get" action="kasir/proses_kode_barang.php">
                                <div class="row">
                                  <div class="col-sm-4">

                                    <select id="kategoriBaru" class="form-control" >

                                    </select>
                                  </div>

                                  <div class="col-sm-4">

                                    <select id="jenisBaru" class="form-control">

                                    </select>
                                  </div>

                                  <div class="col-sm-4">
                                    <select id="kd_barang_baru" class="form-control" name="kd_barang_baru">

                                    </select>
                                  </div>
                                </div>

                                <div class="row py3">

                                  <div class="col-sm-4" style="margin-bottom: 10px;margin-top: 2%;">
                                    <input name="no_hp" class="form-control" placeholder="Nomor" required>
                                  </div>

                                  <div class="col-sm-4" style="margin-bottom: 10px;margin-top: 2%;">
                                    <input name="alamat" class="form-control" placeholder="Alamat"required>
                                  </div>

                                  <div class="col-sm-4 " style="margin-bottom: 10px;margin-top: 2%;">
                                    <button type="submit" class="btn btn-success btn-block">Beli</button>
                                  </div>
                                </div>
                                <?php

                                echo '<input type="hidden" class="form-control" name="no_faktur" value="' . $no_faktur . '" />';
                                ?>

                              </form>
                              <script type="text/javascript">
                                $(document).ready(function() {
                                  // alert("test")
                                  $("#kategoriBaru").append('<option value="">Pilih Kategori Pembelian</option>');
                                  $("#jenisBaru").html('');
                                  $("#kd_barang_baru").html('');
                                  $("#jenisBaru").append('<option value="">Pilih</option>');
                                  $("#kd_barang_baru").append('<option value="">Pilih</option>');
                                  var url = '../../web/master/get_kategori_baru.php';
                                  $.ajax({
                                    url: url,
                                    type: 'GET',
                                    dataType: 'json',
                                    success: function(result) {
                                      console.log(result);
                                      for (var i = 0; i < result.length; i++) {
                                        $("#kategoriBaru").append('<option value="' + result[i].id_kategori_baru + '">' + result[i].nama_kategori_baru + '</option>')
                                      };
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                      console.log(jqXHR.responseText);
                                    }
                                  });
                                });
                                $("#kategoriBaru").change(function() {
                                  var id_kat = $("#kategoriBaru").val();
                                  var url = '../../web/master/get_jenis_baru.php?id_kategori=' + id_kat;
                                  $("#jenisBaru").html('');
                                  $("#kd_barang_baru").html('');
                                  $("#jenisBaru").append('<option value="">Pilih</option>');
                                  $("#kd_barang_baru").append('<option value="">Pilih</option>');
                                  $.ajax({
                                    url: url,
                                    type: 'GET',
                                    dataType: 'json',
                                    success: function(result) {
                                      console.log(result);
                                      for (var i = 0; i < result.length; i++)
                                        $("#jenisBaru").append('<option value="' + result[i].id_jenis_baru + '">' + result[i].nama_jenis_baru + '</option>');
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                      console.log(jqXHR.responseText);
                                    }
                                  });
                                });
                                $("#jenisBaru").change(function() {
                                  var id_jen = $("#jenisBaru").val();
                                  var url = '../../web/master/get_barang_baru.php?id_jenis=' + id_jen;
                                  $("#kd_barang_baru").html('');
                                  $("#kd_barang_baru").append('<option value="">Pilih</option>');
                                  $.ajax({
                                    url: url,
                                    type: 'GET',
                                    dataType: 'json',
                                    success: function(result) {
                                      console.log(result);
                                      for (var i = 0; i < result.length; i++)
                                        $("#kd_barang_baru").append('<option value="' + result[i].kd_barang + '">' + result[i].nm_barang + '</option>');
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                      console.log(jqXHR.responseText);
                                    }
                                  });
                                });
                              </script>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- </div> -->
            </div>
            <div class="card card-signin flex-row my-4">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <div class="card mt100 tab-card">
                    <div class="card-header tab-card-header" style="height: 70px;">
                      <h1>Kurir</h1>
                    </div>

                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">
                        <div class="row">

                          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb30">
                            <form method="get" action="kasir/proses_kode_barang_kurir.php">
                              <div class="row">
                                <div class="col-sm-4">

                                  <select id="titikAwal" class="form-control" name="titikAwal">

                                  </select>
                                </div>

                                <div class="col-sm-4">

                                  <select id="titikAkhir" class="form-control" name="titikAkhir">

                                  </select>
                                </div>

                                <div class="col-sm-4">
                                  <select id="harga" class="form-control" name="harga" readonly>

                                  </select>
                                </div>
                              </div>

                              <div class="row py3">

                                <div class="col-sm-6" style="margin-top: 2%;">
                                  <input name="alamat" class="form-control" placeholder="Alamat Awal"required>
                                </div>

                                <div class="col-sm-6" style="margin-bottom: 5px;margin-top: 2%;">
                                  <input name="alamat_akhir" class="form-control" placeholder="Alamat Akhir"required>
                                </div>

                                <div class="col-sm-8" style="margin-top: 1.5%; " >
                                  <input name="no_hp" class="form-control" placeholder="Nomor" required >
                                </div>

                                <div class="col-sm-4 " style="margin-bottom: 10px;margin-top: 2%;">
                                    <button type="submit" class="btn btn-success btn-block">Beli</button>
                                  </div>
                              </div>
                              <?php

                              echo '<input type="hidden" class="form-control" name="no_faktur" value="' . $no_faktur . '" />';
                              ?>

                            </form>
                            <script type="text/javascript">
                              $(document).ready(function() {
                                // alert("test")
                                $("#titikAwal").append('<option value="">Pilih Titik Awal</option>');
                                $("#titikAkhir").html('');
                                $("#harga").html('');
                                $("#titikAkhir").append('<option value="">Pilih Titik Akhir</option>');
                                $("#harga").append('<option value="">Harga</option>');
                                var url = '../../web/master/get_titik_awal.php';
                                $.ajax({
                                  url: url,
                                  type: 'GET',
                                  dataType: 'json',
                                  success: function(result) {
                                    console.log(result);
                                    for (var i = 0; i < result.length; i++) {
                                      $("#titikAwal").append('<option value="' + result[i].titik_awal + '">' + result[i].titik_awal + '</option>')
                                    };
                                  },
                                  error: function(jqXHR, textStatus, errorThrown) {
                                    console.log(jqXHR.responseText);
                                  }
                                });
                              });
                              $("#titikAwal").change(function() {
                                var titik_awal = $("#titikAwal").val();
                                var url = '../../web/master/get_titik_akhir.php?titik_awal=' + titik_awal;
                                $("#titikAkhir").html('');
                                $("#harga").html('');
                                $("#titikAkhir").append('<option value="">Pilih Titik Akhir</option>');
                                $("#harga").append('<option value="">Harga</option>');
                                $.ajax({
                                  url: url,
                                  type: 'GET',
                                  dataType: 'json',
                                  success: function(result) {
                                    console.log(result);
                                    for (var i = 0; i < result.length; i++)
                                      $("#titikAkhir").append('<option value="' + result[i].id_kurir + '">' + result[i].titik_akhir + '</option>');
                                  },
                                  error: function(jqXHR, textStatus, errorThrown) {
                                    console.log(jqXHR.responseText);
                                  }
                                });
                              });
                              $("#titikAkhir").change(function() {
                                var kd_barang = $("#titikAkhir").val();
                                var url = '../../web/master/get_harga_kurir.php?id_kurir=' + kd_barang;
                                $("#harga").html('');
                                $.ajax({
                                  url: url,
                                  type: 'GET',
                                  dataType: 'json',
                                  success: function(result) {
                                    console.log(result);
                                    for (var i = 0; i < result.length; i++)
                                      $("#harga").append('<option value="' + result[i].id_kurir  + '">' + "Rp." + result[i].harga + '</option>');
                                  },
                                  error: function(jqXHR, textStatus, errorThrown) {
                                    console.log(jqXHR.responseText);
                                  }
                                });
                              });
                            </script>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- </div> -->
          </div>
          </div>
        </div>


        <div class="table-responsive">
          <table class="table table-bordered table-primary">
            <thead>
              <tr>
                <td>Kode</td>
                <td>Barang</td>
                <td>Harga</td>
                <td>Jumlah</td>
                <td>Sub Total</td>
                <td>Hapus</td>
              </tr>
            </thead>

            <tbody>
              <?php
              $rinci_jual = mysqli_query($koneksi, $query_rinci_jual);
              while ($data_rinci = mysqli_fetch_array($rinci_jual)) {
                $kd_barang    = $data_rinci['kd_barang'];
                $nm_barang    = $data_rinci['nm_barang'];
                $jml      = $data_rinci['jumlah'];
                $hrg      = $data_rinci['harga'];
                $discount    = (empty($data_rinci['diskon']) ? '0' : $data_rinci['diskon']);
                $sub_total    = $jml * $hrg;
                //$sub_total=$data_rinci['sub_total_jual'];  
                $total_jual  = $sub_total + $total_jual;
                $ppn    = $total_jual * 0 / 100;
                $diskon    = ($total_jual * $discount) / 100;
                $total_bayar = $total_jual - $diskon;
                $total_uang  = $total_bayar + $ppn;
                $total_item  = $jml + $total_item;
              ?>
                <tr>
                  <td><?php echo $kd_barang; ?></td>
                  <td><?php echo $nm_barang; ?>
                  </td>
                  <form method="post" action="?menu=jumlah">
                    <input type="hidden" name="no_faktur" class="form-control" value="<?php echo $no_faktur; ?>">
                    <input type="hidden" name="kd_brg" class="form-control" value="<?php echo $kd_barang; ?>">
                    <td>
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                          </div>
                          <?php $b = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_barang WHERE tabel_barang.kd_barang = '$kd_barang'")); ?>
                          <input name="hrg" class="form-control bg-transparent text-dark" value="<?php echo $b['hrg_jual']; ?>">
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                          </div>
                          <?php $b = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_barang WHERE tabel_barang.kd_barang = '$kd_barang'")); ?>

                          <?php
                          if (empty($data_rinci['no_hp'])) {
                          ?>
                            <input type="number" min="1" name="jumlah" class="form-control qty" value="<?php echo $jml; ?>" class="effect-1" autofocus>
                          <?php
                          } elseif (empty($data_rinci['no_hp']) || empty($data_rinci['alamat'])) {
                          ?>
                            <input type="number"  name="no_hp" value="<?php echo $data_rinci['no_hp']; ?>" aria-label="Input group example" aria-describedby="btnGroupAddon" disabled>
                          <?php
                          } elseif (empty($data_rinci['no_hp']) || empty($data_rinci['alamat']) || empty($data_rinci['alamat_akhir'])) {
                            ?>
                              <input type="number"  name="no_hp" value="<?php echo $data_rinci['no_hp']; ?>" aria-label="Input group example" aria-describedby="btnGroupAddon" disabled><br>
                              <input type="text"  name="alamat" value="<?php echo $data_rinci['alamat']; ?>" aria-label="Input group example" aria-describedby="btnGroupAddon" disabled>
                            <?php
                            } else{
                            ?>
                              <input type="number"  name="no_hp" value="<?php echo $data_rinci['no_hp']; ?>" aria-label="Input group example" aria-describedby="btnGroupAddon" disabled><br>
                              <input type="text"  name="alamat" value="<?php echo $data_rinci['alamat']; ?>" aria-label="Input group example" aria-describedby="btnGroupAddon" disabled><br>
                              <input type="text"  name="alamat_akhir" value="<?php echo $data_rinci['alamat_akhir']; ?>" aria-label="Input group example" aria-describedby="btnGroupAddon" disabled>
                            <?php
                            }
                          ?>
                        </div>
                        <button type="submit" name="update" class="btn" style="background:none"></button>
                      </div>



                  </form>
                  </td>
                  <td><?php echo $sub_total; ?></td>
                  <td>
                    <a href="kasir/delete_penjualan.php?no_faktur_penjualan=<?php echo $no_faktur; ?>&kd_barang=<?php echo $kd_barang; ?>" class="btn btn-primary"><i class="fa fa-trash"></i></a>

                  </td>
                </tr>
              <?php } ?>

              <!--Spacer-->
              <tr class="spacing">
                <td colspan="4"></td>
              </tr>
              <tr>
                <td>Disc.</td>
                <td><?php echo (empty($discount) ? '0' : $discount); ?></td>
                <td>Total Barang</td>
                <td><?php echo $total_item; ?></td>
                <td>Total Harga</td>
                <td>Rp. <?php echo number_format($total_jual, 0, ".", "."); ?></td>
              </tr>
              <tr>
                <td>Total Bayar</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Rp. <?php echo number_format((empty($total_uang) ? '0' : $total_uang), 0, ".", "."); ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr>
              <td>TOTAL </td>
              <th>Rp. <?php echo number_format((empty($total_uang) ? '0' : $total_uang), 0, ".", "."); ?></th>
            </tr>
            <tr>
              <td>KEMBALI </td>
              <th>Rp. <?php if (isset($_POST['cash_jual'])) {
                        $cash_jual = (empty($_POST['cash_jual']) ? 0 : $_POST['cash_jual']);
                        $kembali = $cash_jual - (empty($total_uang) ? 0 : $total_uang);
                        echo number_format($kembali, 0, ".", ".");
                      } else {
                        echo "0";
                      } ?>
              </th>
            </tr>

          </table>
        </div>
        <form id="form_kalkulator" name="form_kalkulator" method="post" action="<?php $_SERVER['PHP_SELF'];  ?>">

          <div class="form-group">
            <label for="validate-text">Cash</label>
            <div class="input-group">
              <input name="cash_jual" type="number" min="0" id="cash_jual" class="form-control" placeholder="Masukkan Jumlah Uang" autofocus />
              <span class="input-group-append">
                <input type="submit" name="button" id="button" value="Hitung" class="btn btn-primary" /></span>
            </div>
          </div>

        </form>

        <h4 class="btn btn-primary"><i class="fa fa-calculator"></i> NOTA</h4>
        <form id="form_penjualan" name="form_penjualan" method="post" action="?menu=simpantr">
          <input name="no_faktur" type="text" id="no_faktur" value="<?php echo $no_faktur; ?>" readonly class="form-control" />

          <label>TOTAL BELANJA</label>
          <input name="total_belanja" type="text" id="total_belanja" value="<?php echo (empty($total_uang) ? '0' : $total_uang); ?>" readonly class="form-control" />
          <input name="cash_jualnya" type="hidden" id="cash_jualnya" value="<?php echo (isset($_REQUEST['cash_jual']) ? $_REQUEST['cash_jual'] : '0'); ?>" readonly class="form-control" />
          <br />
          <?php echo "<a href='#ngediskon_jual' data-toggle='modal' data-id=" . $no_faktur . " class='btn btn-primary'>DISKON</a>"; ?>
          <!--input type="submit" name="button2" id="button2" value="CETAK NOTA" onClick="popup()" class="btn btn-primary" /-->
          <input type="submit" name="button_selesai" id="button_selesai" value="SIMPAN" class="btn btn-primary" />

        </form>

      </div>
    </div>
  </div>

  <!------------///////////////////////TABEL TRANSAKSI///////////////////////////////--------------->




  <!--------------------================================MODAL DISKON=========================--------------->
  <div class="modal fade" id="ngediskon_jual" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Kasih Diskon</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="hasil-data"></div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <!--------------------================================MODAL DISKON=========================--------------->



  </div>

  <script>
    var selesai_btn = document.getElementById('button_selesai');
    selesai_btn.addEventListener('click', () => {
      let input_cash = document.getElementById('cash_jualnya');
      if (input_cash.value == 0 || input_cash.value == null) {

        selesai_btn.setAttribute('type', 'button');
        alert('Field \'Cash\' tidak boleh kosong. Silahkan masukkan nominal uang pembayaran');

      } else {
        selesai_btn.setAttribute('type', 'submit');
      }
      <?php ?>
    });
  </script>

  <script type="text/javascript">
    var mywin;

    function popup() {
      mywin = window.open("kasir/faktur_penjualan.php?no_faktur=<?php echo $no_faktur; ?>&cash_jual=<?php echo $cash_jual; ?>", "_blank", "toolbar=yes,location=yes,menubar=yes,copyhistory=yes,directories=no,status=no,resizable=no,width=500, height=400");
      mywin.moveTo(100, 100);
    }
  </script>