<?php 
//including the header file
include 'header.php' ;

//updating user info
$message = "";
if(isset($_POST['update'])){
    $phone = $_POST['phone'];
    $password = md5($_POST['password']);
    $confirmpass = md5($_POST['confirmpass']);
    
    if(!$phone or !$password or !$confirmpass){
       $message = '<div class="alert alert-danger">Please fill in all the fields before proceeding.</div>'; 
    }
    else
    {
        if($password != $confirmpass){
            $message = '<div class="alert alert-danger">Your Passwords do not match.</div>';
        }
        else
        {
            $update = "UPDATE `users` SET `phone` = '$phone', `password` = '$password' WHERE `uid` = '$uid' ";
            $qry = mysqli_query($conn, $update);
            if($qry){
                $message = '<div class="alert alert-success">Your profile has been update successfully.</div>';
            }
            else
            {
                $message = '<div class="alert alert-danger">Error while updating your profile. Please try again.</div>';
            }
        }
    }
}



?>
    <!--Main body Content-->
        <div class="container main-body">
            <div class="row">
                <div class="col-md-12">
                   <form role="form" method="post">
                       
                       <div class="container">
                           <h4>Update your info below:</h4>
                       <div class="row">
                        <?php echo $message ;?>
                        <div class="col-md-6 col-sm-12">
                          <div class="input-group">
                            <span class="input-group-addon icon"><i class="glyphicon glyphicon-calendar"></i></span>
                            <input type="text" name="created_date" class="form-control icon" placeholder="Registered Date" value="Date Created: <?php echo $created_date ;?>" readonly>
                        </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <div class="input-group">
                            <span class="input-group-addon icon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" name="fname" class="form-control icon" placeholder="Firstname" value="First Name: <?php echo $fname ;?>" readonly>
                        </div>
                        </div>
                       </div><br>
                        
                       <div class="row">
                        <div class="col-md-6 col-sm-12">
                          <div class="input-group">
                            <span class="input-group-addon icon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" name="lname" class="form-control icon" placeholder="Last name" value="Last Name: <?php echo $lname ;?>" readonly>
                        </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <div class="input-group">
                            <span class="input-group-addon icon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" class="form-control icon" name="username" placeholder="Username" value="Username: <?php echo $username ;?>" readonly>
                        </div>
                        </div>
                       </div><br>
                       
                       <div class="row">
                        <div class="col-md-6 col-sm-12">
                          <div class="input-group">
                            <span class="input-group-addon icon"><i class="glyphicon glyphicon-question-sign"></i></span>
                            <input type="text" name="gender" class="form-control icon" placeholder="Gender" value="Gender: <?php echo $gender ;?>" readonly>
                        </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <div class="input-group">
                            <span class="input-group-addon icon"><i class="glyphicon glyphicon-phone"></i></span>
                            <input type="text" name="phone" class="form-control icon" placeholder="Phone No" value="<?php echo $phone ;?>">
                        </div>
                        </div>
                       </div><br>
                       
                       <div class="row">
                        <div class="col-md-6 col-sm-12">
                          <div class="input-group">
                            <span class="input-group-addon icon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" name="password" class="form-control icon" placeholder="Password" value="<?php echo $password ;?>" >
                        </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <div class="input-group">
                            <span class="input-group-addon icon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" name="confirmpass" class="form-control icon" placeholder="Confirm Password">
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