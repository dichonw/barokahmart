<!doctype html>
<html class="">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>.:Aplikasi Kasir:.</title>
<link href="script/css/boilerplate.css" rel="stylesheet" type="text/css">
<link href="script/css/style.css" rel="stylesheet" type="text/css">
<link href="script/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="script/css/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
<link href="script/css/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="script/css/bootstrap/css/icon-font.min.css" rel="stylesheet" type="text/css">
<link href="script/css/bootstrap/css/jquery-ui.css" rel="stylesheet" type="text/css">
<link href="script/css/paketKBK.css" rel="stylesheet" type="text/css">

<script src="respond.min.js"></script>
<script src="script/js/jquery.min.js"></script>
<script src="script/js/bootstrap.min.js"></script>



</head>
<body>
<div class="gridContainer clearfix">
  
  <div id="badan">
   
  	<div class="container">
	<div class="row login_box">
	    <div class="col-md-12 col-xs-12" align="center">
            <div class="line"><h3><?php
				date_default_timezone_set('Asia/Jakarta');
				$sekarang = new DateTime();
				$menit = $sekarang -> getOffset() / 60;
				$tanda = ($menit < 0 ? -1 : 1);
				$menit = abs($menit);
				$jam = floor($menit / 60);
				$menit -= $jam * 60;
				$offset = sprintf('%+d:%02d', $tanda * $jam, $menit);
				$hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu");
				$bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
				echo $hari[date("w")].", ".date("j")." ".$bulan[date("n")]." ".date("Y");
			?> | <?php echo date("H:i:s");?></h3></div>
            
           <?php include ("inc/koneksi.php"); $data=mysql_fetch_array(mysql_query("select * from tabel_toko order by rand()")); ?>
            <div class="outter"><img src="images/<?php echo $data['logo'];?>" class="image-circle"/></div>   
            <h1><?php echo $data['nm_toko'];?></h1>
	    </div>
        
        <div class="col-md-12 col-xs-12 login_control">
                
                <div class="form-group">
					<label class="col-sm-5 control-label" style="color:#111;font-weight:normal">Nama Pengguna</label>
						<div class="col-sm-7">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								<input type="text" placeholder="Nama" class="form-control">
							  </div>
							</div>
                          </div>
                <br>          
                <div class="form-group">
					<label class="col-sm-5 control-label" style="color:#111;font-weight:normal">Password</label>
						<div class="col-sm-7">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-pencil"></i></span>
								<input type="password" class="form-control" placeholder="xxxxxx"/>
							  </div>
							</div>
                          </div>
                
                <br>
                <div class="form-group">
                     <button class="btn btn-info btn-lg center-block"><i class="fa fa-hand-o-right"></i> LOGIN</button>
                </div>
                
        </div>
        
        
            
    </div>
</div>
  
 
    
   
  </div>
  
 
  
</div>
</body>
</html>
