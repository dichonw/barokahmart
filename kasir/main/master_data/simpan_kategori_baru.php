<?php
include('../inc/koneksi.php');
ini_set("display_errors", 0);
if (isset($_POST['button_tambah_kategori_baru'])) {
    $nm_kategori    = $_POST['nm_kategori_baru'];
    $insert = mysqli_query($koneksi, "INSERT INTO tabel_kategori_baru VALUES ('','$nm_kategori')");
    if ($insert) {
        header("location:../index.php?menu=kategori&stt=sukses");
    } else {
        header("location:../index.php?menu=kategoristt=gagal");
    }
}
?>
<?php
    if (isset($_POST['button_tambah_jenis_baru'])) {
        $nm_kategori    = $_POST['nm_jenis_baru'];
        $id_kategori = $_POST['kat_jenis_baru'];
        $insert = mysqli_query($koneksi, "INSERT INTO tabel_jenis_baru VALUES ('','$id_kategori','$nm_kategori')");
        if ($insert) {
            header("location:../index.php?menu=kategori&stt=sukses");
        } else {
            header("location:../index.php?menu=kategoristt=gagal");
        }
    }
?>
<?php
    if (isset($_POST['button_tambah_data'])) {
        $kd_barang    = $_POST['kode'];
        $nm_brg = $_POST['nominal'];
        $hrg_beli = $_POST['beli'];
        $hrg_jual = $_POST['jual'];
        $kategori = $_POST['satuan'];
        $kd_toko = $_SESSION['kd_toko'];
        $insert = mysqli_query($koneksi, "INSERT INTO tabel_barang VALUES ('$kd_barang','$nm_brg','S0002','$kategori','','$hrg_jual','','$hrg_beli','','')");
        if ($insert) {
            $insertStok = mysqli_query($koneksi,"INSERT INTO tabel_stok_toko VALUES('','$kd_toko','$kd_barang','1000')");
            if ($insertStok) {    
                header("location:../index.php?menu=kategori&stt=sukses");
            }
        } else {
            header("location:../index.php?menu=kategoristt=gagal");
        }
    }
?>
<?php
if (isset($_GET['kd_kategori'])) {
    $kd_kategori = $_GET['kd_kategori'];
    $query_delete = "DELETE FROM tabel_kategori_baru WHERE id_kategori_baru='" . $kd_kategori . "'";
    $delete = mysqli_query($koneksi, $query_delete);
    if ($delete) {
        header("location:../index.php?menu=kategori&stt=sukses");
    } else {
        header("location:../index.php?menu=kategoristt=gagal");
    }
}
?>
<?php
if (isset($_GET['id_jenis'])) {
    $kd_kategori = $_GET['id_jenis'];
    $query_delete = "DELETE FROM tabel_jenis_baru WHERE id_jenis_baru='" . $kd_kategori . "'";
    $delete = mysqli_query($koneksi, $query_delete);
    if ($delete) {
        header("location:../index.php?menu=kategori&stt=sukses");
    } else {
        header("location:../index.php?menu=kategoristt=gagal");
    }
}
?>

<?php
if (isset($_GET['kd_jenis_nominal'])) {
    $kd_kategori = $_GET['kd_jenis_nominal'];
    $query_delete = "DELETE FROM tabel_barang WHERE kd_barang='" . $kd_kategori . "'";
    $delete = mysqli_query($koneksi, $query_delete);
    if ($delete) {
        header("location:../index.php?menu=kategori&stt=sukses");
    } else {
        header("location:../index.php?menu=kategoristt=gagal");
    }
}
?>
