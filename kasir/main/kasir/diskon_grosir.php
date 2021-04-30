<!--?php include('../inc/koneksi.php');
if($_POST['idx']) {
$id 	= $_POST['idx'];      
$data 	= mysql_query("SELECT * FROM tabel_rinci_penjualan WHERE no_faktur_penjualan = '$id'");
$d 		= mysql_fetch_array($data);
}
$hrg			=$d['harga'];
$jml			=$d['jumlah'];
$sub_total		=$jml*$hrg;
$total_jual	+=$sub_total;
?-->
<?php
include('../inc/koneksi.php');
if ($_POST['idx']) {
     $id      = $_POST['idx'];
     $query_rinci_jual = "SELECT * FROM tabel_rinci_penjualan WHERE no_faktur_penjualan = '$id'";
     $get_hitung_rinci = mysqli_query($koneksi, $query_rinci_jual);
     $hitung = mysqli_num_rows($get_hitung_rinci);
     $total_jual = 0;
     $total_item = 0;
     while ($hitung_total = mysqli_fetch_array($get_hitung_rinci)) {
          $faktur = $hitung_total['no_faktur_penjualan'];
          $jml     = $hitung_total['jumlah'];
          //$sub_total=$hitung_total['sub_total_jual'];
          //$total_jual=$sub_total+$total_jual;
          //$ppn=$total_jual*10/100;
          //$total_bayar=$total_jual+$ppn;
          //$total_item=$jml+$total_item;
     }
}
?>

<?php
$rinci_jual = mysqli_query($koneksi, $query_rinci_jual);
while ($data_rinci = mysqli_fetch_array($rinci_jual)) {
     $kd_barang          = $data_rinci['kd_barang'];
     $nm_barang          = $data_rinci['nm_barang'];
     $jml               = $data_rinci['jumlah'];
     $hrg               = $data_rinci['harga'];
     $discount          = $data_rinci['diskon'];
     $sub_total          = $jml * $hrg;
     //$sub_total=$data_rinci['sub_total_jual'];  
     $total_jual = $sub_total + $total_jual;
     $ppn = $total_jual * 0 / 100;
     //$diskon=$total_jual-$discount;
     $total_bayar = $total_jual - $discount;
     $total_uang = $total_bayar + $ppn;
     $total_item = $jml + $total_item;
?>

<?php } ?>




<form action="kasir/update_diskon_grosir.php" method="post">

     <div class="form-group">
          <label>Total Belanja</label>
          <div class="input-group">
               <input type="text" name="no_faktur_penjualan" class="form-control" value="<?php echo $faktur; ?>" readonly>
          </div>
     </div>
     <div class="form-group">
          <div class="input-group">
               <input type="text" name="diskon" class="form-control" placeholder="Masukkan diskon tanpa %">
          </div>
     </div>
     <button type="submit" name="edit" class="btn btn-danger btn-lg">Ubah Data</button>
</form>