<?php
require_once 'header.php';
?>

<!--Main body Content-->
        <div class="space_fixer"></div>
        <div class="container update-form">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                        <caption style="color:#ffffff"><h2><u>Sales by Date</u></h2></caption>
                        <div class="row">
                            <div class="col-md-12">
                                <form role="form" class="form-inline" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <label for="date1" >Start Date</label>
                                    <input type="text" class="form-control" name="date1" readonly>
                                    <label for="date2" >End Date</label>
                                    <input type="text" class="form-control" name="date2" readonly>
                                    <input type="submit" class="btn btn-success" value="Search" name="search">
                                </form>
                            </div>
                        </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-condensed">
                            
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
                                
                                if(isset($_POST['search'])){
                                    $date1 = $_POST['date1'];
                                    $date2 = $_POST['date2'];
                                    
                                    $_SESSION['date1'] = $date1;
                                    $_SESSION['date2'] = $date2;
                                    
                                    
                                
                               /* 
                                $date1 = '2015-12-01';
                                $date2 = date('Y-m-d');
                                */
                                
                                /*SELECT `sale_id`, `date`, `pid`, `noinstock`, `addstock`, `totalinstock`, `closingstock`, `sales`, `priceperunit`, `totalsales`, `remarks` FROM `sales` WHERE 1*/
                              $sql = "SELECT s.pid,pname,s.totalsales,s.priceperunit,s.sales as sale FROM sales s
                                        INNER JOIN products p ON p.pid = s.pid
                                        WHERE date >= '$date1' AND date <= '$date2' ";  
                                $total  = 0;
                                $i = 0;
                                $row  =array();
                                $result = mysqli_query($conn, $sql);
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
                                     
                                }
                                
                               foreach($row as $r)
                                {
                                    //$total += $r['totalsales'];
                                     $i++;
                                     echo '<tr>
                                            <td>'.$i.'</td>
                                            <td>'.$r['pname'].'</td>
                                            
                                            <td>'.$r['sale'].'</td>
                                            <td>Kshs. '.number_format($r['priceperunit'],2).'</td>
                                            <td>Kshs. '.number_format($r['totalsales'],2).'</td>
                                     </tr>';   
                                }
                                
                                    
                                
                            ?>
                                
                            </tbody>
                        </table>
                        <?php echo 'Total Sales  between ' .$date1. ' and ' .$date2. ' is <strong> <u> Kshs. ' .number_format($total,2) .'</u></strong><br /> 
                        <a href="pdf/salesbydate.php" class="btn btn-success btn-download">Download as PDF <span class="glyphicon glyphicon-cloud-download"></span> </a>'; }?><br />
                        
                        
                    </div>
                    
                </div>
            </div>
        </div>
        
    <!--End of Main body Content-->


<?php
require_once 'footer.php';
?>