<link href="../script/style.css" rel="stylesheet" type="text/css">
<link href="../../kasir/main/script/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../../kasir/main/script/css/font/css/fontawesome.min.css" rel="stylesheet" type="text/css">
<?php
$hp_user = substr("$_SESSION[hp]", 7);
$date = date('ymd');
$query = mysqli_query($koneksi, "SELECT MAX(no_faktur_penjualan) as maxid FROM tabel_penjualan WHERE no_faktur_penjualan LIKE '" . $hp_user . "%'");
$result = mysqli_fetch_array($query);
$maxid = $result['maxid'];
$no_urut = substr($maxid, -5);
$new_urut = $no_urut + 1;
$no_faktur = $hp_user . $date . sprintf("%05s", $new_urut);
?>

<div class="container-fluid pl-0 pr-0 ml-0 mr-0">
	<span class="btn btn-block btn-light text-center text-light text-uppercase mt-4 pt-5"></span>
	<?php $a = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_kategori_barang, tabel_barang WHERE tabel_barang.kd_kategori = tabel_kategori_barang.kd_kategori AND tabel_barang.kd_barang = '$_GET[kd_barang]' ORDER BY RAND()"));	?>
	<div class="container">

		<div class="row">
			<div class="col-md-6">

				<section>
					<div id="slider-animation" class="carousel slide" data-ride="carousel">

						<!-- Indicators -->
						<ul class="carousel-indicators">
							<li data-target="#slider-animation" data-slide-to="0" class="active"></li>
							<li data-target="#slider-animation" data-slide-to="1"></li>
							<li data-target="#slider-animation" data-slide-to="2"></li>
						</ul>

						<!-- The slideshow -->

						<div class="carousel-inner">
							<?php $b = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_barang_gambar WHERE id_brg = '$a[kd_barang]' ORDER BY RAND()"));	?>
							<div class="carousel-item active">
								<img src="../kasir/main/master_data/images/<?php echo $b['gambar']; ?>">
								<div class="carousel-caption">
									<!--h2 class="wow slideInRight" data-wow-duration="2s">This is Obitope text</h2>
            <p class="wow slideInLeft" data-wow-duration="2s">There is now an abundance of readable dummy texts. These are usually used when a text is required purely to fill a space. </p-->
								</div>
							</div>
							<?php
							$d = mysqli_query($koneksi, "SELECT * FROM tabel_barang_gambar WHERE id_brg = '$a[kd_barang]' ORDER BY RAND()");
							while ($c = mysqli_fetch_array($d)) {
							?>
								<div class="carousel-item">
									<img src="../kasir/main/master_data/images/<?php echo $c['gambar']; ?>">
								</div>
							<?php } ?>

						</div>

						<!-- Left and right controls -->
						<a class="carousel-control-prev" href="#slider-animation" data-slide="prev">
							<span class="carousel-control-prev-icon"></span>
						</a>
						<a class="carousel-control-next" href="#slider-animation" data-slide="next">
							<span class="carousel-control-next-icon"></span>
						</a>

					</div>

				</section>

			</div>
			<div class="col-md-6">
				<div class="heading-section">
					<h2>"<?php echo $a['nm_barang']; ?>"</h2>
				</div>
				<div class="product-dtl">
					<div class="product-info">
						<div class="product-name"><?php echo $a['nm_kategori']; ?></div>
						<!--div class="reviews-counter">
								<div class="rate">
								    <input type="radio" id="star5" name="rate" value="5" checked />
								    <label for="star5" title="text">5 stars</label>
								    <input type="radio" id="star4" name="rate" value="4" checked />
								    <label for="star4" title="text">4 stars</label>
								    <input type="radio" id="star3" name="rate" value="3" checked />
								    <label for="star3" title="text">3 stars</label>
								    <input type="radio" id="star2" name="rate" value="2" />
								    <label for="star2" title="text">2 stars</label>
								    <input type="radio" id="star1" name="rate" value="1" />
								    <label for="star1" title="text">1 star</label>
								  </div>
								<span>3 Reviews</span>
							</div-->
						<div class="product-price-discount">
							<span>Rp.<?php echo number_format($a['hrg_jual'], 2, ".", ","); ?></span>
							<!--span class="line-through">$29.00</span-->
						</div>
					</div>
					<p><?php echo $a['deskripsi']; ?></p>
					<!--div class="row">
	        				<div class="col-md-6">
	        					<label for="size">Size</label>
								<select id="size" name="size" class="form-control">
									<option>S</option>
									<option>M</option>
									<option>L</option>
									<option>XL</option>
								</select>
	        				</div>
	        				<div class="col-md-6">
	        					<label for="color">Color</label>
								<select id="color" name="color" class="form-control">
									<option>Blue</option>
									<option>Green</option>
									<option>Red</option>
								</select>
	        				</div>
	        			</div>
	        			<div class="product-count">
	        				<label for="size">Quantity</label>
	        				<form action="#" class="display-flex">
							    <div class="qtyminus">-</div>
							    <input type="text" name="quantity" value="1" class="qty">
							    <div class="qtyplus">+</div>
							</form-->
					<div class="btn-group" role="group" aria-label="Basic example">

						<!--a href="https://api.whatsapp.com/send?phone=<?php echo $data['hp_toko']; ?>&text=Hallo saya mau pesan <?php echo $a['nm_menu']; ?>" target="_blank" class="btn btn-primary text-center"><i class="fab fa-whatsapp fa-2x"></i><br />Pesan Satuan</a-->

						<form method="post" action="?menu=transaksi">
							<input type="hidden" class="form-control" name="no_nota" value="<?php echo $no_faktur; ?>" />
							<input type="hidden" class="form-control" name="kd_barang" value="<?php echo $a['kd_barang']; ?>" />
							<input type="hidden" class="form-control" name="nm_barang" value="<?php echo $a['nm_barang']; ?>" />
							<input type="hidden" class="form-control" name="jual" value="<?php echo $a['hrg_jual']; ?>" />
							<button type="submit" name="add_to_cart" class="btn btn-danger text-center" title="Beli Pakai Nota">
								<i class="fas fa-shopping-cart fa-2x"></i><br />Masukkan Keranjang</button>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
	<!--div class="product-info-tabs">
		        <ul class="nav nav-tabs" id="myTab" role="tablist">
				  	<li class="nav-item">
				    	<a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
				  	</li>
				  	<li class="nav-item">
				    	<a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews (0)</a>
				  	</li>
				</ul>
				<div class="tab-content" id="myTabContent">
				  	<div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
				  		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.
				  	</div>
				  	<div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
				  		<div class="review-heading">REVIEWS</div>
				  		<p class="mb-20">There are no reviews yet.</p>
				  		<form class="review-form">
		        			<div class="form-group">
			        			<label>Your rating</label>
			        			<div class="reviews-counter">
									<div class="rate">
									    <input type="radio" id="star5" name="rate" value="5" />
									    <label for="star5" title="text">5 stars</label>
									    <input type="radio" id="star4" name="rate" value="4" />
									    <label for="star4" title="text">4 stars</label>
									    <input type="radio" id="star3" name="rate" value="3" />
									    <label for="star3" title="text">3 stars</label>
									    <input type="radio" id="star2" name="rate" value="2" />
									    <label for="star2" title="text">2 stars</label>
									    <input type="radio" id="star1" name="rate" value="1" />
									    <label for="star1" title="text">1 star</label>
									</div>
								</div>
							</div>
		        			<div class="form-group">
			        			<label>Your message</label>
			        			<textarea class="form-control" rows="10"></textarea>
			        		</div>
			        		<div class="row">
				        		<div class="col-md-6">
				        			<div class="form-group">
					        			<input type="text" name="" class="form-control" placeholder="Name*">
					        		</div>
					        	</div>
				        		<div class="col-md-6">
				        			<div class="form-group">
					        			<input type="text" name="" class="form-control" placeholder="Email Id*">
					        		</div>
					        	</div>
					        </div>
					        <button class="round-black-btn">Submit Review</button>
			        	</form>
				  	</div>
				</div>
			</div-->


</div>
</div>

</div>
<!---------CONTAINER-------->