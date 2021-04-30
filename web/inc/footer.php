<link href="../script/style.css" rel="stylesheet" type="text/css">
<link href="../../kasir/main/script/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../../kasir/main/script/css/font/css/fontawesome.min.css" rel="stylesheet" type="text/css">

<!--div class="feedback feedback-toggle rotate" style="background:none;border:none"><img src="../kasir/main/images/icon_toggle.png"/></div>
<div class="feedback feedback-form-wrapper">
    <form id="feedback-form" class="form-horizontal" method="post">
        <legend>Isikan Pesan</legend>
        <div class="form-group">
        	<label class="sr-only">Nama Anda</label>
        	<input name="username" class="form-control" placeholder="Your Name *" required="required" type="text"> 	
        </div>		
        <div class="form-group">
        	<label class="sr-only">No.Whatsapp</label>
        	<input name="phoneno" class="form-control" placeholder="format 6281xxxx" required="required" type="number">
        </div>
        <div class="form-group">
            <label class="sr-only">Pesan</label>
            <textarea id="issue" name="issue" class="form-control" rows="3" autocomplete="off" placeholder="Write Your Issue *" required="required"></textarea>
        </div>		    
		
        <div class="form-group">
			<button type="submit" name="sendissuedetails" class="btn btn-primary">Kirim Pesan</button>
        </div>
    </form>
</div-->
<?php
    $query = "SELECT * FROM tabel_toko";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_array($result);
?>
<section class="footers bg-light">
    <div class="container">
        <div class="row">
            <div class="col-6 col-sm-6 footers-one">
                <!--div class="footers-logo">
    		        <img src="../kasir/main/images/logo.png" alt="Logo" style="width:120px;" />
    		    </div-->
                <div class="footers-info mt-0">
                    <p><b>Tentang <?php echo $data['nm_toko']; ?></b> </p>
                </div>
                <div class="social-icons" style="margin-bottom:20px;">
                    <a href="https://www.facebook.com/BarokahMartMalang/" class="btn btn-primary text-light" target="_blank" style="margin-bottom:5px;">
                        <i class="fab fa-facebook fa-2x"></i></a>&nbsp;<small><b>Barokah Mart</b></small><br>
                    <a href="https://instagram.com/barokahmartid" class="btn btn-primary text-light" target="_blank" style="margin-bottom:5px;">
                        <i class="fab fa-instagram fa-2x"></i></a>&nbsp;<small><b>barokahmartid</b></small><br>
                    <!-- <a href="https://api.whatsapp.com/send?phone=6281216721163&text=Assalamualaikum%20admin%20barokahmart" class="btn btn-primary text-light" target="_blank">
                        <i class="fab fa-whatsapp fa-2x"></i></a> -->
                    <a class="btn btn-primary text-light" target="_blank">
                        <i class="fab fa-whatsapp fa-2x"></i></a>&nbsp;<small class="footers-info mt-0"><b>081216721163</b></small>
                </div>
            </div>
            <!--div class="col-6 col-sm-3 footers-two">
    		    <h5 class="text-primary text-uppercase">Kategori</h5>
    		    <ul class="list-unstyled">
            <?php
            $query = "SELECT * FROM tabel_kategori_barang ORDER by rand() limit 5";
            $result = mysqli_query($koneksi, $query);
            while ($kat = mysqli_fetch_array($result)) {
            ?>    			 
                 <li><a href="?menu=gallery&kd_kategori=<?php echo $kat['kd_kategori']; ?>"><i class="fas fa-caret-right"></i> <?php echo $kat['nm_kategori']; ?></a></li>
                 <?php } ?> 
    			</ul>
    		</div>
    	   <div class="col-6 col-sm-4 footers-three">
    		    <h5 class="text-primary text-uppercase">Keanggotaan</h5>
    		    <ul class="list-group">
    			 <li class="list-group-item"><a href="#" class="font-weight-bold">
                 	<i class="fas fa-caret-right"></i> Tata cara registrasi :</a></li>
    			 <li class="list-group-item"><i class="fas fa-user-lock"></i> <small>Login/Register</small></li>
                 <li class="list-group-item"><i class="far fa-id-badge"></i> <small>Isikan data anda</small></li>
                 <li class="list-group-item"><i class="fas fa-file-pdf"></i> <small>Simpan data</small></li>
    			</ul>
    		</div-->
            
            <!-- <div class="col-6 col-sm-6 footers-four">
                <h5 class="text-primary text-uppercase">Belanja</h5>
                <ul class="list-group">
                    <li class="list-group-item"><a href="#" class="font-weight-bold">
                            <i class="fas fa-caret-right"></i> Tata cara pembelian :</a></li>
                    <li class="list-group-item"><i class="fas fa-cart-arrow-down"></i> <small>Pilih barang</small></li>
                    <li class="list-group-item"><i class="fas fa-clipboard-list"></i> <small>Cek stok</small></li>
                    <li class="list-group-item"><i class="fas fa-shopping-basket"></i> <small>Klik keranjang</small></li>
                    <li class="list-group-item"><i class="far fa-check-square"></i> <small>Cek keranjang belanja</small></li>
                    <li class="list-group-item"><i class="far fa-credit-card"></i> <small>Pilih pembayaran</small></li>
                    <li class="list-group-item"><i class="fas fa-file-pdf"></i> <small>Simpan nota</small></li>
                </ul>
            </div> -->


        </div>
    </div>
</section>
<!--section class="disclaimer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 py-2">
                
            </div>
        </div>
    </div>
</section-->
<section class="copyright bg-dark">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12 pt-3">
                <p class="text-muted">© <?php echo date('Y'); ?> <?php echo $data['nm_toko']; ?></p>
            </div>
        </div>
    </div>
</section>