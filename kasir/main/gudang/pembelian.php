<?php
$kd_toko = $_SESSION['kd_toko'];
$date = date('my');
$query = mysqli_query($koneksi, "SELECT MAX(no_faktur_pembelian) as maxid FROM tabel_pembelian WHERE no_faktur_pembelian LIKE '" . $kd_toko . "%'");
$result = mysqli_fetch_array($query);
$maxid = $result['maxid'];
$no_urut = substr($maxid, -5);
$new_urut = $no_urut + 1;
$no_faktur = $kd_toko . $date . sprintf("%05s", $new_urut);
?>
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
         alert("Anda belum memilih kode barang!");
      } else {
         http.open('GET', 'gudang/ajax_beli.php?kd_barang=' + encodeURIComponent(kd_barang), true);
         http.onreadystatechange = handleResponse;
         http.send(null);
      }
   }

   function handleResponse() {
      if (http.readyState == 4) {
         var string = http.responseText.split('&&&');
         document.getElementById('nm_barang').value = string[0];
         document.getElementById('hrg_beli').value = string[1];
         document.getElementById('jumlah').value = "";
         document.getElementById('sub_total').value = "";
         document.getElementById('jumlah').focus();
      }
   }

   function kalkulator() {
      var jml = document.getElementById('jumlah').value;
      var hrg = document.getElementById('hrg_beli').value;
      var hasil = hrg * jml;
      document.getElementById('sub_total').value = hasil;
   }
</script>


<div class="row">

   <div class="col-4">
      <h5 class="box-header">Stok Barang</h5>
      <?php
      $sql = "SELECT * FROM tabel_kategori_barang ORDER BY nm_kategori ASC";
      $result = mysqli_query($koneksi, $sql);
      $sql_barang = "SELECT * FROM tabel_barang ORDER BY nm_barang ASC";
      $result_barang = mysqli_query($koneksi, $sql_barang);
      ?>
      <form action="?menu=simpan_beli" method="post" id="form_pembelian">
         <div class="form-group">
            <div class="input-group">
               <div class="input-group-prepend">
                  <div class="input-group-text">KATEGORI</div>
               </div>
               <select id="combo_kategori_barang" class="form-control" data-live-search="true">
                  <option value="Kategori">Kategori</option>
                  <?php while ($a = mysqli_fetch_assoc($result)) { ?>
                     <option value="<?php echo $a['kd_kategori']; ?>"><?php echo $a['nm_kategori']; ?></option>
                  <?php } ?>
               </select>
            </div>
         </div>

         <div class="form-group">
            <div class="input-group">
               <div class="input-group-prepend">
                  <div class="input-group-text">BARANG</div>
               </div>
               <select name="kd_barang" id="combo_barang" onchange="new sendRequest(this.value)" class="form-control" data-live-search="true">
                  <option value="">PILIH BARANG </option>
                  <?php while ($b = mysqli_fetch_assoc($result_barang)) {
                     echo '<option class="dt ' . $b['kd_kategori'] . '" value="' . $b['kd_barang'] . '">' . $b['nm_barang'] . '</option>';
                  } ?>
               </select>
            </div>
         </div>

         <div class="form-group">
            <div class="input-group">
               <div class="input-group-prepend">
                  <div class="input-group-text">NAMA</div>
               </div>
               <input type="text" id="nm_barang" class="form-control" name="nm_barang" readonly="readonly" placeholder="Nama Barang" />
            </div>
         </div>

         <div class="form-group">
            <div class="input-group">
               <div class="input-group-prepend">
                  <div class="input-group-text">HARGA</div>
               </div>
               <input type="text" id="hrg_beli" name="harga" class="form-control" placeholder="harga" />
            </div>
         </div>

         <div class="form-group">
            <div class="input-group">
               <div class="input-group-prepend">
                  <div class="input-group-text">JUMLAH</div>
               </div>
               <input name="jumlah" type="text" id="jumlah" onkeyup="kalkulator()" class="form-control" placeholder="Masukkan Jumlah" />
            </div>
         </div>

         <div class="form-group">
            <div class="input-group">
               <div class="input-group-prepend">
                  <div class="input-group-text">TOTAL JUMLAH</div>
               </div>
               <input name="sub_total" type="text" id="sub_total" readonly="readonly" class="form-control" />
            </div>
         </div>

         <input type="submit" name="button_add" id="button_add" value="Tambah Stok" class="btn btn-primary" />
         <hr />
         <h5 class="box-header">Selesaikan Pembelian</h5>
         <form action="simpan_pembelian.php" method="post" id="form_pembelian">

            <div class="form-group">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <div class="input-group-text">No.Faktur</div>
                  </div>
                  <input name="no_faktur" type="text" id="no_faktur" value="<?php echo $no_faktur; ?>" readonly="readonly" class="form-control" />
               </div>
            </div>

            <div class="form-group">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <div class="input-group-text">ID Operator</div>
                  </div>
                  <input name="id_user" type="text" id="id_user" value="<?php echo $_SESSION['id_user']; ?>" readonly="readonly" class="form-control" />
               </div>
            </div>

            <div class="form-group">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <div class="input-group-text">Suplier</div>
                  </div>
                  <select name="kd_supplier" size="1" id="kd_supplier" class="form-control" style="background:#fff">
                     <?php
                     $query_supplier = mysqli_query($koneksi, "SELECT * FROM tabel_supplier WHERE atas_nama='supplier'");
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
                  <div class="input-group-prepend">
                     <div class="input-group-text">Tgl.Pembelian</div>
                  </div>
                  <input name="tanggal" type="text" id="tanggal" value="<?php echo date('d-m-Y'); ?>" readonly="readonly" class="form-control" />
               </div>
            </div>

            <input type="submit" name="button_selesai" id="button_selesai" value="Selesai Beli" class="btn btn-primary" />

         </form>
   </div>

   <div class="col-8">
      <div class="table-responsive">
         <table class="table table-bordered">
            <tr>
               <th>Barang</th>
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
               $no_faktur      = $hasil_data_pembelian['no_faktur_pembelian'];
               $kd_barang      = $hasil_data_pembelian['kd_barang'];
               $nm_barang      = $hasil_data_pembelian['nm_barang'];
               $jml         = $hasil_data_pembelian['jumlah'];
               $harga         = $hasil_data_pembelian['harga'];
               $sub_total      = $hasil_data_pembelian['sub_total_beli'];
               $total_harga   = $sub_total + $total_harga;
               $total_item      = $jml + $total_item;
            ?>
               <tr>
                  <td><?php echo $nm_barang; ?></td>
                  <td>Rp.<?php echo number_format($harga, 0, ".", "."); ?></td>
                  <td><?php echo $jml; ?></td>
                  <td>Rp.<?php echo number_format($sub_total, 0, ".", "."); ?></td>
                  <td><a href="?menu=hapus_beli&kd_barang=<?php echo $kd_barang ?>&no_faktur=<?php echo $no_faktur; ?>" class="btn btn-primary"><i class="fa fa-trash"></i></a></a></td>
               </tr>
            <?php } ?>
            <tr>
               <th colspan="2">Total</th>
               <td><?php echo $total_item; ?> </td>
               <td colspan="2">Rp.<?php echo number_format($total_harga, 0, ".", "."); ?></td>
            </tr>
         </table>
      </div>
   </div>



</div>



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