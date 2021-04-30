<?php
session_start();
include('../inc/koneksi.php');
//ini_set("display_errors",0);
$no_faktur_penjualan = $_POST['no_faktur_penjualan'];
$kd_barang = $_POST['kd_barang'];
$jumlah = $_POST['jumlah'];
$uang = $_POST['uang'];
$produk = mysqli_query($koneksi, "SELECT * FROM tabel_penjualan WHERE no_faktur_penjualan ='$no_faktur_penjualan'");
while ($a = mysqli_fetch_array($produk))
    $total_jual = $a['total_penjualan'] - $uang;

$produk = mysqli_query($koneksi, "SELECT * FROM tabel_rinci_penjualan WHERE no_faktur_penjualan ='$no_faktur_penjualan'");
while ($a = mysqli_fetch_array($produk))
    $sisa = $a['jumlah'] - $jumlah;


$produk = mysqli_query($koneksi, "SELECT * FROM tabel_stok_toko WHERE kd_barang ='$kd_barang'");
while ($a = mysqli_fetch_array($produk))
    $stok_akhir = $a['stok'] + $jumlah;

?>


<?php
if ($jumlah == '') {
    mysqli_query($koneksi, "UPDATE `tabel_penjualan`,`tabel_rinci_penjualan`,`tabel_stok_toko` SET `tabel_penjualan`.`total_penjualan`='$total_jual',`tabel_rinci_penjualan`.`jumlah`='$sisa',`tabel_stok_toko`.`stok`='$stok_akhir' WHERE `tabel_penjualan`.`no_faktur_penjualan`='$no_faktur_penjualan' AND `tabel_rinci_penjualan`. `no_faktur_penjualan` = '$no_faktur_penjualan' AND `tabel_stok_toko`. `kd_barang`='$kd_barang' ");
    echo $jumlah;
?><script language="JavaScript">
        document.location = 'kasir.php?menu=retur_penjualan'
    </script>
    <?php
} elseif ($jumlah != '') {
    if ($jumlah !== "") {
        mysqli_query($koneksi, "UPDATE `tabel_penjualan`,`tabel_rinci_penjualan`,`tabel_stok_toko` SET `tabel_penjualan`.`total_penjualan`='$total_jual',`tabel_rinci_penjualan`.`jumlah`='$sisa',`tabel_stok_toko`.`stok`='$stok_akhir' WHERE `tabel_penjualan`.`no_faktur_penjualan`='$no_faktur_penjualan' AND `tabel_rinci_penjualan`. `no_faktur_penjualan` = '$no_faktur_penjualan' AND `tabel_stok_toko`. `kd_barang`='$kd_barang'");
    ?><script language="JavaScript">
            document.location = 'kasir.php?menu=retur_penjualan'
        </script>
<?php
    } else {
        echo "<script>alert('Error');window.history.go(-1);</script>";
    }
} else {
    echo "<script>alert('Not Null ');window.history.go(-1);";
}
?>