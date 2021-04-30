<?php
include('../inc/koneksi.php');
ini_set("display_errors", 0);
if (isset($_POST['button_tambah'])) {
    $kd_kurir      = $_POST['kd_kurir'];
    $nm_titikawal  = $_POST['nm_titikawal'];
    $nm_titikakhir = $_POST['nm_titikakhir'];
    $nm_harga      = $_POST['nm_harga'];
    $nm_kurir      = $_POST['nm_kurir'];
    $nm_satuan = $_POST['nm_satuan'];
    $nm_spesifikasi = $_POST['nm_spesifikasi'];
    $nm_stok   = $_POST['nm_stok'];
    $kd_toko   =$_POST['kd_toko'];
?>
    <?php
    if ($nama == '') {
        mysqli_query($koneksi, "INSERT INTO tabel_kurir VALUES ('$kd_kurir','$nm_titikawal','$nm_titikakhir','$nm_harga')");
        mysqli_query($koneksi, "INSERT INTO tabel_barang VALUES ('$kd_kurir','$nm_kurir','$nm_satuan','K0031','$nm_spesifikasi','$nm_harga',0,0,0,'')");
        mysqli_query($koneksi, "INSERT INTO tabel_stok_toko VALUES('','$kd_toko','$kd_kurir','$nm_stok')");
        var_dump($_POST['button_tambah']);
   ?><script language="JavaScript">
            document.location = '../?menu=kategori'
        </script>
        <?php
    } else if ($nama != '') {
        if ($nama !== "" && $ukuran > 0 && $error == 0) {
            if (in_array(strtolower($tipe), $tipe_gambar)) {
                unlink("img/$nama");
                move_uploaded_file($_FILES['gambar']['tmp_name'], 'img/' . $nama);
                mysqli_query($koneksi, "INSERT INTO tabel_kategori_barang VALUES ('$kd_kategori','$nm_kategori','$nama')");
        ?><script language="JavaScript">
                    document.location = '../?menu=kategori'
                </script>
<?php
            } else {
                echo "<script>alert('Maaf jangan memasukkan gambar selain JPG ,JPEG, BMP, dan PNG Max.Size 1Mb');window.history.go(-1);</script>";
            }
        } else {
            echo "<script>alert('Gambar Tidak Boleh Kosong ');window.history.go(-1);";
        }
    }
}
?>