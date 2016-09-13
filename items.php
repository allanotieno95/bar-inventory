<?php 

//including connection file
include ('includes/conn.php');

//selecting data from the database
$sql = "Select * from products WHERE `status`='1' ";
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
include 'header.php';
?>

    <!--Main body Content-->
        <div class="space_fixer"></div>
        <div class="container update-form">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="table-responsive">
                        <table class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Item ID</th>
                                    <th>Item Name</th>
                                    <th>No in Stock</th>
                                    <th>Unit Price</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                    <th>Check</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($abc = mysqli_fetch_array($result) ){
                echo "<tr>";
                echo "<td>";
                echo '<input type="text" class="form-control icon" value="'.$abc['pid'].'" name="pid'.$i.'" readonly />';
                echo "</td>";
                
                echo "<td>";
                echo '<input type="text" class="form-control icon" value="'.$abc['pname'].'" name="pname'.$i.'"  />';
                echo "</td>";
                
                echo "<td>";
                echo '<input type="text" class="form-control icon" value="'.$abc['noinstock'].'" name="noinstock'.$i.'" />';
                echo "</td>";
                
                echo "<td>";
                echo '<input type="text" class="form-control icon" value="'.$abc['priceperunit'].'" name="priceperunit'.$i.'" />';
                echo "</td>";
                
                echo "<td>";
                echo '<input type="submit" class="btn btn-success" value="Update" name="update'.$i.'" />';
                                    
                if (isset($_POST['update'.$i.''])){
                    
                    if(isset($_POST['check'.$i.''])){
                        $pid = $_POST['pid'.$i.''];
                        $pname = $_POST['pname'.$i.''];
                        $noinstock = $_POST['noinstock'.$i.''];
                        $priceperunit = $_POST['priceperunit'.$i.''];
                        
                        $update = "update products set pname='$pname', noinstock='$noinstock', priceperunit='$priceperunit' where pid='$pid'";
                        
                        $qry = mysqli_query($conn, $update);
                        if(!$qry){echo "update failed";} else {
                            
                            echo "<script type='text/javascript'> alert('Update successful')</script>";
                            
                            ;?>
                                <script type="text/javascript">window.location='items.php';</script>
                                
                                <?php 
                            
                        }
                    } else {
                        echo "<script type='text/javascript'> alert('Please select the checkbox before proceeding')</script>";
                    }
                }                    
                                    
                echo "</td>";
                
                echo "<td>";
                echo '<input type="submit" value="Delete" class="btn btn-danger" name="delete'.$i.'" />';
                                    
                if (isset($_POST['delete'.$i.''])){
                    
                    if(isset($_POST['check'.$i.''])){
                        $pname = $_POST['pname'.$i.''];
                        
                        $delete = "UPDATE `products` SET `status`='0' WHERE pname='$pname'";
                        
                        $qry = mysqli_query($conn, $delete);
                        if(!$qry){echo "Delete failed";} else {
                           
                            echo "<script type='text/javascript'> alert('Item Deleted Successful')</script>";
                            
                            ;?>
                                <script type="text/javascript">window.location='items.php';</script>
                                
                                <?php 
                            
                        }
                    } else {
                        echo "<script type='text/javascript'> alert('Please select the checkbox before proceeding')</script>";
                    }
                }
                                    
                echo "</td>";
                                    
                echo "<td>";
                echo '<input type="checkbox" class="form-control icon" name="check'.$i.'" />';
                echo "</td>";

                echo "</tr>";
                                   
                $i++;
                                
                                }
                                
                echo "<tr>";
                echo "<td>";
                echo '<input type="text" class="form-control icon" name="pid" disabled="true" />';
                echo "</td>";
            
                echo "<td>";
                echo '<input type="text" class="form-control icon" name="pname" />';
                echo "</td>";
            
                echo "<td>";
                echo '<input type="text" class="form-control icon" name="noinstock" />';
                echo "</td>";
            
                echo "<td>";
                echo '<input type="text" class="form-control icon" name="priceperunit" />';
                echo "</td>";
            
                echo "<td>";
                echo '<input type="submit" class="btn btn-success" value="+ Add" name="add" />';
                    
                echo "</td>";
            
                echo "</tr>";
                                ?>
                   
                                
                            </tbody>
                        </table>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        
    <!--End of Main body Content-->
    <!--Including the footer-->
    <?php require_once('footer.php');?>