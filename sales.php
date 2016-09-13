<?php 

//including connection file
include ('includes/conn.php');

//selecting data from the database
$sql = "Select * from products";
$result = mysqli_query($conn, $sql);
$i = 0;

//adding new record to database
if(isset($_POST['add'])){
                        $pname = $_POST['pname'];
                        $noinstock = $_POST['noinstock'];
                        $priceperunit = $_POST['priceperunit'];
                        
                        if(!$pname or !$noinstock or !$priceperunit){
                            echo "<script type='text/javascript'> alert('Fill in the details')</script>";
                        } else {
                            
                            $update = "insert into products (pname, noinstock, priceperunit) values ('$pname', '$noinstock', '$priceperunit')";
                            
                            $qry = mysqli_query($conn, $update);
                            if(!$qry){
                                echo "ADDING FAILED";
                            } else {
                                
                                 echo "<script type='text/javascript'> alert('Item Added successful')</script>";
                            
                            ;?>
                                <script type="text/javascript">window.location='items.php';</script>
                                
                                <?php 
                                
                            }
                        }
                    }

require_once("header.php");
?>


    <!--Main body Content-->
        <div class="space_fixer"></div>
        <div class="container update-form">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                            
                    
                    <ul id="myTab" class="nav nav-tabs">
                    <li class="active">
                    <a href="#today" data-toggle="tab">
                    Today's Sales
                    </a>
                    </li>
                    <li><a href="#product" data-toggle="tab">Group by Product</a></li>
                    <li class="dropdown">
                    <a href="#" id="myTabDrop1" class="dropdown-toggle"
                    data-toggle="dropdown">Filter by
                    <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
                    <li><a href="#date" tabindex="-1" data-toggle="tab">Date</a></li>
                    <li><a href="#ejb" tabindex="-1" data-toggle="tab">Product</a></li>
                    </ul>
                    </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="today">
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
                                            <td>'.$r['priceperunit'].'</td>
                                            <td>'.number_format($r['totalsales'],2).'</td>
                                     </tr>';
                                 }

                                
                                
                            ?>
                                
                            </tbody>
                        </table>
                        <?php echo 'Total Sales  for <strong>' .date('l d/m/Y'). ' is <u> Kshs. ' .number_format($total,2) .'</u> </strong>';?>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="product">
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
                                
                                $date1 = '2015-12-01';
                                $date2 = date('Y-m-d');
                                
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
                                            <td>'.$r['priceperunit'].'</td>
                                            <td>'.number_format($r['totalsales'],2).'</td>
                                     </tr>';   
                                }
                                
                                
                            ?>
                                
                            </tbody>
                        </table>
                        <?php echo 'Total Sales  between ' .$date1. ' and ' .$date2. ' is <strong> <u> Kshs. ' .number_format($total,2) .'</u> </strong>';?>
                    </div>
                    </div>
                        <!-- Filtering data based on date range -->
                    <div class="tab-pane fade" id="date">
                        <form role="form">
                        <div class="container">
                            <div class=""></div><br>
                            <div class="row">
                            <div class="col-md-5 col-sm-12">
                              <div class="input-group">
                                <span class="input-group-addon icon"><i class="glyphicon glyphicon-calendar"></i></span>
                                <input type="text" id="datepicker" name="date1" class="form-control icon" placeholder="From:">
                            </div>
                            </div>
                            <div class="col-md-5 col-sm-12">
                              <div class="input-group">
                                <span class="input-group-addon icon"><i class="glyphicon glyphicon-calendar"></i></span>
                                <input type="text" name="date2" id="datepicker" class="form-control icon" placeholder="To:">
                            </div>
                            </div>
                                <div class="col-md-2 col-sm-12">
                              <div class="form-group">
                                <input type="submit" class="btn blue-btn" value="Search" name="search">
                            </div>
                            </div>
                           </div><br>
                        </div>
                        </form>
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
                                
                                $date1 = '2015-12-01';
                                $date2 = date('Y-m-d');
                                
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
                                            <td>'.$r['priceperunit'].'</td>
                                            <td>'.number_format($r['totalsales'],2).'</td>
                                     </tr>';   
                                }
                                
                                
                            ?>
                                
                            </tbody>
                        </table>
                        <?php echo 'Total Sales  between ' .$date1. ' and ' .$date2. ' is <strong> <u> Kshs. ' .number_format($total,2) .'</u> </strong>';?>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="ejb">
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
                                
                                $date = date('Y-m-d');
                                
                                /*SELECT `sale_id`, `date`, `pid`, `noinstock`, `addstock`, `totalinstock`, `closingstock`, `sales`, `priceperunit`, `totalsales`, `remarks` FROM `sales` WHERE 1*/
                              $sql = "SELECT s.pid,pname,s.totalsales,s.priceperunit,s.sales as sale FROM sales s
                                        INNER JOIN products p ON p.pid = s.pid
                                        WHERE date = '$date' ";  
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
                                            <td>'.$r['priceperunit'].'</td>
                                            <td>'.number_format($r['totalsales'],2).'</td>
                                     </tr>';   
                                }
                                
                                
                            ?>
                                
                            </tbody>
                        </table>
                        <?php echo 'Total Sales  for ' .$date. ' is <strong> <u> Kshs. ' .number_format($total,2) .'</u> </strong>';?>
                    </div>
                    </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
        
    <!--End of Main body Content-->
<?php require_once('footer.php');?>