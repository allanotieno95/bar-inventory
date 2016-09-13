<?php
//initiating session

//connecting to database

    include ('includes/conn.php');
    $today = date("y/m/d");

//posting info to the expenses table
    if(isset($_POST['update'])){
        $exp_date = $_POST['exp_date'];
        $expenses = $_POST['expenses'];
        $reason_for_expenditure = $_POST['reason_for_expenditure'];
        
        if(!$exp_date or !$expenses or !$reason_for_expenditure){
            echo "<script type='text/javascript'>alert('Fill in all the blanks before proceeding')</script>";
        } else {
           //selecting records from the database
            $try = "SELECT * FROM expenses WHERE exp_date = '$exp_date'";
            $result = mysqli_query($conn, $try);
            if($result){
                if(mysqli_num_rows($result) > 0){
                    echo "<script type='text/javascript'>alert('Unable to update the record because a similar entry for today already exists in the database')</script>";
                } else {
                    //update data to the database
                    $sql = "INSERT INTO expenses(exp_date, expenses, reason_for_expenditure)VALUES('$exp_date','$expenses','$reason_for_expenditure')";
                    $qry = mysqli_query($conn, $sql);
            
                    if(!$qry){
                    echo "<script type='text/javascript'>alert('Error while updating expenses')</script>";
                    } else{
                
                    echo "<script type='text/javascript'> alert('Updated Successful')</script>";
                            ;?>
                                <script type="text/javascript">window.location='update-expenses.php';</script>
                                
                                <?php 
                        
                    }
                }
                
            }
                    
        }
        
    } 
 

?>

<?php include 'header.php' ; ?>
    <!--Main body Content-->
        <div class="container main-body">
            <div class="row">
                <div class="col-md-12">
                   <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                       <div class="container">
                       <div class="row">
                        <div class="col-md-6 col-sm-12">
                          <div class="input-group">
                            <span class="input-group-addon icon"><i class="glyphicon glyphicon-calendar"></i></span>
                            <input type="text" name="exp_date" class="form-control icon"  placeholder="Date" value=" <?php echo "$today" ;?>" readonly>
                        </div> 
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <div class="input-group">
                            <span class="input-group-addon icon"><i class="glyphicon glyphicon-usd"></i></span>
                            <input type="text" name="expenses" class="form-control icon" placeholder="Total Expenses">
                        </div> 
                        </div>
                       </div><br>
                        
                       <div class="row">
                        <div class="col-md-12 col-sm-12">
                          <div class="input-group">
                            <span class="input-group-addon icon"><i class="glyphicon glyphicon-blackboard"></i></span>
                              <textarea type="text" name="reason_for_expenditure" class="form-control icon" placeholder="Reason for expenditure" rows="5"></textarea>
                        </div> 
                        </div>
                       </div><br>
                           <div class="form-group">
                            <input type="submit" class="btn blue-btn" value="Update" name="update">
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>  
    <!--End of Naun body Content-->
    <!--Including the footer-->
    <?php require_once('footer.php');?>