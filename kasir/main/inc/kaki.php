
<div id="kaki">

<!--   FOOTER START================== -->
    
   
		<?php include ("koneksi.php"); $data=mysqli_fetch_array(mysqli_query($koneksi, "select * from tabel_toko order by kd_toko limit 1")); ?>
        
        <div class="footer text-center"> © <?php echo date('Y');?>. <?php echo $data['nm_toko'];?> | Design by <a href="https://republicvisual.com" target="_blank">republicvisual.com.</a> Version 4.0</div>
        
</div>