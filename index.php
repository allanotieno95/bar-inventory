<?php @ob_start();
session_start();
error_reporting(E_ALL);
require 'includes/conn.php';
$message = "";
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    
    
    if(!$username or !$password){
        $message = "<div class='alert alert-danger'>Please fill all the fields before continuing</div>";
    }
    else
    {
        $sql = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password' ";
        $qry = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($qry) > 0){
            $message = "<div class='alert alert-success'>User was found in the db</div>";
            
           // foreach ($qry as $user){
               // $uid = $user['uid'];
               //$_SESSION['uid'] = $uid;
           // }
            while ($obj = mysqli_fetch_array($qry)) {
       		 $_SESSION['uid'] = $obj['uid'];
    		}
            header('Location: dashboard.php');
        }
        else
        {
            $message = "<div class='alert alert-danger'>Username or Password incorrect. Please try again</div>";
        }
    }
}




?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Sales Management System</title>
    <!--Including css files to the site-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
     
        
    </head>
    <body>
        <div class="container-fluid login-form" id="login-form">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h3>Login</h3>
                    <form method="post" action=" <?php echo $_SERVER['PHP_SELF']; ?> ">
                        <?php echo $message ;?>
                        <div class="input-group">
                            <span class="input-group-addon icon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" name="username" class="form-control icon" placeholder="Username" maxlength="20">
                        </div><br><!--
                        <div class="input-group">
                            <span class="input-group-addon icon"><i class="glyphicon glyphicon-briefcase"></i></span>
                            <select name="department" class="form-control icon">
                                <option value="Department">Department</option>
                                <option value="Bar">Bar</option>
                                <option value="CarWash">Car Wash</option>
                            </select>
                        </div><br> -->
                        <div class="input-group">
                            <span class="input-group-addon icon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" name="password" class="form-control icon" placeholder="Password" maxlength="35">
                        </div><br>
                        <div class="form-group">
                            <input type="submit" class="btn login-btn" style="color:#ffffff;" name="submit" value="Login">
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="container-fluid">
            <footer class="footer">
                <p>Powered by <a href="# target="_blank">Me</a></p>
            </footer>
        </div>
        
    <!--Including javascript files to the site-->
    <script type="text/javascript" src="js/sweetalert.min.js"></script>
	<script type="text/javascript" src="js/jquery.1.11.1.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/test.js"></script>
    </body>
</html>