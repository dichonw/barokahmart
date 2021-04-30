<?php
include('../../kasir/main/inc/koneksi.php'); 
require('fpdf/fpdf.php');
$no_faktur=$_GET['no_faktur'];
$query_info_toko="SELECT * FROM tabel_toko";
$ambil_info_toko=mysqli_query($koneksi, $query_info_toko);
$info_toko=mysqli_fetch_array($ambil_info_toko);
$nama_toko=$info_toko['nm_toko'];
$alamat=$info_toko['almt_toko'];
$tlp_toko=$info_toko['tlp_toko'];
$fax_toko=$info_toko['fax_toko'];
$logo=$info_toko['logo'];
$query_rinci_jual="SELECT * FROM tabel_rinci_penjualan WHERE no_faktur_penjualan='$_GET[no_faktur]'";	
$rinci_jual=mysqli_query($koneksi, $query_rinci_jual);
$id=$_SESSION['id_user'];
$nama=$_SESSION['nm_user'];
$query_rinci_jual="SELECT * FROM tabel_member WHERE id='".$id."'";
$pdf = new FPDF("P","cm",array(10,15));
$pdf->SetMargins(4,0,0);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(2,1,$nama_toko,0,0,'C');
$pdf->ln(.2);
//ALAMAT
$pdf->SetFont('Arial','',9);
$pdf->Cell(2,1.5,$alamat,0,0,'C');
$pdf->ln(.2);
//Telpon
$pdf->SetFont('Arial','B',11);
$pdf->Cell(2,1.8,$fax_toko,0,0,'C');
$pdf->ln(.5);
//print
$pdf->SetMargins(0,0,0);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(2,2.0,"Nota",0,0,'C');
$pdf->ln(.2);
//print
$pdf->SetFont('Arial','',8);
$pdf->Cell(10,2.3,$no_faktur,0,0,'C');
$pdf->ln(.5);
//Panggil tblcomplaints dari database cms
$kembali=0; $total_item=0; $total_penjualan=0;
while($data_jual=mysqli_fetch_array($rinci_jual)){
$nm_barang		=$data_jual['nm_barang'];
$jml			=$data_jual['jumlah'];
$hrg			=$data_jual['harga'];
$discount		=$data_jual['diskon'];
$keterangan		=$data_jual['keterangan'];
//$sub_total=$data_jual['sub_total_jual'];
$sub_total		=$jml*$hrg;
$total_penjualan=$sub_total+$total_penjualan;
$ppn			=$total_penjualan*0/100;
$diskon			=($total_penjualan*$discount)/100;
$total_bayar	=$total_penjualan-$diskon;
$total_uang		=$total_bayar+$ppn;
//$total_bayar	=$total_penjualan+$ppn;
$total_item		=$jml+$total_item;	
//Queri tabel yang ingin ditampilkan
$pdf->ln(.3);
$pdf->SetFont('Arial','',9);
$pdf->Cell(6,2.0,  $jml.'.'.$nm_barang, 0, 0, 'L');
$pdf->Cell(14,2.0, 'Rp'. number_format($sub_total,2,".","."), 0, 0,'L');
$pdf->ln(.3);
}

//TOTAL
$query_jual=mysqli_query($koneksi, "SELECT * FROM tabel_penjualan WHERE no_faktur_penjualan = '$_GET[no_faktur]'");
$jual=mysqli_fetch_array($query_jual);
//print
$pdf->SetFont('Arial','',9);
$pdf->Cell(6,2.9,'Ket :',0,0,'L');
$pdf->Cell(0,2.9,$jual['ket'],0,0,'L');


$pdf->ln(.5);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(6, 2.8, 'TTL', 0, 0, 'L');
$pdf->Cell(6, 2.8,'Rp'. number_format($jual['total_penjualan'],2,".","."), 0, 0,'L');
//BAYAR
/*$pdf->ln(.2);
$pdf->SetFont('Arial','',11);
$pdf->Cell(4, 3.2, 'BAYAR', 0, 0, 'L');
$pdf->Cell(6, 3.2, $jual['bayar'], 0, 0,'L');
//KEMBALI
$pdf->ln(.2);
$pdf->SetFont('Arial','',11);
$pdf->Cell(4, 3.6, 'KEMBALI', 0, 0, 'L');
$pdf->Cell(6, 3.6, $jual['sisa'], 0, 0,'L');*/

/*GARIS
$pdf->ln(2);
$pdf->Cell(20,.1, " ", "B");
$pdf->SetFont("", "", 0);*/

$pdf->ln(3);
$pdf->SetFont('Arial','',11);
$pdf->Cell(10,1.0,"Terimakasih",0,0,'C');
$pdf->ln(.2);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,1.1,"------",0,0,'C');
//Nama file ketika di print
$pdf->Output("Nota $no_faktur.pdf","I");
?>