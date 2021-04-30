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

<div class="row">


	<!--=================BOX MENU START====================-->
	<div class="col-sm-2">
		<a href='?menu=jual'>
			<div class="panel panel-warning">
				<div class="e-slider owl-carousel owl-theme">
					<div class="item">
						<div class="panel-body">
							<div class="core-box text-center">
								<div class="text-dark text-bold space15">
									<h5 class="text-center">PENJUALAN</h5>
								</div>
								<div class="space5">
									<i class="fa fa-shopping-cart fa-2x"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
	<!--=================BOX MENU FINISH====================-->

	<!--=================BOX MENU START====================--
                             <div class="col-sm-2">
								<a href='?menu=beli' >
                                <div class="panel panel-warning">
									<div class="e-slider owl-carousel owl-theme">										
										<div class="item">
											<div class="panel-body">												
                                                <div class="core-box text-center">
													<div class="text-dark text-bold space15">
														<h5 class="text-center">PEMBELIAN</h5>
													</div>
													<div class="space5">
														<i class="fa fa-cart-arrow-down fa-2x"></i>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div></a>
                              </div>
<!--=================BOX MENU FINISH====================-->

	<!--=================BOX MENU START====================-->
	<div class="col-sm-2">
		<a href='?menu=sirkulasi'>
			<div class="panel panel-warning">
				<div class="e-slider owl-carousel owl-theme">
					<div class="item">
						<div class="panel-body">
							<div class="core-box text-center">
								<div class="text-dark text-bold space15">
									<h5 class="text-center">SIRKULASI</h5>
								</div>
								<div class="space5">
									<i class="fas fa-chart-bar fa-2x"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
	<!--=================BOX MENU FINISH====================-->

	<!--=================BOX MENU START====================--
                             <div class="col-sm-2">
								<a href='?menu=retur' >
                                <div class="panel panel-warning">
									<div class="e-slider owl-carousel owl-theme">										
										<div class="item">
											<div class="panel-body">												
                                                <div class="core-box text-center">
													<div class="text-dark text-bold space15">
														<h5 class="text-center">RETUR</h5>
													</div>
													<div class="space5">
														<i class="fa fa-refresh fa-2x"></i>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div></a>
                              </div>
<!--=================BOX MENU FINISH====================-->


	<!--=================BOX MENU START====================--
                             <div class="col-sm-2">
								<a href='?menu=piutang' >
                                <div class="panel panel-warning">
									<div class="e-slider owl-carousel owl-theme">										
										<div class="item">
											<div class="panel-body">												
                                                <div class="core-box text-center">
													<div class="text-dark text-bold space15">
														<h5 class="text-center">PIUTANG</h5>
													</div>
													<div class="space5">
														<i class="fa fa-user-secret fa-2x"></i>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div></a>
                              </div>
<!--=================BOX MENU FINISH====================-->

	<!--=================BOX MENU START====================-->
	<div class="col-sm-2">
		<a href='?menu=labarugi'>
			<div class="panel panel-warning">
				<div class="e-slider owl-carousel owl-theme">
					<div class="item">
						<div class="panel-body">
							<div class="core-box text-center">
								<div class="text-dark text-bold space15">
									<h5 class="text-center">LABA</h5>
								</div>
								<div class="space5">
									<i class="fa fa-balance-scale fa-2x"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
	<!--=================BOX MENU FINISH====================-->





</div>


<textarea id="printing-css" style="display:none;">.no-print{display:none}</textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<script type="text/javascript">
	function printDiv(elementId) {
		var a = document.getElementById('printing-css').value;
		var b = document.getElementById(elementId).innerHTML;
		window.frames["print_frame"].document.title = document.title;
		window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
		window.frames["print_frame"].window.focus();
		window.frames["print_frame"].window.print();
	}
</script>