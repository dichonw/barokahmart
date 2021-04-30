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

<!---======================================IKLAN POPUP=================================----------->  
  
<div id="modal" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <span style="font-size:20px"><i class="fa fa-id-card"></i> <?php echo $_SESSION['id_user']; ?></span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"></h4>
	      </div>
	      <div class="modal-body">
              <h3>Selamat Datang <?php echo $_SESSION['nm_user']; ?></h3>           
           	  <p>Anda login sebagai <?php echo $_SESSION['status_user']; ?></p>
	      </div>
	      <div class="modal-footer">	        
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->  
<!---======================================IKLAN POPUP=================================-----------> 


<div class="clearfix"></div>
 
<script>
  		$('#modal').modal('show');
	</script>
</body>
</html>
