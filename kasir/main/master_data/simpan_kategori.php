<?php
include('../inc/koneksi.php');
ini_set("display_errors", 0);
if (isset($_POST['button_tambah'])) {
    $kd_kategori    = $_POST['kd_kategori'];
    $nm_kategori    = $_POST['nm_kategori'];
    $gambar         = $_POST['gambar'];
    $tipe_gambar    = array('image/jpeg', 'image/bmp', 'image/png', 'image/jpg');
    $nama           = $_FILES['gambar']['name'];
    $ukuran         = $_FILES['gambar']['size'];
    $tipe           = $_FILES['gambar']['type'];
    $error          = $_FILES['gambar']['erorr'];


    var_dump($_POST['gambar']);

?>
    <?php
    if ($nama == '') {
        mysqli_query($koneksi, "INSERT INTO tabel_kategori_barang VALUES ('$kd_kategori','$nm_kategori','$nama')");
        var_dump($_POST['button_tambah']);
   ?>< script language="JavaScript">
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