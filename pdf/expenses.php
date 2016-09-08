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
    <p><b><u><h2>Total expenses between ($date1 - $date2)</h2></u></b></p>
    <table>
            <thead>
            <tr>
                <th><b>S/N</b></th>
                <th><b>Date</b></th>
                <th><b>Expenses</b></th>
                <th><b>Reason for Expenditure</b></th>
            </tr>
            </thead>
            <tbody>
    
    ";
        
         
        $sql = "SELECT `expense_id`, `exp_date`, `expenses`, `reason_for_expenditure` FROM expenses WHERE exp_date >= '$date1' AND exp_date <= '$date2' ORDER BY `exp_date` DESC";
        $total  = 0;
        $i = 0;
        $row  =array();
        $result = mysqli_query($conn, $sql);

         while ($r = mysqli_fetch_array($result) ){
                                     
             if(!array_key_exists($r['expense_id'],$row)){
                 $row[$r['expense_id']] = $r;
             }else{
                 $row[$r['expense_id']]['expenses'] += $r['expenses'];
                // $row[$r['pid']]['totalsales'] += $r['totalsales'];
                 //$row[$r['expense_id']]['totalsales'] += $r['totalsales'];
             } /*
              echo '<tr>
                    <td>'.$i.'</td>
                    <td>'.$r['pname'].'</td>

                    <td>'.$r['sale'].'</td>
                    <td>'.$r['priceperunit'].'</td>
                    <td>'.number_format($r['totalsales'],2).'</td>
             </tr>'; */

             $total += $r['expenses'];

        }

        foreach($row as $r)
            {
                //$total += $r['totalsales'];
                 $i++;
                 $html .= "<tr>
                        <td>".$i."</td>
                        <td>".$r["exp_date"]."</td>

                        <td>Kshs. ".number_format($r["expenses"],2)."</td>
                        <td>".$r["reason_for_expenditure"]."</td>

                 </tr>";   
            }

// Print text using writeHTMLCell()
    $html .= " <p>Total items expenses is : Kshs. <b>".number_format($total,2)."</b></p> ";
    
    $html .= "
        </tbody></table>
    ";
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('expenses_by_date_range.pdf', 'I');
//session_destroy();

//============================================================+
// END OF FILE
//============================================================+
