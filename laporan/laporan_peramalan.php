<?php
include'koneksi.php';
include"fpdf.php";
require('makefont/makefont.php');
$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(1,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',12);
$pdf->SetX(1.6);   
$pdf->Image('img/logon.png', 1, 1, 2);
$pdf->SetX(1.6);
$pdf->SetFont('Times','B',12);
$pdf->SetX(3);            
$pdf->MultiCell(15.5,0.6,'TOKO CITRA',0,'L');
$pdf->SetX(3);
$pdf->SetFont('Times','i',10);
$pdf->MultiCell(22.5,0.6,'Jl.Tukad Barito Timur No.7 Renon, Denpasar Selatan',0,'L'); 
$tglaw = $_POST['tglaw'];
$tglak = $_POST['tglak'];
$pdf->SetX(3);
$pdf->SetFont('Times','i',10);
$pdf->MultiCell(22.5,0.6,"Laporan Data Peramalan Tanggal: ".$tglaw."-".$tglak,0,'L'); 
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->SetFont('Times','i',8);
$tglaw = $_POST['tglaw'];
$tglak = $_POST['tglak'];
$pdf->ln(1);
$pdf->Cell(3.5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Times','B',8);
$pdf->Cell(1, 0.6, 'No', 1, 0, 'C');
$pdf->Cell(5, 0.6, 'ID Barang-Nama Barang', 1, 0, 'L');
$pdf->Cell(3.5, 0.6, 'Barcode', 1, 0, 'L');
$pdf->Cell(3, 0.6, 'Tanggal', 1, 0, 'L');
$pdf->Cell(2.5, 0.6, 'Bulan', 1, 0, 'L');
$pdf->Cell(2.5, 0.6, 'Qty', 1, 0, 'L');
$pdf->Cell(2.5, 0.6, 'Forecast', 1, 0, 'L');
$pdf->Cell(2.5, 0.6, 'RSFE', 1, 0, 'L');
$pdf->Cell(2.5, 0.6, 'Error', 1, 0, 'L');
$pdf->Cell(2.5, 0.6, 'MAD', 1, 1, 'L');
$no=1;
$sql="SELECT * FROM tbl_peramalan WHERE tanggal BETWEEN '$tglaw' AND '$tglak'";
$tampil=mysqli_query($connect, $sql);
while($lihat=mysqli_fetch_array($tampil)){
    $pdf->SetFont('Times','',7);
    $pdf->Cell(1, 0.6, $no , 1, 0, 'C');
    $sql_x="SELECT * FROM tbl_barang WHERE kode_barang='".$lihat['kode_barang']."'";
    $tampil_x=mysqli_query($connect, $sql_x);
    while ($lihat2=mysqli_fetch_array($tampil_x)) {
    $pdf->Cell(5, 0.6,$lihat['kode_barang']."-".$lihat2['nama_barang'],1, 0, 'L');
    $pdf->Cell(3.5, 0.6, $lihat2['barcode'],1, 0, 'L');
    }
    $pdf->Cell(3, 0.6, $lihat['tanggal'],1, 0, 'L');
    $pdf->Cell(2.5, 0.6, $lihat['bulan'],1, 0, 'L');
    $pdf->Cell(2.5, 0.6, $lihat['qty'],1, 0, 'L');
    $pdf->Cell(2.5, 0.6, $lihat['forecast'],1, 0, 'L');
    $pdf->Cell(2.5, 0.6, $lihat['rsfe'],1, 0, 'L');
    $pdf->Cell(2.5, 0.6, $lihat['error'],1, 0, 'L');
    $pdf->Cell(2.5, 0.6, $lihat['mad'],1, 1, 'L');
    $no++;
}

$order="SELECT * FROM tbl_peramalan WHERE tanggal BETWEEN '$tglaw' AND '$tglak'";
$query_order=mysqli_query($connect, $order);
$data_order=array();
while(($row_order=mysqli_fetch_array($query_order)) !=null){
$data_order[]=$row_order;
}
$count=count($data_order);
$pdf->SetFont('Times','B',8);
$pdf->Cell(25, 0.6,"Jumlah Barang",1, 0, '');
$pdf->Cell(2.5, 0.6, $count ,1, 1, 'C');
$pdf->Output();
?>