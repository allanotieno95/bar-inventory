<?php
require_once 'header.php';
?>

<!--Main body Content-->
        <div class="space_fixer"></div>
        <div class="container update-form">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                            
                    <div class="table-responsive">
                        <table class="table table-hover table-condensed">
                            <caption style="color:#ffffff"><h2><u>Today's Sales</u></h2></caption>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Item Name</th>
                                    <th>Quantity Sold</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                
                                $date = date('Y-m-d');
                                
                                /*SELECT `sale_id`, `date`, `pid`, `noinstock`, `addstock`, `totalinstock`, `closingstock`, `sales`, `priceperunit`, `totalsales`, `remarks` FROM `sales` WHERE 1*/
                              $sql = "SELECT s.pid,pname,s.totalsales,s.priceperunit,s.sales as sale FROM sales s
                                        INNER JOIN products p ON p.pid = s.pid
                                        WHERE date = '$date'  ";  
                               $total  = 0;
                                $i = 0;
                                $result = mysqli_query($conn, $sql);
                                 while ($r = mysqli_fetch_array($result) ){
                                     $total += $r['totalsales'];
                                     $i++;
                                     echo '<tr>
                                            <td>'.$i.'</td>
                                            <td>'.$r['pname'].'</td>
                                            
                                            <td>'.$r['sale'].'</td>
                                            <td>Kshs. '.$r['priceperunit'].'</td>
                                            <td>Kshs. '.number_format($r['totalsales'],2).'</td>
                                     </tr>';
                                 }
 
                            ?>
                                
                            </tbody>
                        </table>
                        <?php echo 'Total Sales  for <strong>' .date('l d/m/Y'). ' is <u> Kshs. ' .number_format($total,2) .'</u> </strong>';?><br/>
                        <a href="pdf/dailysales.php" class="btn btn-success btn-download">Download as PDF <span class="glyphicon glyphicon-cloud-download"></span> </a>
                    </div> 
                    
                </div>
            </div>
        </div>
        
    <!--End of Main body Content-->


<?php
require_once 'footer.php';
?>