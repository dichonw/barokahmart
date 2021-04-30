<link href="../script/css/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css">	
<script src="script/export/jquery.table2excel.js"></script>
 
<?php
//untuk koneksi database
include "../inc/koneksi.php";
	
//untuk menantukan tanggal awal dan tanggal akhir data di database
$min_tanggal=mysqli_fetch_array(mysqli_query($koneksi, "SELECT MIN(tgl_penjualan) AS min_tanggal FROM tabel_penjualan"));
$max_tanggal=mysqli_fetch_array(mysqli_query($koneksi, "SELECT MAX(tgl_penjualan) AS max_tanggal FROM tabel_penjualan"));
?>
 
<form action="?menu=piutang" method="post" name="postform">
<div class="col-sm-4"><!------TABEL---------->
      <div class="panel-body panel-warning"> 
    	<h4 class="box-header"><i class="fa fa-shopping-cart"></i>Data Piutang</h4> 
        
		<div class="col-sm-6 col-xs-6">          
          <div class="form-group">                              
           <div class="input-group date">
               <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				<input type="text" name="tanggal_awal" class="tanggal form-control" value="<?php echo $min_tanggal['min_tanggal'];?>"/>   	
            </div>
           </div>
         </div>
                		 				
		<div class="col-sm-6 col-xs-6">          
          <div class="form-group">                              
           <div class="input-group date">
               <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
<input type="text" name="tanggal_akhir" class="tanggal2 form-control" value="<?php echo $max_tanggal['max_tanggal'];?>"/>  
           </div>
         </div>  
       </div>
       
	<input type="submit" value="Tampilkan Data" name="cari" class="btn btn-default">
</form>
<a href="javascript:printDiv('pricelist');" class="btn btn-default">PRINT <i class="fa fa-print"></i></a>
 </div>
</div>  


 
<div class="col-sm-8"><!------TABEL---------->
  <div id="pricelist" class="print-area">
<p> 
<?php
if(isset($_POST['cari'])){
	$tanggal_awal=$_POST['tanggal_awal'];
	$tanggal_akhir=$_POST['tanggal_akhir'];	
	if(empty($tanggal_awal) and empty($tanggal_akhir)){
		//jika tidak menginput apa2
		$query=mysqli_query($koneksi, "SELECT * FROM tabel_penjualan");
		$jumlah=mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(total_penjualan) AS total FROM tabel_penjualan"));		
	}else{		
		?><i><b>Data Piutang Konsumen : </b> Pencarian dari tanggal <b><?php echo $_POST['tanggal_awal']?></b> sampai dengan tanggal <b><?php echo $_POST['tanggal_akhir']?></b></i><?php
		
		$query=mysqli_query($koneksi, "SELECT * FROM tabel_penjualan,tabel_supplier WHERE tgl_penjualan BETWEEN '$tanggal_awal' AND '$tanggal_akhir' AND ket ='titipan barang' AND tabel_penjualan.kd_supplier = tabel_supplier.kd_supplier");
		$jumlah=mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(total_penjualan) AS total FROM tabel_penjualan,tabel_supplier WHERE tgl_penjualan BETWEEN '$tanggal_awal' AND '$tanggal_akhir' AND ket ='titipan barang' AND tabel_penjualan.kd_supplier = tabel_supplier.kd_supplier ")); }	
	?>
</p>
  <div class="panel-body panel-default">	
    <div class="table-responsive">	
       <button class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Export excel</button>  
         <table id="demo-export" class="table table-bordered" style="font-size:11px">
             <tr>
                <th>No</th>
                <th>Member</th>
                <th>Tanggal</th> 
                <th>Ket.</th> 
                <th>DP</th>  	
                <th>Total</th>
                <th>Jatuh Tempo</th>
            </tr>
        <?php
        //untuk penomoran data
        $no=0;	
        //menampilkan data
        while($row=mysqli_fetch_array($query)){			
        ?>
                <tr>
                    <td><?php echo $no=$no+1; ?></td>
                    <td><?php echo $row['nm_supplier']; ?></td>
                    <td><?php echo $row['tgl_penjualan']; ?></td>    
                    <td><?php echo $row['ket']; ?></td> 
					<td><?php echo number_format($row['dp'],2,',','.');?></td>    
                    <td><?php echo number_format($row['total_penjualan'],2,',','.');?></td>
                    <?php } ?>
                    <?php
        $query = mysqli_query($koneksi, "SELECT *,DATE_ADD(tgl_penjualan, INTERVAL 30 DAY) as jatuh_tempo, DATEDIFF(DATE_ADD(tgl_penjualan, INTERVAL 30 DAY), CURDATE()) as selisih FROM tabel_penjualan WHERE tgl_penjualan BETWEEN '$tanggal_awal' AND '$tanggal_akhir' AND ket ='titipan barang'");
        while ($data = mysqli_fetch_array($query)) {
			$originalDate	= $data['jatuh_tempo'];
			$newDate 		= date("d-M-Y", strtotime($originalDate));
        ?>
					<td><span class="btn btn-default btn-sm"><?php echo $newDate ?></span></td>
        
        <?php } ?>
                </tr>
        
                <tr>
                    <th colspan="6">TOTAL</th>
                    <th><?php echo number_format($jumlah['total'],2,',','.');?></th>
                </tr>
        
        <tr>
            <td colspan="7"> 
            <?php
            //jika data tidak ditemukan
            if(mysqli_num_rows($query)==0){
                echo "<font color=red><blink>Tidak ada data yang dicari!</blink></font>";
            }
            ?>
            </td>
        </tr>     
       </table>
     </div> 
   </div> 
  </div> 
</div> 
<?php }else{ unset($_POST['cari']); } ?>

<script src="../script/date/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.tanggal').datepicker({
                    format: "yyyy-mm-dd",
                    autoclose:true
                });
            });
			 $(document).ready(function () {
                $('.tanggal2').datepicker({
                    format: "yyyy-mm-dd",
                    autoclose:true
                });
            });
</script>
<script>
	$(function() {
	   $("button").click(function(){
		$("#demo-export").table2excel({
            filename: "laporan piutang",
			name: "Hosting Packages",
			fileext: ".xls",
			exclude_img: true,
			exclude_links: true,
            exclude: ".dntinclude",
			exclude_inputs: true
		});  
         });
	});
</script>