<?php
//per drinks sold 
                                $date1 = '2015-12-01';
                                $date2 = date('Y-m-d');
                                
                                /*$sql = "SELECT s.pid,pname,s.totalsales,s.priceperunit,s.sales as sale FROM sales s
                                        INNER JOIN products p ON p.pid = s.pid
                                        WHERE date >= '$date1' AND date <= '$date2'  ";*/
                              $sql = "SELECT s.pid,pname,s.totalsales,s.priceperunit,s.sales as sale FROM sales s
                                        INNER JOIN products p ON p.pid = s.pid
                                        WHERE date = '$date2'  ";  
                               $total  = 0;
                                $i = 0;
                                $row  =array();
                                $result = mysqli_query($conn, $sql);
                                 while ($r = mysqli_fetch_array($result) ){
                                     
                                     /*if(!array_key_exists($r['pid'],$row)){
                                         $row[$r['pid']] = $r;
                                     }else{
                                         $row[$r['pid']]['sale'] += $r['sale'];
                                        // $row[$r['pid']]['totalsales'] += $r['totalsales'];
                                         $row[$r['pid']]['totalsales'] += $r['totalsales'];
                                     }*/
                                      echo '<tr>
                                            <td>'.$i.'</td>
                                            <td>'.$r['pname'].'</td>
                                            
                                            <td>'.$r['sale'].'</td>
                                            <td>'.$r['priceperunit'].'</td>
                                            <td>'.number_format($r['totalsales'],2).'</td>
                                     </tr>'; 
                                     
                                     $total += $r['totalsales'];
                                     
                                }
                                
                               /* foreach($row as $r)
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
                                }*/

                                
                                
                            ?>

//drinks sold with time range and their totals..

<?php
                                $date1 = '2015-12-01';
                                $date2 = date('Y-m-d');
                                
                                /*SELECT `sale_id`, `date`, `pid`, `noinstock`, `addstock`, `totalinstock`, `closingstock`, `sales`, `priceperunit`, `totalsales`, `remarks` FROM `sales` WHERE 1*/
                              $sql = "SELECT s.pid,pname,s.totalsales,s.priceperunit,s.sales as sale FROM sales s
                                        INNER JOIN products p ON p.pid = s.pid
                                        WHERE date >= '$date1' AND date <= '$date2'  ";  
                               $total  = 0;
                                $i = 0;
                                $row  =array();
                                $result = mysqli_query($conn, $sql);
                                 while ($r = mysqli_fetch_array($result) ){
                                     
                                     if(!array_key_exists($r['pid'],$row)){
                                         $row[$r['pid']] = $r;
                                     }else{
                                         $row[$r['pid']]['sale'] += $r['sale'];
                                         $row[$r['pid']]['totalsales'] += $r['totalsales'];
                                         $row[$r['pid']]['totalsales'] += $r['totalsales'];
                                     }
                                     
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
    
//showing sales per day..

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
                                




