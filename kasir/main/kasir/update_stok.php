<?php
// session_start();
include('inc/koneksi.php');
if (isset($_POST['button_selesai'])) {
    $no_faktur        = $_POST['no_faktur'];
    $total_belanja    = $_POST['total_belanja'];
    $cash_jual        = $_POST['cash_jualnya'];
    $tgl_penjualan    = date('Ymd');
    $id_user        = $_SESSION['id_user'];
    $kd_toko        = $_SESSION['kd_toko'];
    $query = "INSERT INTO tabel_penjualan (no_faktur_penjualan,tgl_penjualan,id_user,total_penjualan,dp,sisa,ket,status)VALUES('" . $no_faktur . "','" . $tgl_penjualan . "','" . $id_user . "','" . $total_belanja . "','','','" . 'TUNAI' . "','')";
    $insert = mysqli_query($koneksi, $query);

    // var_dump($query);
    // echo (mysqli_error($koneksi));

    if ($insert) {
        $query_item_penjualan = "SELECT kd_barang, SUM(jumlah) as total_item FROM tabel_rinci_penjualan WHERE no_faktur_penjualan='" . $no_faktur . "' group by kd_barang ";
        $item_penjualan = mysqli_query($koneksi, $query_item_penjualan);
        while ($penjualan = mysqli_fetch_array($item_penjualan)) {
            $kd_barang        = $penjualan['kd_barang'];
            $total_item        = $penjualan['total_item'];
            $query_ambil_stok = "SELECT stok FROM tabel_stok_toko WHERE kd_barang='" . $kd_barang . "' AND kd_toko='" . $kd_toko . "'";
            $ambil_stok = mysqli_query($koneksi, $query_ambil_stok);
            $stok = mysqli_fetch_array($ambil_stok);
            $stok_lama        = $stok['stok'];
            $stok_baru        = $stok_lama - $total_item;
            $query_update_stok = "UPDATE tabel_stok_toko SET stok='" . $stok_baru . "' WHERE kd_barang='" . $kd_barang . "' AND kd_toko='" . $kd_toko . "'";
            $update_stok = mysqli_query($koneksi, $query_update_stok);
        }
    } else {
        echo "transaksi gagal";
    }
}
//header('location:?menu=home');
echo "<META HTTP-EQUIV='Refresh' Content='0; URL=kasir/faktur_penjualan.php?no_faktur=$no_faktur&cash_jual=$cash_jual'>";
