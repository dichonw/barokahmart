<link href="../script/style.css" rel="stylesheet" type="text/css">
<link href="../../kasir/main/script/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../../kasir/main/script/css/font/css/fontawesome.min.css" rel="stylesheet" type="text/css">

<div class="container-fluid">
  <h3 class="mt-4 pt-5 pl-5 ml-5"><i class="fas fa-history"></i> Riwayat Belanja</h3>
  <div class="row mt-5 pl-5 pr-5">
    <?php
    $query = "SELECT * FROM tabel_penjualan,tabel_member WHERE tabel_penjualan.id_user = '" . $kd_member . "' AND tabel_member.id_user = '" . $kd_member . "' ORDER BY tabel_penjualan.no_faktur_penjualan DESC ";
    $result = mysqli_query($koneksi, $query);
    while ($a = mysqli_fetch_array($result)) {
      $antrian   = $a['no_faktur_penjualan'];
      $ongkir   = $a['ongkir'];
      $total    = $a['total'];
      $disc    = $a['disc'];
    ?>
      <div class="card col-sm-4 col-12 border-0 pb-3">
        <div class="card-body p-3 border">
          <a href="https://api.whatsapp.com/send?phone=6281216721163&text=Cek pesanan <?php echo $a['no_faktur_penjualan']; ?> saya" class="btn btn-primary btn-sm float-right" target="_blank"><i class="fab fa-whatsapp"></i> Konfirm</a>
          <span class="btn btn-danger btn-sm float-right"><i class="fas fa-clipboard-check"></i> <?php echo $a['sisa']; ?></span>
          <h5 class="card-title text-uppercase"><?php echo $a['nm_user']; ?></h5>
          <h6 class="card-subtitle mb-2 text-dark"><?php echo $a['no_faktur_penjualan']; ?><br>
            <small><?php echo $a['ket']; ?></small>
            <hr>
            <small><span class="badge badge-primary">Alamat Pengiriman</span><br><?php echo $a['status']; ?></small><br>
            <small><span class="badge badge-primary">No.HP</span><br><?php echo $a['hp']; ?></small>
          </h6>
          <hr>
          <ul class="list-group">
            <?php $query_detail = "SELECT * FROM tabel_rinci_penjualan WHERE no_faktur_penjualan = '$antrian'";
            $result_detail = mysqli_query($koneksi, $query_detail);
            while ($b = mysqli_fetch_array($result_detail)) {
            ?>
              <li class="list-group-item"><i class="fas fa-caret-right"></i>
                
              <?php
                if (empty($b['no_hp'])) {
                  echo $b['jumlah']; ?>. &nbsp;&nbsp;&nbsp; <?php echo $b['nm_barang']; 
                }elseif (empty($b['no_hp']) || empty($b['alamat'])) {
                  echo $b['jumlah']; ?>. &nbsp;&nbsp;&nbsp; <?php echo $b['nm_barang']; ?>. &nbsp;&nbsp;&nbsp; <?php echo $b['no_hp'];
                }elseif (empty($b['no_hp']) || empty($b['alamat']) || empty($b['alamat_akhir'])) {
                  echo $b['jumlah']; ?>. &nbsp;&nbsp;&nbsp; <?php echo $b['nm_barang']; ?>. &nbsp;&nbsp;&nbsp; <?php echo $b['no_hp'];?>. <br/><?php echo $b['alamat']; 
                } else {
                  echo $b['jumlah']; ?>. &nbsp;&nbsp;&nbsp; <?php echo $b['nm_barang']; ?>. &nbsp;&nbsp;&nbsp; <?php echo $b['no_hp'];?>. <br/><?php echo $b['alamat'];?>. <br/><?php echo $b['alamat_akhir']; 
                }
                ?>
              </li>
            <?php } ?>
          </ul>
          <div class="btn-group" role="group" aria-label="Basic example">
            <!--a href="kasir/kasir-nota.php?no_faktur=<?php echo $a['no_faktur_penjualan']; ?>" target="_blank" class="btn btn-danger">
<i class="fas fa-receipt"></i> Nota</a-->
          </div>
        </div>
      </div>

    <?php } ?>


  </div>
</div>