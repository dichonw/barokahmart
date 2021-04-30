<html>
   <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="refresh" content="300">
<title>.:FINISH:.</title>
<link href="../../kasir/main/script/css/boilerplate.css" rel="stylesheet" type="text/css">
<link href="../script/style.css" rel="stylesheet" type="text/css">
<link href="../../kasir/main/script/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../../kasir/main/script/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css">
<link href="../../kasir/main/script/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css">
<link href="../../kasir/main/script/css/font/css/fontawesome.min.css" rel="stylesheet" type="text/css">
<link href="../../kasir/main/script/css/font/css/all.min.css" rel="stylesheet" type="text/css">

<script src="../../kasir/main/script/js/respond.min.js"></script>
<script src="../../kasir/main/script/js/jquery.min.3.2.1.js"></script>
<script src="../../kasir/main/script/js/bootstrap.min.js"></script>
</head>
 <body>     
<?php 
include("../../kasir/main/inc/koneksi.php");        
$sql="SELECT * FROM tabel_penjualan WHERE no_faktur_penjualan='$_GET[no_faktur]'"; 
$qry=mysqli_query($koneksi, $sql); 
$a=mysqli_fetch_array($qry); 	  
?>
<div class="container bg-faded py-3">
  <div class="card bg-light">
    <div class="login-box">
      <div class="login-snip"> 
        <input id="tab-1" type="radio" name="tab" class="sign-in text-center" checked><label for="tab-1" class="tab">
             <strong>Terima kasih telah berbelanja di barokah mart</strong></label> 
        <input id="tab-2" type="hidden" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
        <div class="login-space">
          <div class="login">
            <small class="text-uppercase text-center">Mohon ditunggu, barang anda segera kami antarkan</small>
           <hr> 
            <div class="group">
               <div class="row"> 
                <a href="../?menu=home" class="btn btn-danger col-4 text-center"><i class="fas fa-store fa-2x"></i> <br>HOME</a>
                <a href="https://wa.me/6281216721163?text=Saya%20sudah%20melakukan%20pembelian%20<?php echo $a['no_faktur_penjualan'];?>" class="btn btn-primary col-4 text-center" target="_blank">
                	<i class="far fa-check-circle fa-2x"></i> <br>KONFIRMASI</a>
                <a href="kasir-nota.php?no_faktur=<?php echo $a['no_faktur_penjualan'];?>" class="btn btn-danger col-4 text-center" target="_blank">
                	<i class="fas fa-receipt fa-2x"></i> <br>KELUAR</a>
             </div>
           </div>             
         </div>
         
      <div class="sign-up-form"></div>
       </div>
      </div>
    </div>
  </div>
</div>
 
 </body>
</html>