<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: ALlan Dhoye
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');
include '../includes/conn.php';


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Allan Dhoye');
$pdf->SetTitle('All Sales Report');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' ', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------


// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 12, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage("L");
$date = date('Y-m-d');
$date2 = date('l d/m/Y');
$sql = "SELECT s.pid,pname,s.totalsales,s.priceperunit,s.sales as sale FROM sales s
                                        INNER JOIN products p ON p.pid = s.pid
                                        WHERE date = '$date'  ";
$result = mysqli_query($conn, $sql);
$i = 0;
$sold= 0;
$total = 0;

$html = "
    <p><b><u>Daily Sales Records for $date2</u></b></p>
    <table>
            <thead>
                <tr>
                    <th><b>No</b></th>
                    <th><b>Item Name</b></th>
                    <th><b>Quantity Sold</b></th>
                    <th><b>Unit Price</b></th>
                    <th><b>Total</b></th>

                </tr>
            </thead>
            <tbody>
    
    ";

if (mysqli_num_rows($result) > 0) {
    
    
    while($row = mysqli_fetch_assoc($result)) {
       
        $i++;
        $html .= "
            
            <tr>
                <td>".$i."</td>
                <td>".$row["pname"]."</td>
                <td>".$row["sale"]."</td>
                <td>Kshs. ".number_format($row["priceperunit"],2)."</td>
                <td>Kshs. ".number_format($row["totalsales"],2)."</td>
            </tr>
            
        "; 
        $total += $row['totalsales'];
        $kes = number_format($total,2);
        $sold += number_format($row['sale']);
        
    } 
    
    $html .= " <p>Total items sold is : <b>$sold</b> and Total sales is: <b><u>Kshs. $kes</u></b></p> ";
    
    $html .= "
        </tbody></table>
    ";
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        //$pdf->AddPage();
} else {
    $html= " There are no records for today's ($date2) sales ";


    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
} 


// Print text using writeHTMLCell()


// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('Daily_Sales.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
