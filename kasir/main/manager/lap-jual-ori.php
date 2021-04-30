<script src="../../../script/js/jquery.min.3.2.1.js"></script>
<?php
//untuk koneksi database
include "inc/koneksi.php";
	
//untuk menantukan tanggal awal dan tanggal akhir data di database
$min_tanggal=mysqli_fetch_array(mysqli_query($koneksi, "SELECT MIN(tgl_penjualan) AS min_tanggal FROM tabel_penjualan"));
$max_tanggal=mysqli_fetch_array(mysqli_query($koneksi, "SELECT MAX(tgl_penjualan) AS max_tanggal FROM tabel_penjualan"));
?>
 
<form action="?menu=jual" method="post" name="postform">
<div class="row">
<div class="col-sm-4"><!------TABEL---------->
      <div class="panel-body panel-warning"> 
    	<h4 class="box-header"><i class="fas fa-shopping-cart"></i> Data Penjualan</h4>         
		
        <div class="input-group date mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
            </div>
            <input type="text" name="tanggal_awal" class="tanggal form-control" value="<?php echo $min_tanggal['min_tanggal'];?>"/>   	
          </div>
          
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
            </div>
            <input type="text" name="tanggal_akhir" class="tanggal2 form-control" value="<?php echo $max_tanggal['max_tanggal'];?>"/>   	
          </div> 		 				
		
       
	<input type="submit" value="Tampilkan Data" name="cari" class="btn btn-primary">
</form>
<!--a href="javascript:printDiv('pricelist');" class="btn btn-default">PRINT <i class="fa fa-print"></i></a-->
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
		$query=mysqli_query($koneksi, "SELECT * FROM tabel_penjualan ORDER BY tgl_penjualan DESC");
		$jumlah=mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(total_penjualan) AS total FROM tabel_penjualan ORDER BY tgl_penjualan DESC"));		
	}else{		
		?><i><b>Data Penjualan : </b> Pencarian dari tanggal <b><?php echo $_POST['tanggal_awal']?></b> sampai dengan tanggal <b><?php echo $_POST['tanggal_akhir']?></b></i><?php
		
		$query=mysqli_query($koneksi, "SELECT * FROM tabel_penjualan WHERE tgl_penjualan BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY tgl_penjualan DESC");
		$jumlah=mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(total_penjualan) AS total FROM tabel_penjualan WHERE tgl_penjualan BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY tgl_penjualan DESC")); }	
	?>
</p>
  <div class="panel-body panel-default">	
    <div class="table-responsive">  
       <button id="exporttable" class="btn btn-primary"><i class="far fa-file-excel"></i> Export</button>	
         <table id="demo-export" class="table table-bordered" style="font-size:11px">
             <tr>
                <th>No</th>
                <th>Faktur</th>
                <th>Tanggal</th>	
                <th>Penjualan</th>
                <th>Barang</th>
                <th>Member</th>
                <th>Keterangan</th>
            </tr>
        <?php
        //untuk penomoran data
        $no=0;	
        //menampilkan data
        while($row=mysqli_fetch_array($query)){
        ?>
                <tr>
                    <td><?php echo $no=$no+1; ?></td>
                    <td><?php echo $row['no_faktur_penjualan']; ?></td>
                    <td><?php echo $row['tgl_penjualan']; ?></td>
                    <td><?php echo number_format($row['total_penjualan'],2,',','.');?></td>
                    <td>
<?php $c=mysqli_query($koneksi, "SELECT * FROM tabel_barang, tabel_rinci_penjualan WHERE tabel_barang.kd_barang = tabel_rinci_penjualan.kd_barang AND tabel_rinci_penjualan.no_faktur_penjualan = '$row[no_faktur_penjualan]' ");
while ($d=mysqli_fetch_array($c)){
$hrg	 	= $d['harga'];
$jml	 	= $d['jumlah'];
$total_hrg	= $hrg*$jml;
					?>
					
					<?php echo $d['nm_barang'] ?> : <?php echo $hrg ?> x <?php echo $jml ?>= <?php echo $total_hrg ?><br> 
                    <?php } ?>
                    </td>
                    <td><?php $e=mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_member WHERE tabel_member.id_user = '$row[id_user]'")); ?><?php echo $e['nm_user'] ?></td>
                    <td><?php echo $row['ket']; ?></td>
                </tr>
        <?php
        }
        ?>
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

</div> 
<?php }else{ unset($_POST['cari']); } ?>
<script>
	$(function() {
	   $("button").click(function(){
		$("#demo-export").table2excel({
            filename: "laporan jual <?php echo $_POST['tanggal_awal']?>-<?php echo $_POST['tanggal_akhir']?>",
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