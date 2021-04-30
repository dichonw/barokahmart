<?php
include('../inc/koneksi.php');
require('fpdf/fpdf.php');
$no_faktur = $_GET['no_faktur'];
$query_info_toko = "SELECT * FROM tabel_toko";
$ambil_info_toko = mysqli_query($koneksi, $query_info_toko);
$info_toko = mysqli_fetch_array($ambil_info_toko);
$nama_toko    = $info_toko['nm_toko'];
$alamat        = $info_toko['almt_toko'];
$tlp_toko    = $info_toko['tlp_toko'];
$fax_toko    = $info_toko['fax_toko'];
$logo        = $info_toko['logo'];
$query_rinci_jual = "SELECT * FROM tabel_rinci_penjualan WHERE no_faktur_penjualan='$_GET[no_faktur]'";
$rinci_jual = mysqli_query($koneksi, $query_rinci_jual);
$id = @$_SESSION['id_user'];
$nama = @$_SESSION['nm_user'];
$query_rinci_jual = "SELECT * FROM tabel_member WHERE id='" . $id . "'";
$pdf = new FPDF("P", "cm", array(10, 15));
$pdf->SetMargins(4, 0, 0);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(2, 1, $nama_toko, 0, 0, 'C');
$pdf->ln(.2);
//ALAMAT
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(2, 1.5, $alamat, 0, 0, 'C');
$pdf->ln(.2);
//Telpon
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(2, 1.8, $tlp_toko, 0, 0, 'C');
$pdf->ln(.5);
//print
$pdf->SetMargins(0, 0, 0);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(2, 2.0, "Nota", 0, 0, 'C');
$pdf->ln(.2);
//print
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(10, 2.3, $no_faktur, 0, 0, 'C');
$pdf->ln(.5);
//print
$pdf->SetMargins(0, 0, 0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(10, 2.0, "Alamat Pengiriman", 0, 0, 'C');
$pdf->ln(.2);
//print
$b = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_penjualan WHERE no_faktur_penjualan = '$no_faktur'"));
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(10, 2.3, $b['status'], 0, 0, 'C');
$pdf->ln(.3);
$c = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tabel_member WHERE id_user = '$b[id_user]'"));
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(10, 2.3, $c['nm_user'], 0, 0, 'C');
$pdf->ln(.3);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(10, 2.3, $c['hp'], 0, 0, 'C');
//GARIS
$pdf->ln(1.5);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 0.1, "==============================================", 0, 0, 'C');
//Panggil tblcomplaints dari database cms
$kembali = 0;
$total_item = 0;
$total_penjualan = 0;
while ($data_jual = mysqli_fetch_array($rinci_jual)) {
    $nm_barang          = $data_jual['nm_barang'];
    $jml                = $data_jual['jumlah'];
    $hrg                = $data_jual['harga'];
    $keterangan         = $data_jual['keterangan'];
    $alamat_awal        = $data_jual['alamat'];
    $alamat_akhir       = $data_jual['alamat_akhir'];
    $no_hp              = $data_jual['no_hp'];
    //$sub_total=$data_jual['sub_total_jual'];
    $sub_total        = $jml * $hrg;
    $total_penjualan = $sub_total + $total_penjualan;
    /*$ppn			=$total_penjualan*0/100;
$diskon			=($total_penjualan*$discount)/100;
$total_bayar	=$total_penjualan-$diskon;
$total_uang		=$total_bayar+$ppn;*/
    //$total_bayar	=$total_penjualan+$ppn;
    $total_item        = $jml + $total_item;
    //Queri tabel yang ingin ditampilkan
    $pdf->ln(.3);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(6, 2.0,  $jml . '.' . $nm_barang, 0, 0, 'L');
    $pdf->Cell(14, 2.0, 'Rp' . number_format($sub_total, 2, ".", "."), 0, 0, 'L');
    $pdf->ln(.3);

    if(empty($alamat_awal)){
        //null
    }elseif(empty($alamat_awal) || empty($alamat_akhir)){
        $pdf->ln(.3);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(6, 2.0, 'ALAMAT:', 0, 0, 'L');
        $pdf->ln(.3);
        $pdf->ln(.3);
        $pdf->Cell(14, 2.0, $alamat_awal, 0, 0, 'L');
        $pdf->ln(.3);
        $pdf->ln(.3);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(6, 2.0, 'NO. HP :', 0, 0, 'L');
        $pdf->ln(.3);
        $pdf->ln(.3);
        $pdf->Cell(14, 2.0, $no_hp, 0, 0, 'L');
        $pdf->ln(.3);
    }else{
        $pdf->ln(.3);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(6, 2.0, 'ALAMAT AWAL:', 0, 0, 'L');
        $pdf->ln(.3);
        $pdf->ln(.3);
        $pdf->Cell(14, 2.0, $alamat_awal, 0, 0, 'L');
        $pdf->ln(.3);
        $pdf->ln(.3);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(6, 2.0, 'ALAMAT AKHIR :', 0, 0, 'L');
        $pdf->ln(.3);
        $pdf->ln(.3);
        $pdf->Cell(14, 2.0, $alamat_akhir, 0, 0, 'L');
        $pdf->ln(.3);
        $pdf->ln(.3);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(6, 2.0, 'NO. HP :', 0, 0, 'L');
        $pdf->ln(.3);
        $pdf->ln(.3);
        $pdf->Cell(14, 2.0, $no_hp, 0, 0, 'L');
        $pdf->ln(.3);
    }
}

//TOTAL
$query_jual = mysqli_query($koneksi, "SELECT * FROM tabel_penjualan WHERE no_faktur_penjualan = '$_GET[no_faktur]'");
$jual = mysqli_fetch_array($query_jual);
$tgl            = $jual['tgl_penjualan'];
$ongkir            = $jual['dp'];
$jual            = $jual['total_penjualan'];
$bayar            = floatval($ongkir) + floatval($jual);
//print
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(6, 2.9, 'ITEM :', 0, 0, 'L');
$pdf->Cell(0, 2.9, $total_item, 0, 0, 'L');

$pdf->ln(.5);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(6, 2.8, 'ONGKIR', 0, 0, 'L');
$pdf->Cell(6, 2.8, 'Rp' . number_format(floatval($ongkir), 2, ".", "."), 0, 0, 'L');

$pdf->ln(.5);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(6, 2.8, 'TTL', 0, 0, 'L');
$pdf->Cell(6, 2.8, 'Rp' . number_format(floatval($jual), 2, ".", "."), 0, 0, 'L');
//GARIS
$pdf->ln(2);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 1.1, "==============================================", 0, 0, 'C');
//BAYAR
$pdf->ln(.2);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(6, 2.0, 'BAYAR', 0, 0, 'L');
$pdf->Cell(6, 2.0, 'Rp' . number_format($bayar, 2, ".", "."), 0, 0, 'L');
//KEMBALI
/*$pdf->ln(.2);
$pdf->SetFont('Arial','',11);
$pdf->Cell(4, 3.6, 'KEMBALI', 0, 0, 'L');
$pdf->Cell(6, 3.6, $jual['sisa'], 0, 0,'L');*/

/*GARIS
$pdf->ln(2);
$pdf->Cell(20,.1, " ", "B");
$pdf->SetFont("", "", 0);*/

$pdf->ln(3);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(10, 1.0, "Terimakasih", 0, 0, 'C');
$pdf->ln(1);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(10, 0.1, "$tgl", 0, 0, 'C');
$pdf->ln(.2);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 0.1, "------------------------------------", 0, 0, 'C');
//Nama file ketika di print
$pdf->Output("Nota $no_faktur.pdf", "I");
