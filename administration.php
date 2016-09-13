<?php 

//including connection file
include ('includes/conn.php');
include 'header.php';

//selecting data from the database
$sql = "Select * from users";
$result = mysqli_query($conn, $sql);
$i = 0;

//adding new record to database
if(isset($_POST['add'])){
                        $fname = $_POST['fname'];
                        $lname = $_POST['lname'];
                        $gender = $_POST['gender'];
                        $phone = $_POST['phone'];
                        $username = $_POST['username'];
                        $password = md5($_POST['password']);
                        
                        if(!$fname or !$lname or !$gender or !$phone or !$username or !$password){
                            echo "<script type='text/javascript'> alert('Fill in the details')</script>";
                        } else {
                            
                            $register = "insert into users (fname, lname, gender, phone, username, password,created_date) values ('$fname', '$lname', '$gender', '$phone', '$username', '$password', '$today')";
                            
                            $qry = mysqli_query($conn, $register);
                            if(!$qry){
                                echo "User registration Failed";
                            } else {
                                
                                 echo "<script type='text/javascript'> alert('User was successfully added')</script>";
                            
                            ;?>
                                <script type="text/javascript">window.location='administration.php';</script>
                                
                                <?php 
                                
                            }
                        }
                    }

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
                                    <th>User ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Gender</th>
                                    <th>Phone No</th>
                                    <th>Username</th>
                                    <th>Password</th>
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
                echo '<input type="text" class="form-control icon" value="'.$abc['uid'].'" name="uid'.$i.'" readonly />';
                echo "</td>";
                
                echo "<td>";
                echo '<input type="text" class="form-control icon" value="'.$abc['fname'].'" name="fname'.$i.'"  />';
                echo "</td>";
                
                echo "<td>";
                echo '<input type="text" class="form-control icon" value="'.$abc['lname'].'" name="lname'.$i.'" />';
                echo "</td>";
                
                echo "<td>";
                echo '<input type="text" class="form-control icon" value="'.$abc['gender'].'" name="gender'.$i.'" />';
                echo "</td>";
                
                echo "<td>";
                echo '<input type="text" class="form-control icon" value="'.$abc['phone'].'" name="phone'.$i.'" />';
                echo "</td>";
                
                echo "<td>";
                echo '<input type="text" class="form-control icon" value="'.$abc['username'].'" name="username'.$i.'" />';
                echo "</td>";
                
                echo "<td>";
                echo '<input type="password" class="form-control icon" value="'.$abc['password'].'" name="password'.$i.'" />';
                echo "</td>";
                
                echo "<td>";
                echo '<input type="submit" class="btn btn-success" value="Update" name="update'.$i.'" />';
                                    
                if (isset($_POST['update'.$i.''])){
                    
                    if(isset($_POST['check'.$i.''])){
                        $uid = $_POST['uid'.$i.''];
                        $fname = $_POST['fname'.$i.''];
                        $lname = $_POST['lname'.$i.''];
                        $gender = $_POST['gender'.$i.''];
                        $phone = $_POST['phone'.$i.''];
                        $username = $_POST['username'.$i.''];
                        $password = md5($_POST['password'.$i.'']);
                        
                        $update = "update users set fname='$fname', lname='$lname', gender='$gender', phone='$phone', username='$username', password='$password' where uid='$uid'";
                        
                        $qry = mysqli_query($conn, $update);
                        if(!$qry){echo "update failed";} else {
                            
                            echo "<script type='text/javascript'> alert('Update successful')</script>";
                            
                            ;?>
                                <script type="text/javascript">window.location='administration.php';</script>
                                
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
                        $username = $_POST['username'.$i.''];
                        
                        $delete = "delete from users where username='$username'";
                        
                        $qry = mysqli_query($conn, $delete);
                        if(!$qry){echo "Failed to delete user";} else {
                           
                            echo "<script type='text/javascript'> alert('User Deleted Successful')</script>";
                            
                            ;?>
                                <script type="text/javascript">window.location='administration.php';</script>
                                
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
                echo '<input type="text" class="form-control icon" name="uid" disabled="true" />';
                echo "</td>";
            
                echo "<td>";
                echo '<input type="text" class="form-control icon" name="fname" />';
                echo "</td>";
            
                echo "<td>";
                echo '<input type="text" class="form-control icon" name="lname" />';
                echo "</td>";
            
                echo "<td>";
                echo '<select name="gender" class="form-control icon">
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                </select>';
                echo "</td>";
                
                echo "<td>";
                echo '<input type="text" class="form-control icon" name="phone" />';
                echo "</td>";
                
                echo "<td>";
                echo '<input type="text" class="form-control icon" name="username" />';
                echo "</td>";
                                
                echo "<td>";
                echo '<input type="text" class="form-control icon" name="password" />';
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