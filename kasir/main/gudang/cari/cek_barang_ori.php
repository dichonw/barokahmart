 <div class="container">
     <!--------SELECT DROPDOWN SELECTION------------------>
     <script type="text/javascript">
         $(document).ready(function() {
             $("#txtcari").keyup(function() {
                 var strcari = $("#txtcari").val(); //mendapatkan nilai dari textbox 
                 if (strcari != "") //jika value strcari tidak kosong-->
                 {
                     $("#hasil").html("<img src='ajax.gif'/>") // menampilkan animasi loading 
                     //request data ke cari.php lalu menampilkan ke <div id="hasil"></div>
                     $.ajax({
                         type: "post",
                         url: "cari/cari-barang.php",
                         data: "q=" + strcari,
                         success: function(data) {
                             $("#hasil").html(data);
                         }
                     });
                 }
             });
         });
     </script>
     <div class="col-sm-12">
         <!------------TABEL DISINI--------------->
         <div class="form-group">
             <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-search"></i></span>
                 <input class="form-control" placeholder="Nama Barang" type="text" name="textcari" id="txtcari" />
             </div>
         </div>
     </div>



     <div id="hasil" class="col-sm-12"></div>


     <!--------SELECT DROPDOWN SELECTION------------------>
     <div class="row col-md-12 col-md-offset-2 custyle table-responsive">
         <table class="table table-striped custab">
             <thead>

                 <tr>
                     <th>KODE TOKO</th>
                     <th>KODE</th>
                     <th>BARANG</th>
                     <th>SATUAN</th>
                     <th>KATEGORI</th>
                     <th>MEREK</th>
                     <th>JENIS</th>
                     <th>TIPE</th>
                     <th>MODEL</th>
                     <th>HARGA</th>
                     <th>STOK</th>
                 </tr>
             </thead>

             <!--?php
include('../inc/koneksi.php');
$a=mysql_query("SELECT tabel_barang.kd_barang,tabel_barang.nm_barang, tabel_barang.kd_satuan, tabel_barang.kd_kategori, tabel_barang.warna, tabel_barang.ukuran, tabel_barang.hrg_jual,tabel_stok_toko.kd_toko, tabel_stok_toko.kd_barang,tabel_stok_toko.stok FROM tabel_barang
JOIN tabel_stok_toko ON tabel_stok_toko.kd_barang = tabel_barang.kd_barang WHERE kd_toko='".$status_toko."'");
while($d=mysql_fetch_array($a)){
?-->
             <?php
                include('../inc/koneksi.php');
                $a = mysqli_query($koneksi, "SELECT 
					tabel_barang.kd_barang,
					tabel_barang.nm_barang,
					tabel_barang.kd_satuan,
					tabel_barang.kd_kategori,
					tabel_barang.merek,
					tabel_barang.jenis,
					tabel_barang.tipe,
					tabel_barang.model,
					tabel_barang.hrg_jual,
					tabel_stok_toko.kd_toko,
					tabel_stok_toko.kd_barang,
					tabel_stok_toko.stok 
					FROM tabel_barang JOIN tabel_stok_toko ON tabel_stok_toko.kd_barang = tabel_barang.kd_barang");
                while ($d = mysqli_fetch_array($a)) {
                ?>
                 <tr>
                     <td><?php echo $d['kd_toko'] ?></td>
                     <td><?php echo $d['kd_barang'] ?></td>
                     <td><?php echo $d['nm_barang'] ?></td>
                     <td><?php echo $d['kd_satuan'] ?></td>
                     <td><?php echo $d['kd_kategori'] ?></td>
                     <td><?php echo $d['merek'] ?></td>
                     <td><?php echo $d['jenis'] ?></td>
                     <td><?php echo $d['tipe'] ?></td>
                     <td><?php echo $d['model'] ?></td>
                     <td><?php echo $d['hrg_jual'] ?></td>
                     <td><?php echo $d['stok'] ?></td>
                 </tr><?php } ?>


         </table>
     </div>
 </div>