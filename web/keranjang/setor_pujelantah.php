<?php include("../kasir/main/inc/koneksi.php");?>
<?php
error_reporting( error_reporting() & ~E_NOTICE );
session_start();

if (isset($_POST['add_to_cart'])) {
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $jml = $_POST['jml'];
    $kd_barang    = $_POST['kd_barang'];
    $id_user		=$_POST['id_member'];
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

        $query_rinci_jual = "INSERT INTO tabel_rinci_penjualan (no_faktur_penjualan,kd_barang,nm_barang,no_hp,ukuran,jumlah,keterangan,alamat)VALUES ('" . $no_faktur . "','" . $kd_barang . "','" . $nm_barang . "','" . $no_hp . "','" . $ukuran . "','" . $jml . "','TUNAI','" . $alamat . "') ";
        $insert_rinci_jual = mysqli_query($koneksi, $query_rinci_jual);

        var_dump($nm_barang);

        echo (mysqli_error($koneksi));

        if ($insert_rinci_jual) {
			//header('location:kasir.php?menu=tunai');
            $query="INSERT INTO tabel_penjualan (no_faktur_penjualan,tgl_penjualan,id_user,dp,sisa,ket,status)VALUES('".$no_faktur."',NOW(),'$id_user','','wait','PU Jelantah $ket','".$alamat."')";
            $insert=mysqli_query($koneksi, $query);
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?menu=record">';
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

