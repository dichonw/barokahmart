<?php
error_reporting( error_reporting() & ~E_NOTICE );
session_start();
include('../inc/koneksi.php');

if (isset($_GET['kd_barang']) || isset($_GET['no_faktur'])) {
    $no_hp = $_GET['no_hp'];
    $alamat = $_GET['alamat'];
    $kd_barang    = empty($_GET['kd_barang']) ? $_GET['kd_barang_baru'] : $_GET['kd_barang'];
    $no_faktur    = $_GET['no_faktur'];
    $kd_toko    = $_SESSION['kd_toko'];
    $query = "SELECT tabel_barang.*,tabel_stok_toko.* FROM tabel_barang,tabel_stok_toko WHERE tabel_barang.kd_barang='" . $kd_barang . "' AND tabel_stok_toko.kd_barang='" . $kd_barang . "' AND tabel_stok_toko.kd_toko='" . $kd_toko . "'  AND tabel_stok_toko.stok>0 ";
    $get_data    = mysqli_query($koneksi, $query);
    $found        = mysqli_num_rows($get_data);

    if ($found != 0) {
        $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT tabel_barang.*,tabel_stok_toko.* FROM tabel_barang,tabel_stok_toko WHERE tabel_barang.kd_barang='" . $kd_barang . "' AND tabel_stok_toko.kd_barang='" . $kd_barang . "' AND tabel_stok_toko.kd_toko='" . $kd_toko . "' "));
        $kd_barang        = $data['kd_barang'];
        $nm_barang        = $data['nm_barang'];
        $kd_satuan        = $data['kd_satuan'];
        $kd_kategori    = $data['kd_kategori'];
        // $no_hp            = (empty($data['no_hp']) ? '' : $data['no_hp']);
        $ukuran            = (empty($data['ukuran']) ? '0' : $data['ukuran']);
        $hrg_jual        = $data['hrg_jual'];
        $hrg_grosir        = $data['hrg_grosir'];
        $hrg_beli        = $data['hrg_beli'];
        $diskon            = (empty($data['diskon'])) ? '0' : $data['diskon'];
        $disk            = $hrg_beli * $diskon / 100;
        $hrg_jual_disk    = $hrg_jual - $disk;
        $stok            = $data['stok'];
        //$jml			=$_POST['jml'];
        $jml            = 1;
        $sub_total = $hrg_jual_disk * $jml;

        $query_rinci_jual = "INSERT INTO tabel_rinci_penjualan (no_faktur_penjualan,kd_barang,nm_barang,no_hp,ukuran,jumlah,harga,sub_total_jual,keterangan,alamat,alamat_akhir)VALUES ('" . $no_faktur . "','" . $kd_barang . "','" . $nm_barang . "','" . $no_hp . "','" . $ukuran . "','" . $jml . "','" . $hrg_jual_disk . "','" . $sub_total . "','TUNAI','" . $alamat . "','') ";
        $insert_rinci_jual = mysqli_query($koneksi, $query_rinci_jual);

        var_dump($nm_barang);

        echo (mysqli_error($koneksi));

        if ($insert_rinci_jual) {
            //header('location:kasir.php?menu=tunai');
            header('location:../?menu=home');
        } else {
            echo "Terjadi Kesalahan, Tidak dapat melanjutkan proses";
        }
    } else {
        //echo "<script type='text/javascript'> alert('STOK KOSONG!'); document.location.href='kasir.php?menu=tunai'; <!/script>;";}}
        echo "<script type='text/javascript'> alert('STOK KOSONG!'); document.location.href='../?menu=home'; </script>;";
    }
}
