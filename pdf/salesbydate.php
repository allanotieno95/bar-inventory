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
session_start();
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
$date1 = $_SESSION['date1'];
$date2 = $_SESSION['date2'];



$html = "
    <p><b><u>Sales by Date Range ($date1 - $date2)</u></b></p>
    <table>
            <thead>
            <tr>
                <th><b>S/N</b></th>
                <th><b>Item Name</b></th>
                <th><b>Qty Sold</b></th>
                <th><b>Unit Price</b></th>
                <th><b>Total</b></th>
            </tr>
            </thead>
            <tbody>
    
    ";
        
         
        $sql = "SELECT s.pid,pname,s.totalsales,s.priceperunit,s.sales as sale FROM sales s
                                        INNER JOIN products p ON p.pid = s.pid
                                        WHERE date >= '$date1' AND date <= '$date2' ";
        $result = mysqli_query($conn, $sql);
        $i = 0;
        $sold= 0;
        $total = 0;
        $row  =array();

         while ($r = mysqli_fetch_array($result) ){

             if(!array_key_exists($r['pid'],$row)){
                 $row[$r['pid']] = $r;
             }else{
                 $row[$r['pid']]['sale'] += $r['sale'];
                // $row[$r['pid']]['totalsales'] += $r['totalsales'];
                 $row[$r['pid']]['totalsales'] += $r['totalsales'];
             } /*
              echo '<tr>
                    <td>'.$i.'</td>
                    <td>'.$r['pname'].'</td>

                    <td>'.$r['sale'].'</td>
                    <td>'.$r['priceperunit'].'</td>
                    <td>'.number_format($r['totalsales'],2).'</td>
             </tr>'; */

             $total += $r['totalsales'];    
             $kes = number_format($total,2);
             $sold += number_format($r['sale']);

        }

       foreach($row as $r)
        {
            //$total += $r['totalsales'];
             $i++;
        $html .= "
            <tr>
                    <td>".$i."</td>
                    <td>".$r["pname"]."</td>

                    <td>".$r["sale"]."</td>
                    <td>Kshs. ".number_format($r["priceperunit"],2)."</td>
                    <td>Kshs. ".number_format($r["totalsales"],2)."</td>
             </tr>
             
             ";   
        }
// Print text using writeHTMLCell()
    $html .= " <p>Total items sold is : <b>$sold</b> and Total sales is: <b><u>Kshs. $kes</u></b></p> ";
    
    $html .= "
        </tbody></table>
    ";
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('sales_by_date.pdf', 'I');
//session_destroy();

//============================================================+
// END OF FILE
//============================================================+
