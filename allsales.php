<?php
require_once 'header.php';
?>

<!--Main body Content-->
        <div class="space_fixer"></div>
        <div class="container update-form">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                            
                    <div class="table-responsive">
                        <caption style="color:#ffffff"><h2><u>All Sales</u></h2></caption>
                        <table class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Item Name</th>
                                    <th>Quantity Sold</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                
                                $date1 = '2015-12-01';
                                $date2 = date('Y-m-d');
                                
                            $sql = "SELECT `sales`.`date`, `sales`.`sales`, `sales`.`priceperunit`, `sales`.`totalsales`, `products`.`pname` from sales JOIN `products` ON `sales`.`pid` = `products`.`pid` ORDER BY `sales`.`date` DESC";
                            $result = mysqli_query($conn, $sql);
                            $i = 0;
                            $total = 0;
                                
                            if(mysqli_num_rows($result) > 0){
                //output the data of each as a row
                while($row = mysqli_fetch_assoc($result)){
                  $i++;
                  
            echo "   
            
            <tr>
              <td>".$i."</td>
              <td>".$row["date"]."</td>
              <td>".$row["pname"]."</td>
              <td>".$row["sales"]."</td>
              <td>Kshs. ".number_format($row["priceperunit"],2)."</td>
              <td>Kshs. ".number_format($row['totalsales'],2)."</td>

            </tr>
          ";
                    $total += $row['totalsales'];
              }
                            }
                            
                            
                            ?>
                                
                            </tbody>
                        </table>
                        <?php echo 'Total Sales  between ' .$date1. ' and today ' .$date2. ' is <strong> <u> Kshs. ' .number_format($total,2) .'</u></strong>';?><br />
                        <a href="pdf/all-sales.php" class="btn btn-success btn-download">Download as PDF <span class="glyphicon glyphicon-cloud-download"></span> </a>
                    </div>
                    
                </div>
            </div>
        </div>
        
    <!--End of Main body Content-->


<?php
require_once 'footer.php';
?>