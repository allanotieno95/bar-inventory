<?php
session_start();
$_SESSION['uid'];
$uid = $_SESSION['uid'];

//Connecting to the database
include ('includes/conn.php');

if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
    //login the user and initialize session
}
else
{
    header('location: index.php');
}

//get user details
    $sql = "SELECT * FROM `users` WHERE `uid`='$uid'";
    $qry = mysqli_query($conn, $sql);
    if(mysqli_num_rows($qry) > 0){
    $user = mysqli_fetch_array($qry);
            $username = $user['username'];
            $fname = $user['fname'];
            $lname = $user['lname'];
            $gender = $user['gender'];
            $phone = $user['phone'];
            $password = $user['password'];
            $user_level = $user['user_level'];
            $created_date = $user['created_date'];
        
    }

$today = date("y/m/d");


    
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Sales Management System</title>
    <!--Including css files to the site-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker3.css">
    <!--loading angular js to the web app-->
    <script src= "js/angular.min.js"></script>
    
    <!-- angular script for retriving data from db and performing all the calculations -->
    	<script type="text/javascript">
        var app = angular.module('MyApp', [])
		
        app.controller('MyController', function ($scope, $http) {
			$http.get("http://localhost:8080/bar/includes/get-product-details.php")
			.success(function (response) {$scope.products = response.records;});
			
			$scope.showSelectValue = function(id) {
				$http.get("http://localhost:8080/bar/includes/get-product-details.php?id="+ id)
				.success(function (response) {
					$scope.sales.productinfo = response.records[0];
					$scope.sales.noinstock = $scope.sales.productinfo.noinstock;
					$scope.sales.priceperunit = $scope.sales.productinfo.priceperunit;
					$scope.sales.sales = "";
					$scope.sales.addstock = "";
					$scope.sales.totalinstock = "";
					$scope.sales.closingstock = "";
					$scope.sales.totalsales = "";
				});
			}
			
            //Calculating total in stock and sales
			$scope.calculateTotal = function() {
				noinstock = isNaN($scope.sales.noinstock)? 0 : Number($scope.sales.noinstock);
				addstock = isNaN($scope.sales.addstock)? 0 : ((Number($scope.sales.addstock)<0)? 0 : Number($scope.sales.addstock));
				$scope.sales.totalinstock = noinstock + addstock;
			}
            
            //Calculating No of Sales and revenue
			$scope.calculateSales = function() {
				totalinstock = isNaN($scope.sales.totalinstock)? 0 : Number($scope.sales.totalinstock);
				closingstock = isNaN($scope.sales.closingstock)? 0 : ((Number($scope.sales.closingstock)<0)? 0 : Number($scope.sales.closingstock));
				$scope.sales.sales = totalinstock - closingstock;		
				priceperunit = isNaN($scope.sales.priceperunit)? 0 : Number($scope.sales.priceperunit);
                sales = isNaN($scope.sales.sales)? 0 : Number($scope.sales.sales);
                $scope.sales.totalsales = sales * priceperunit;				
			}
            
            // create a blank object to handle form data.
            
            //submit function
            $scope.submitForm = function() {
                
            // Posting data to php file
            $http({
              method  : 'POST',
              url     : 'includes/post.php',
              data    : $scope.sales, //forms sales object
              headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
             })
              .success(function(data) {
                if (data.errors) {
                  // Showing errors.
                  $scope.errorItemDate = data.errors.item_date;
                  $scope.errorPName = data.errors.pname;
                  $scope.errorNoinStock = data.errors.noinstock;
                  $scope.errorAddStock = data.errors.addstock;
                  $scope.errorTotalinStock = data.errors.totalinstock;
                  $scope.errorClosingStock = data.errors.closingstock;
                  $scope.errorSales = data.errors.sales;
                  $scope.errorPricePerUnit = data.errors.priceperunit;
                  $scope.errorTotalSales = data.errors.totalsales;
                  $scope.errorRemarks = data.errors.remarks;
                } else {
                  $scope.message = data.message;
                  $scope.errorItemDate = "";
                  $scope.errorPName = "";
                  $scope.errorNoinStock = "";
                  $scope.errorAddStock = "";
                  $scope.errorTotalinStock = "";
                  $scope.errorClosingStock = "";
                  $scope.errorSales = "";
                  $scope.errorPricePerUnit = "";
                  $scope.errorTotalSales = "";
                  $scope.errorRemarks = "";

                  swal({
                      title: "Congrats!",
                      text: "Record Successfully updated",
                      imageUrl: "http://t4t5.github.io/sweetalert/example/images/thumbs-up.jpg"
                    });
                  $scope.sales = "";
                }
              }); 
                
            };
            
            
        });
    </script>
        
        
    </head>
    <body>
        <!--Navbar -->
		<nav class="navbar navbar-inverse navbar-fixed-top" id="my-navbar" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="dashboard.php" class="navbar-brand"><b class="glyphicon glyphicon-home"></b> Dashboard</a>
				</div><!--Navbar Header-->
                <div id="navbar" class="navbar-collapse collapse">
                  <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Hi, <?php echo $username ;?> </a></li>
                    <li><a href="dashboard.php">Update Sales</a></li>
                    <?php 
                          if($user_level == 0){
                              echo '
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">View Sales <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                            <li><a href="dailysales.php"><span class="glyphicon glyphicon-shopping-cart"></span> Today\'s Sales</a></li>
                            <li><a href="salesbydate.php"><span class="glyphicon glyphicon-calendar"></span> Filter by Date</a></li>
                            <li><a href="salesbyproduct.php"><span class="glyphicon glyphicon-glass"></span> Group by Product</a></li>
                            <li><a href="allsales.php"><span class="glyphicon glyphicon-usd"></span> All Sales</a></li>
                        </ul>
                    </li>
                              ';
                          }
                          else
                          {
                              
                          } ?> 
                    
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Expenses <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="update-expenses.php"><span class="glyphicon glyphicon-info-sign"></span> Update Expenses</a></li>
                        <?php 
                          if($user_level == 0){
                              echo '<li><a href="view-expenses.php"><span class="glyphicon glyphicon-blackboard"></span> View Expenses</a></li>';
                          }
                          else
                          {
                              
                          } ?> 
                      </ul>
                    </li>
                    <?php 
                          if($user_level == 0){
                              echo '<li><a href="items.php">Update Items</a></li>';
                          }
                          else
                          {
                              
                          } ?> 
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> My Profile</a></li>
                        <?php 
                          if($user_level == 0){
                              echo '<li><a href="administration.php"><span class="glyphicon glyphicon-cog"></span> Administration</a></li>';
                          }
                          else
                          {
                              
                          } ?>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
                      </ul>
                    </li>
                    
                  </ul>
				</div><!--/.nav-collapse -->
                
			</div><!--End Container-->
		</nav><!--End navbar-->