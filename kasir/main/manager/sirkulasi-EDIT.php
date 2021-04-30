<?php
//untuk koneksi database
include "inc/koneksi.php";
	
//untuk menantukan tanggal awal dan tanggal akhir data di database
$min_tanggal=mysqli_fetch_array(mysqli_query($koneksi, "SELECT MIN(tgl_penjualan) AS min_tanggal FROM tabel_penjualan"));
$max_tanggal=mysqli_fetch_array(mysqli_query($koneksi, "SELECT MAX(tgl_penjualan) AS max_tanggal FROM tabel_penjualan"));
?>

<form action="?menu=sirkulasi" method="post" name="postform">
<div class="row">
<div class="col-sm-4"><!------TABEL---------->
      <div class="panel-body panel-warning"> 
    	<h4 class="box-header"><i class="fas fa-chart-bar"></i> Sirkulasi Barang</h4>         
		
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
		?><i><b>Data Stok : </b> Pencarian dari tanggal <b><?php echo $_POST['tanggal_awal']?></b> sampai dengan tanggal <b><?php echo $_POST['tanggal_akhir']?></b></i><?php
		
		$query=mysqli_query($koneksi, "SELECT * FROM tabel_penjualan WHERE tgl_penjualan BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
		$jumlah=mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(total_penjualan) AS total FROM tabel_penjualan WHERE tgl_penjualan BETWEEN '$tanggal_awal' AND '$tanggal_akhir'")); }	
	?>
</p>
  <div class="panel-body panel-default">	
    <div class="table-responsive">  
       <button class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Export excel</button> 	
         <table id="demo-export" class="table table-bordered" style="font-size:11px">
             <tr>
                <th>TGL</th>
                <th>BARANG</th> 
                <!--th>BARANG MASUK</th-->
                <th>BARANG KELUAR</th>
                <!--th>BARANG RETUR BELI</th>
                <th>BARANG RETUR JUAL</th-->
            </tr>
        <?php
        //untuk penomoran data
        $no=0;	
        //menampilkan data
        while($row=mysqli_fetch_array($query)){
        ?>
                <tr>
                    <td><?php echo $row['tgl_penjualan']; ?></td>
                    <td>
                    <?php $b=mysqli_query($koneksi, "SELECT * FROM tabel_barang, tabel_rinci_penjualan WHERE tabel_barang.kd_barang = tabel_rinci_penjualan.kd_barang AND tabel_rinci_penjualan.no_faktur_penjualan = '$row[no_faktur_penjualan]' ");
					while ($c=mysqli_fetch_array($b)){
					?>	
                    <ul class="list-group list-group-flush">	
					 <li class="list-group-item"><?php echo $c['nm_barang'] ?></li>
                    </ul>                  
                    <?php } ?>                   
                    </td>
                    <!--td>
                    <?php $c=mysqli_query($koneksi, "SELECT * FROM tabel_barang, tabel_rinci_pembelian WHERE tabel_barang.kd_barang = tabel_rinci_pembelian.kd_barang AND tabel_rinci_pembelian.no_faktur_pembelian = '$row[no_faktur_pembelian]' ");
					while ($d=mysqli_fetch_array($c)){
					?>
					<ul class="list-group list-group-flush">
					 <li class="list-group-item"><?php echo $d['jumlah'] ?></li>
                    </ul>
                    <?php } ?>                
                    </td--> 
                    <td>
                    <?php $c=mysqli_query($koneksi, "SELECT * FROM tabel_barang, tabel_rinci_penjualan WHERE tabel_barang.kd_barang = tabel_rinci_penjualan.kd_barang AND tabel_rinci_penjualan.no_faktur_penjualan = '$row[no_faktur_penjualan]' ");
					while ($d=mysqli_fetch_array($c)){
					?>
					<ul class="list-group list-group-flush">
					 <li class="list-group-item"><?php echo $d['jumlah'] ?></li>
                    </ul>
                    <?php } ?>
                    </td>                  
                    <!--td></td>                    
                    <td></td-->
                   
                   
                </tr>
        <?php
        }
        ?>
                <!--tr>
                    <th colspan="2">TOTAL</th>
                    <th><?php echo $jumlah;?></th>
                </tr-->
        
        <tr>
            <td colspan="8"> 
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
/*
Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
*/
$(document).ready(function(){
    $('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });
});
</script>
<script>
	$(function() {
	   $("button").click(function(){
		$("#demo-export").table2excel({
            filename: "sirkulasi barang <?php echo $_POST['tanggal_awal']?>-<?php echo $_POST['tanggal_akhir']?>",
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
