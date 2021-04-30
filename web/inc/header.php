<link href="../script/style.css" rel="stylesheet" type="text/css">
<link href="../../kasir/main/script/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../../kasir/main/script/css/font/css/fontawesome.min.css" rel="stylesheet" type="text/css">
<title>.:<?php echo $nm_member;?>:.</title>
<link rel="shortcut icon" href="../logo.png">

<nav class="navbar navbar-light bg-light justify-content-between flex-nowrap flex-row fixed-top">
    <div class="container">
    	<!--button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"-->
        
    	<a href="#" data-toggle="modal" data-target="#cari" style="color:#212529"><i class="fas fa-search fa-2x"></i></a>
  		</button>
        
  
        <a href="?menu=home" class="navbar-brand"><img src="../kasir/main/images/logo-2.png" width="150px" /></a>
        <ul class="nav navbar-nav flex-row float-right">
            <!--li class="nav-item active"><a class="nav-link pr-4" href=""><i class="fas fa-search"></i></a></li-->
            <li class="nav-item"><a class="nav-link pr-4" href="?menu=cart"><i class="fas fa-shopping-bag fa-2x"></i></a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#user"><i class="fas fa-user fa-2x"></i></a></li> 
            <!--li class="nav-item"><a class="nav-link" href="akses/logout.php"><i class="fas fa-user-lock"></i></a></li-->
        </ul>                
        <div class="collapse navbar-collapse" id="navbarNav">        
        <ul class="navbar-nav pre-scrollable">
<?php $query = "SELECT * FROM tabel_kategori_barang ORDER BY nm_kategori ASC";$result = mysqli_query($koneksi, $query);while ($kat = mysqli_fetch_array($result)){
?>          
          <li class="nav-item"><a class="nav-link" href="?menu=gallery&kd_kategori=<?php echo $kat['kd_kategori'];?>"><i class="fas fa-caret-right"></i> <?php echo $kat['nm_kategori'];?></a>
          </li>
          <?php }?> 
          
        </ul>
      </div>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-primary">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <a href="?menu=akun" class="btn btn-danger">Edit Akun <?php echo $nm_member;?></a>
        <a href="akses/logout.php" class="btn btn-light">Keluar</a>
      </div>
      <div class="modal-footer border-0">        
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="cari" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content bg-primary">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
       <form method="post" action="?menu=search">
        <div class="container h-100">
          <div class="d-flex justify-content-center h-100">
            <div class="searchbar">
              <input class="search_input" type="text" name="cari" placeholder="Cari barang...">
              <button type="submit" class="search_icon text-dark"><i class="fas fa-search"></i></button>
            </div>
          </div>
        </div>
        </form>    
      </div>
      <div class="modal-footer border-0">        
      </div>
    </div>
  </div>
</div>