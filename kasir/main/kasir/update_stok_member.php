<?php
session_start();
include('../inc/koneksi.php');
$kd_toko = $_SESSION['kd_toko'];
$no_faktur = $_GET['no_faktur'];
$query_get_rinci_penjualan = "SELECT tabel_rinci_penjualan.*, tabel_penjualan.no_faktur_penjualan FROM tabel_rinci_penjualan, tabel_penjualan WHERE tabel_rinci_penjualan.no_faktur_penjualan=tabel_penjualan.no_faktur_penjualan AND tabel_penjualan.no_faktur_penjualan='" . $no_faktur . "'";
$get_rinci_penjualan = mysqli_query($koneksi, $query_get_rinci_penjualan);
while ($rinci_penjualan = mysqli_fetch_array($get_rinci_penjualan)) {
    $kd_barang = $rinci_penjualan['kd_barang'];
    $jml = $rinci_penjualan['jumlah'];
    $query_get_stok = "SELECT * FROM tabel_stok_toko WHERE kd_barang='" . $kd_barang . "' AND kd_toko='" . $kd_toko . "'";
    $get_stok = mysqli_query($koneksi, $query_get_stok);
    $hitung_record_stok = mysqli_num_rows($get_stok);
    if ($hitung_record_stok > 0) {
        $stok = mysqli_fetch_array($get_stok);
        $jml_stok = $stok['stok'];
        $stok_baru = $jml_stok - $jml;
        $query_update_stok = "UPDATE tabel_stok_toko SET stok='" . $stok_baru . "' WHERE kd_barang='" . $kd_barang . "' AND kd_toko='" . $kd_toko . "'";
        $update_stok = mysqli_query($koneksi, $query_update_stok);
    }
    if ($update_stok) {
        //header("location:kasir.php?menu=faktur_member&no_faktur=".$no_faktur."");} }
        echo "<script type='text/javascript'> alert('Menampilkan Nota Penjualan!'); document.location.href='kasir.php?menu=faktur_member&no_faktur=" . $no_faktur . "';</script>";
    }
}
