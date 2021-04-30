<?php
$kd_toko=$_SESSION['kd_toko'];
$date=date('ymd');
$query=mysqli_query($koneksi, "SELECT MAX(no_faktur_penjualan) as maxid FROM tabel_penjualan WHERE no_faktur_penjualan LIKE '".$kd_toko."%'");
$result=mysqli_fetch_array($query);
$maxid=$result['maxid'];
$no_urut=substr($maxid,-5);
$new_urut=$no_urut+1;
$no_faktur=$kd_toko.$date.sprintf("%05s",$new_urut);
?>
<?php
$query_rinci_jual="SELECT * FROM tabel_rinci_retur WHERE no_faktur_retur='".$no_faktur."'";
$get_hitung_rinci=mysqli_query($koneksi, $query_rinci_jual);
$hitung=mysqli_num_rows($get_hitung_rinci);
$total_jual=0; $total_item=0;
while($hitung_total=mysqli_fetch_array($get_hitung_rinci)){
$jml=$hitung_total['jumlah'];
//$sub_total=$hitung_total['sub_total_jual'];
//$total_jual=$sub_total+$total_jual;
//$ppn=$total_jual*10/100;
//$total_bayar=$total_jual+$ppn;
//$total_item=$jml+$total_item;
}
?>


<script language="javascript">
function createRequestObject() {
var ajax;
if (navigator.appName == 'Microsoft Internet Explorer') {
ajax= new ActiveXObject('Msxml2.XMLHTTP');} 
else {
ajax = new XMLHttpRequest();}
return ajax;}

var http = createRequestObject();
function sendRequest(kd_barang){
if(kd_barang==""){
alert("Anda belum memilih kode barang !");}
else{   
http.open('GET', 'retur/ajax_supplier.php?kd_barang=' + encodeURIComponent(kd_barang) , true);
http.onreadystatechange = handleResponse;
http.send(null);}}

function handleResponse(){
if(http.readyState == 4){
var string = http.responseText.split('&&&');
document.getElementById('nm_barang').value= string[0];                                           
document.getElementById('hrg_beli').value= string[1];
document.getElementById('jumlah').value="";
document.getElementById('sub_total').value="";
document.getElementById('jumlah').focus();}}

function kalkulator(){
var jml=document.getElementById('jumlah').value;
var hrg=document.getElementById('hrg_beli').value;
var hasil = hrg*jml;
document.getElementById('sub_total').value = hasil;}
</script>

<div class="row">
<div class="col-8"><!------TABEL---------->  
    <div class="table-responsive">	
    <table class="table table-bordered">
      <tr>
        <th>No</th>
        <th>Item</th>
        <th>Qty</th>
        <th>Harga</th>
        <th>Total Retur</th>
        <th>Edit</th>
      </tr>
    <?php
    $total_harga=0; $total_item=0; $no=0;
    $query_data_retur=mysqli_query($koneksi, "SELECT * FROM tabel_rinci_retur WHERE no_faktur_retur='".$no_faktur."'");
    while($hasil_data_retur=mysqli_fetch_array($query_data_retur)){
	$no++;	
    $no_faktur		=$hasil_data_retur['no_faktur_retur'];
    $kd_barang		=$hasil_data_retur['kd_barang'];
    $nm_barang		=$hasil_data_retur['nm_barang'];
    $jml			=$hasil_data_retur['jumlah'];
    $harga			=$hasil_data_retur['harga'];
	$sub_ttl		=$hasil_data_retur['sub_total_retur'];   
	$total_harga 	+= $sub_ttl; 
    ?>  
         <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $nm_barang; ?></td>  
        <td><?php echo $jml; ?></td>
        <td><?php echo $harga; ?></td> 
        <td><?php echo $sub_ttl; ?></td>
        <td><a href="?menu=hapus_sup&kd_barang=<?php echo $kd_barang ?>&no_faktur=<?php echo $no_faktur; ?>" class="btn btn-primary"><i class="fa fa-trash"></i></a></a></td>
      </tr>
    <?php } ?>
      <tr>    
        <th colspan="4">Total</th>
        <td><?php echo $total_harga; ?></td>
        <td></td>
      </tr>
    </table>
    </div>
  </div> 
<div class="col-4"><!------FORM---------->
    <h5 class="box-header"><i class="fa fa-backward"></i> Retur Ke Supplier</h5>
<?php		
	$sql = "SELECT * FROM tabel_kategori_barang ORDER BY nm_kategori ASC";
	$result = mysqli_query($koneksi, $sql);
	$sql_barang = "SELECT * FROM tabel_barang ORDER BY nm_barang ASC";
	$result_barang = mysqli_query($koneksi, $sql_barang);	
?>
	<form action="?menu=retur_sup" method="post" id="form_pembelian" >
<div class="form-group"> 
   <div class="input-group">
      <div class="input-group-prepend">
         <div class="input-group-text">KATEGORI</div>
      </div>
      <select id="combo_kategori_barang" class="form-control" data-live-search="true"> 
          <option value="Kategori">Kategori</option>   
          <?php while($a=mysqli_fetch_assoc($result)){ ?>
           <option value="<?php echo $a['kd_kategori'];?>"><?php echo $a['nm_kategori'];?></option>
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
           <?php while($b=mysqli_fetch_assoc($result_barang)){
             echo'<option class="dt '.$b['kd_kategori'].'" value="'.$b['kd_barang'].'">'.$b['nm_barang'].'</option>';} ?>
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
       <input name="jumlah" type="text" id="jumlah" class="form-control" placeholder="Jumlah" onkeyup="kalkulator()" />
   </div>
</div>

<div class="form-group"> 
   <div class="input-group">
      <div class="input-group-prepend">
         <div class="input-group-text">TOTAL</div>
      </div>
       <input name="sub_total" type="text" id="sub_total" class="form-control" />
   </div>
</div>
      
<input type="submit" name="button_add" id="button_add" value="Tambah Item" class="btn btn-primary" />
          <hr /><br />
         
<h5 class="box-header"><i class="fa fa-id-card"></i> Selesaikan Retur</h5>
<input name="no_faktur" type="hidden" id="no_faktur" value="<?php echo $no_faktur; ?>"/> 
<input name="id_user" type="hidden" id="id_user" value="<?php echo $_SESSION['id_user']; ?>" />  

<div class="form-group"> 
   <div class="input-group">
      <div class="input-group-prepend">
         <div class="input-group-text">SUPLIER</div>
      </div>
     <select name="kd_supplier" id="kd_supplier" class="form-control" >
<?php $query_supplier=mysqli_query($koneksi, "SELECT * FROM tabel_supplier WHERE atas_nama='supplier'");
            while($result_supplier=mysqli_fetch_array($query_supplier)){
            $kd_supplier	=$result_supplier['kd_supplier'];
			$nm_supplier	=$result_supplier['nm_supplier'];
            echo "<option value=".$kd_supplier.">".$nm_supplier."</option>";}
                  ?>
     </select>
   </div>
</div>	
<div class="form-group"> 
   <div class="input-group">
      <div class="input-group-prepend">
         <div class="input-group-text">Keterangan</div>
      </div>
     <textarea name="keterangan" class="form-control" placeholder="Tulis keterangan retur disini"></textarea>
   </div>
</div>

             
       <input type="submit" name="button_selesai" id="button_selesai" value="Simpan Data" class="btn btn-primary" />
     <hr /><br />
 </form>
   </div>
</div><!------FORM---------->
 
 
 <!-- js untuk jquery -->
	<!--script src="../script/js/jquery-1.11.2.min.js"></script-->
	<script type="text/javascript">
		$(document).ready(function(){
			var combo_barang = $("#combo_barang");
            
            temp = combo_barang.children(".dt").clone();
             $("#combo_kategori_barang").change(function(){
             	var value = $(this).val();              
                combo_barang.children(".dt").remove();
                if(value!==''){
                    temp.clone().filter("."+value).appendTo(combo_barang);
                } else {
                    temp.clone().appendTo(combo_barang);
                }
             });
		});
	</script>
    
 