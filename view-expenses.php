<?php
require_once 'header.php';
?>

<!--Main body Content-->
        <div class="space_fixer"></div>
        <div class="container update-form">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                        <caption style="color:#ffffff"><h2><u>View Expenses</u></h2></caption>
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
                                    <th>Date</th>
                                    <th>Expenses</th>
                                    <th>Reason for Expenditure</th>
                                   
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
                                     echo '<tr>
                                            <td>'.$i.'</td>
                                            <td>'.$r['exp_date'].'</td>
                                            
                                            <td>Kshs. '.number_format($r['expenses'],2).'</td>
                                            <td>'.$r['reason_for_expenditure'].'</td>
                                            
                                     </tr>';   
                                }
                                
                                    
                                
                            ?>
                                
                            </tbody>
                        </table>
                        <?php echo 'Total Expenses  between ' .$date1. ' and ' .$date2. ' is <strong> <u> Kshs. ' .number_format($total,2) .'</u></strong><br /> 
                        <a href="pdf/expenses.php" class="btn btn-success btn-download">Download as PDF <span class="glyphicon glyphicon-cloud-download"></span> </a>'; }?><br />
                        
                    </div>
                    
                </div>
            </div>
        </div>
        
    <!--End of Main body Content-->


<?php
require_once 'footer.php';
?>