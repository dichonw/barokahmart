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
$query_rinci_jual="SELECT * FROM tabel_rinci_penjualan WHERE no_faktur_penjualan='".$no_faktur."'";
$get_hitung_rinci=mysqli_query($koneksi, $query_rinci_jual);
$hitung=mysqli_num_rows($get_hitung_rinci);
$total_jual=0; $total_item=0;
while($hitung_total=mysqli_fetch_array($get_hitung_rinci)){
$jml	=$hitung_total['jumlah'];
//$sub_total=$hitung_total['sub_total_jual'];
//$total_jual=$sub_total+$total_jual;
//$ppn=$total_jual*10/100;
//$total_bayar=$total_jual+$ppn;
//$total_item=$jml+$total_item;
}
?>


<script language="javascript">
function onEnter(e){
var key=e.keyCode || e.which;
var kd_barang=document.getElementById('kd_barang').value;
var no_faktur=document.getElementById('no_faktur').value;
//var jumlah=document.getElementById('jumlah').value;
if(key==13){
//document.location.href="proses_kode_barang.php?kd_barang="+kd_barang+"&no_faktur="+no_faktur;} }
document.location.href="kasir/proses_kode_grosir.php?kd_barang="+kd_barang+"&no_faktur="+no_faktur;} }
</script>
<script>
function proses(){
    var kd_barang=document.getElementById('kd_barang2').value;
	var no_faktur=document.getElementById('no_faktur').value;
  	document.location.href="kasir/proses_kode_grosir.php?kd_barang="+kd_barang+"&no_faktur="+no_faktur;
}
</script>
</head>
<body>

<div class="panel-body"> 

<!------------///////////////////////TABEL TRANSAKSI///////////////////////////////--------------->
<div class="row">   
   <div class="col-lg-8">  
     
  	<a href="?menu=home" class="btn btn-primary"><i class="fa fa-calculator"></i> PENJUALAN TUNAI</a>
    <a href="?menu=grosir" class="btn btn-danger"><i class="fas fa-box-open"></i> GROSIR</a>
    <hr />
      <div class="row">   
      <div class="form-group col-lg-8"> 
        <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-barcode"></i></div>
            </div>
            <input type="text" name="kd_barang" id="kd_barang" onKeyPress="onEnter(event)" placeholder="Masukkan Barcode"  class="form-control" autofocus/>
          </div>
       </div>          
      
     <div class="form-group col-lg-4"> 
      <div class="input-group">
       <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-box-open"></i></div>
         </div>
         <select name="kd_barang2" id="kd_barang2" class="selectpicker form-control" onChange="proses()" data-live-search="true">
              <option>Pilih Barang</option>
<?php $rinci_barang=mysqli_query($koneksi, "SELECT * FROM tabel_barang ORDER BY nm_barang ASC "); while( $data_barang=mysqli_fetch_array($rinci_barang)){
$kd_barang		=$data_barang['kd_barang'];
$nm_barang		=$data_barang['nm_barang'];	
?>                    	
                        <option value="<?php echo $kd_barang; ?>"><?php echo $nm_barang; ?></option>
<?php } ?>                        
             </select>
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
$rinci_jual=mysqli_query($koneksi, $query_rinci_jual);
while( $data_rinci=mysqli_fetch_array($rinci_jual)){
$kd_barang		=$data_rinci['kd_barang'];
$nm_barang		=$data_rinci['nm_barang'];
$jml			=$data_rinci['jumlah'];
$hrg			=$data_rinci['harga'];
$discount		=$data_rinci['diskon'];
$sub_total		=$jml*$hrg;
//$sub_total=$data_rinci['sub_total_jual'];  
$total_jual=$sub_total+$total_jual;
$ppn=$total_jual*0/100;
$diskon		=($total_jual*$discount)/100;
$total_bayar=$total_jual-$diskon;
$total_uang=$total_bayar+$ppn;
$total_item=$jml+$total_item;
?>
            <tr>
                <td><?php echo $kd_barang; ?></td>
                <td><?php echo $nm_barang; ?>                
                </td>
                <form method="post" action="?menu=jml">
                <input type="hidden" name="no_faktur" class="form-control" value="<?php echo $no_faktur; ?>">
                <input type="hidden" name="kd_brg" class="form-control" value="<?php echo $kd_barang; ?>">
                <td>
				
                
                <div class="form-group">
				  <div class="input-group">                         
                        <?php $b=mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_barang WHERE tabel_barang.kd_barang = '$kd_barang'")); ?>
                        <input name="hrg" class="form-control bg-transparent text-dark" value="<?php echo $b['hrg_grosir']; ?>">
                        
						<span class="focus-border"></span>
                        </div>
					</div>
				</td>
                <td>                
                
				  <div class="input-group">				    
    					<input type="text" name="jumlah" value="<?php echo $jml; ?>" class="effect-1" autofocus>
                        <span class="focus-border"></span>
                          <span class="input-group-append">
                          <button type="submit" name="update" class="btn" style="background:none"></button>
                          </span>
						</div>
					
                </form></td>
                <td><?php echo $sub_total; ?></td>
                <td>
                <a href="kasir/delete_grosir.php?no_faktur_penjualan=<?php echo $no_faktur; ?>&kd_barang=<?php echo $kd_barang; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                 
                </td>
            </tr>
            <?php } ?>
            
            <!--Spacer-->
            <tr class="spacing">
                <td colspan="4"></td>
            </tr>           
            <tr>
                <td>Disc.</td>
                <td><?php echo $discount; ?></td>
                <td>Total Barang</td>
                <td><?php echo $total_item; ?></td>
                <td>Total Harga</td>
                <td>Rp.<?php echo number_format($total_jual,0,".","."); ?></td>
            </tr>
            <tr>
                <td>Total Bayar</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Rp.<?php echo number_format($total_uang,0,".","."); ?></td>
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
            <th>Rp.<?php echo number_format($total_uang,0,".","."); ?></th>
          </tr>
          <tr>
          	<td>KEMBALI </td>
            <th>Rp. <?php if(isset($_POST['cash_grosir'])){
					$cash_grosir=$_POST['cash_grosir'];
					$kembali=$cash_grosir-$total_uang;
					echo $kembali; }
					else{ echo "0"; } ?>
    		</th>
          </tr>
          
    	</table>
    </div>   
      <form id="form_kalkulator" name="form_kalkulator" method="post" action="<?php $_SERVER['PHP_SELF'];  ?>">
             
        <div class="form-group">
        	<label for="validate-text">Cash</label>
			<div class="input-group">
				<input name="cash_grosir" type="text" id="cash_grosir"  class="form-control" placeholder="Masukkan Jumlah Uang" autofocus />
				<span class="input-group-append">
                <input type="submit" name="button" id="button" value="Hitung"  class="btn btn-danger"/></span>
			</div>
		</div>
        
      </form> 
      
      <h4 class="btn btn-danger"><i class="fa fa-calculator"></i> NOTA</h4>
      <form id="form_penjualan" name="form_penjualan" method="post" action="?menu=simpantr">       
        <input name="no_faktur" type="text" id="no_faktur" value="<?php echo $no_faktur; ?>" readonly class="form-control" />
        
        <label>TOTAL BELANJA</label> 
        <input name="total_belanja" type="text" id="total_belanja" value="<?php echo $total_uang; ?>" readonly class="form-control" />
        <input name="cash_jualnya" type="hidden" id="cash_jualnya" value="<?php echo $cash_grosir; ?>" readonly class="form-control" />
        <br />
     <?php echo "<a href='#ngediskon_grosir' data-toggle='modal' data-id=".$no_faktur." class='btn btn-danger'>DISKON</a>"; ?>
     <!--input type="submit" name="button2" id="button2" value="CETAK NOTA" onClick="popup()" class="btn btn-danger" /-->
     <input type="submit" name="button_selesai" id="button_selesai" value="SIMPAN" class="btn btn-danger" />
     
      </form>
      
        </div>
	</div>
</div>        
  	
<!------------///////////////////////TABEL TRANSAKSI///////////////////////////////--------------->    

	


<!--------------------================================MODAL DISKON=========================--------------->
<div class="modal fade" id="ngediskon_grosir" role="dialog">
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

<script type="text/javascript">
var mywin; 
function popup(){
mywin=window.open("kasir/faktur_grosir.php?no_faktur=<?php echo $no_faktur; ?>&cash_grosir=<?php echo $cash_grosir; ?>","_blank",	"toolbar=yes,location=yes,menubar=yes,copyhistory=yes,directories=no,status=no,resizable=no,width=500, height=400"); mywin.moveTo(100,100);}
</script>

