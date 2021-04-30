<?php include("../kasir/main/inc/koneksi.php");?>
<?php
error_reporting( error_reporting() & ~E_NOTICE );
session_start();

if (isset($_POST['add_to_cart'])) {
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $alamat_akhir = $_POST['alamat_akhir'];
    $kd_barang    = $_POST['kd_barang'];
    $hp_user = substr("$_SESSION[hp]", 7);
    $date = date('ymd');
    $query = mysqli_query($koneksi, "SELECT MAX(no_faktur_penjualan) as maxid FROM tabel_penjualan WHERE no_faktur_penjualan LIKE '" . $hp_user . "%'");
    $result = mysqli_fetch_array($query);
    $maxid = $result['maxid'];
    $no_urut = substr($maxid, -5);
    $new_urut = $no_urut + 1;
    $no_faktur = $hp_user . $date . sprintf("%05s", $new_urut);
    // $no_faktur    = $_POST['no_nota'];
	$kd_toko    = $_SESSION['kd_toko'];
    $query = "SELECT tabel_barang.*,tabel_stok_toko.* FROM tabel_barang,tabel_stok_toko WHERE tabel_barang.kd_barang='" . $kd_barang . "' AND tabel_stok_toko.kd_barang='" . $kd_barang . "' AND tabel_stok_toko.kd_toko='MM001' ";
    $get_data    = mysqli_query($koneksi, $query);
    // $found        = mysqli_num_rows($get_data);

    if (mysqli_num_rows($get_data) == 1)  {
        $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT tabel_barang.*,tabel_stok_toko.* FROM tabel_barang,tabel_stok_toko WHERE tabel_barang.kd_barang='" . $kd_barang . "' AND tabel_stok_toko.kd_barang='" . $kd_barang . "' AND tabel_stok_toko.kd_toko='MM001' "));
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

        $query_rinci_jual = "INSERT INTO tabel_rinci_penjualan (no_faktur_penjualan,kd_barang,nm_barang,no_hp,ukuran,jumlah,harga,sub_total_jual,keterangan,alamat,alamat_akhir)VALUES ('" . $no_faktur . "','" . $kd_barang . "','" . $nm_barang . "','" . $no_hp . "','" . $ukuran . "','" . $jml . "','" . $hrg_jual_disk . "','" . $sub_total . "','TUNAI','" . $alamat . "','" . $alamat_akhir . "') ";
        $insert_rinci_jual = mysqli_query($koneksi, $query_rinci_jual);

        var_dump($nm_barang);

        echo (mysqli_error($koneksi));

        if ($insert_rinci_jual) {
			//header('location:kasir.php?menu=tunai');
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?menu=cart&no_nota=' . $no_faktur . '">';
            // header('location:../?menu=home');
        } else {
            echo "Terjadi Kesalahan, Tidak dapat melanjutkan proses";
        }
    } else {
        //echo "<script type='text/javascript'> alert('STOK KOSONG!'); document.location.href='kasir.php?menu=tunai'; <!/script>;";}}
		echo "<script type='text/javascript'> alert('STOK KOSONG'); document.location.href='../?menu=home'; </script>;";
		// echo "<script>console.log(".$query.")</script>";
    }
}
?>
<?php
ini_set("display_errors", 0);
if (isset($_POST['jml'])) {
	$no_faktur		= $_POST['no_faktur'];
	$kd_brg			= $_POST['kd_brg'];
	$jml			= $_POST['jml'];
	$hrg			= $_POST['hrg'];
	$sub_total		= $jml * $hrg;
	$sql1 = "INSERT INTO tabel_rinci_penjualan_hitung VALUES('','$no_faktur','$kd_brg','$jml','$hrg')";
	$sql2 = "UPDATE tabel_rinci_penjualan SET jumlah='$jml',harga='$hrg',sub_total_jual='$sub_total' WHERE kd_barang='$kd_brg' AND no_faktur_penjualan = '$no_faktur'";
	$insert = mysqli_query($koneksi, $sql1);
	$update = mysqli_query($koneksi, $sql2);
	if ($insert) {
		//header("location:?menu=home&stt=sukses");
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?menu=cart&no_nota=' . $no_faktur . '">';
	} else {
		//header("location:?menu=home&stt=gagal");
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?menu=cart&no_nota=' . $no_faktur . '">';
	}
	if ($update) {
		//header("location:?menu=home&stt=sukses");
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?menu=cart&no_nota=' . $no_faktur . '">';
	} else {
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?menu=cart&no_nota=' . $no_faktur . '">';
	}
}
?>  
