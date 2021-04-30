<?php
include('../inc/koneksi.php');
ini_set("display_errors", 0);
if (isset($_POST['ubah'])) {
    $kd_update            = $_POST['kd_update'];
    $nm_titikawal_update  = $_POST['nm_titikawal_update'];
    $nm_titikakhir_update = $_POST['nm_titikakhir_update'];
    $nm_harga_update      = $_POST['nm_harga_update'];
?>
    <?php
    if ($nama == '') {
        mysqli_query($koneksi, "UPDATE `tabel_kurir` SET `titik_awal`='$nm_titikawal_update', `titik_akhir`='$nm_titikakhir_update', `harga`='$nm_harga_update' WHERE `id_kurir`='$kd_update'");
        echo $nama;
    ?><script language="JavaScript">
            document.location = '../?menu=kategori'
        </script>
        <?php
    } elseif ($nama != '') {
        if ($nama !== "" && $ukuran > 0 && $error == 0) {
            if (in_array(strtolower($tipe), $tipe_gambar)) {
                unlink("img/$nama");
                move_uploaded_file($_FILES['gambare']['tmp_name'], 'img/' . $nama);
                mysqli_query($koneksi, "UPDATE `tabel_kategori_barang` SET `nm_kategori`='$nm_update',`ikon_kategori`='$nama' WHERE `kd_kategori`='$kd_update'");
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