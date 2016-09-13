<?php
include 'includes/conn.php';
$date1 = "2016/01/01";
$date2 = "2016/02/13";
$sql = "SELECT s.pid, pname,s.totalsales,s.priceperunit,s.sales as sale FROM sales s INNER JOIN products p ON p.pid = s.pid WHERE date >= '$date1' AND date <= '$date2' ";
$result = mysqli_query($conn, $sql);

$test = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='app' AND `TABLE_NAME`='sales'";
$header = mysqli_query($conn, $test);

require('fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);		
foreach($header as $heading) {
	foreach($heading as $column_heading)
		$pdf->Cell(50,12,$column_heading,1);
}
foreach($result as $row) {
	$pdf->SetFont('Arial','',12);	
	$pdf->Ln();
	foreach($row as $column)
		$pdf->Cell(50,12,$column,1);
}
$pdf->Output();
?>