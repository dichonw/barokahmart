<?php
session_start();
if (!isset($_SESSION['kd_toko']) && !isset($_SESSION['status_toko'])) {
	header('location:akses/login_toko.php');
} else if (!isset($_SESSION['id_user']) && !isset($_SESSION['status_user'])) {
	header('location:akses/login_user.php');
} else {
	$status_toko = $_SESSION['status_toko'];
	$status_user = $_SESSION['status_user'];
}
?>
<?php
include('../inc/koneksi.php');
if (isset($_SESSION['kd_toko'])) {
	$query_info_toko = mysqli_query($koneksi, "SELECT * FROM tabel_toko WHERE kd_toko='" . $_SESSION['kd_toko'] . "'");
	$info_toko = mysqli_fetch_array($query_info_toko);
	$nm_toko = $info_toko['nm_toko'];
	$almt_toko = $info_toko['almt_toko'];
	$tlp_toko = $info_toko['tlp_toko'];
	$fax_toko = $info_toko['fax_toko'];
	$logo_toko = $info_toko['logo'];
	$header = true;
}
?>

<!doctype html>
<html class="">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>.:Aplikasi Kasir:.</title>
	<link href="../script/css/boilerplate.css" rel="stylesheet" type="text/css">
	<link href="../script/css/style.css" rel="stylesheet" type="text/css">
	<link href="../script/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="../script/css/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
	<link href="../script/css/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="../script/css/bootstrap/css/icon-font.min.css" rel="stylesheet" type="text/css">
	<link href="../script/css/bootstrap/css/jquery-ui.css" rel="stylesheet" type="text/css">
	<link href="../script/css/paketKBK.css" rel="stylesheet" type="text/css">

	<script src="../respond.min.js"></script>
	<script src="../script/js/jquery.min.js"></script>
	<script src="../script/js/bootstrap.min.js"></script>

	<?php
	if (isset($_GET['do']) == "update") {
		$param = 2;
	} else {
		$param = 1;
	}
	?>

</head>

<body>
	<?php include '../inc/head.php' ?>
	<div class="gridContainer clearfix">
		<div id="badan">
			<?php if (($status_toko == "pusat" || $status_toko == "cabang") && $status_user == "manager" || $status_user == "admin" || $status_user == "gudang") { ?>
				<!--=================BOX MENU START====================-->
				<div class="col-sm-6">
					<a href='gudang.php?menu=pembelian'>
						<div class="panel panel-warning">
							<div class="e-slider owl-carousel owl-theme">
								<div class="item">
									<div class="panel-body">
										<div class="core-box text-center">
											<div class="text-dark text-bold space15">
												<h5 class="text-center">BELI BARANG</h5>
											</div>
											<div class="space5">
												<i class="fa fa-clipboard fa-2x"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
				<!--=================BOX MENU FINISH====================-->

				<!--=================BOX MENU START====================-->
				<div class="col-sm-6">
					<a href='gudang.php?menu=stok'>
						<div class="panel panel-warning">
							<div class="e-slider owl-carousel owl-theme">
								<div class="item">
									<div class="panel-body">
										<div class="core-box text-center">
											<div class="text-dark text-bold space15">
												<h5 class="text-center">CEK STOK</h5>
											</div>
											<div class="space5">
												<i class="fa fa-book fa-2x"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
				<!--=================BOX MENU FINISH====================-->

			<?php } ?>
			<?php
			if (isset($_GET['menu'])) {
				$menu = $_GET['menu'];
				switch ($menu) {
					case ('pembelian');
						include('pembelian.php');
						break;
					case ('stok');
						include('cek_barang.php');
						break;
					case ('faktur_pembelian');
						include('cetak_faktur.php');
				}
			}
			?>


		</div>
	</div>
	<?php include '../inc/foot.php'; ?>
</body>

</html>