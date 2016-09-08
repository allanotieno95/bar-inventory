<?php
$errors = array();
$data = array();

$today = date("y/m/d");

// Getting posted data and decodeing json
$_POST = json_decode(file_get_contents('php://input'), true);

// connecting to the database
include ('conn.php');


// checking for blank values.
//if (empty($_POST['item_date']))
 // $errors['item_date'] = 'Date is required.';

//if (empty($_POST['pname']))
 // $errors['pname'] = 'Product name is required.';

if (empty($_POST['noinstock']))
  $errors['noinstock'] = 'No in Stock is required.';
/*
if (empty($_POST['addstock']))
  $errors['addstock'] = 'Add Stock is required.'; */

if (empty($_POST['totalinstock']))
  $errors['totalinstock'] = 'Total in Stock is required.';
/*
if (empty($_POST['closingstock']))
  $errors['closingstock'] = 'Closing Stock is required.'; */

if (empty($_POST['sales']))
  $errors['sales'] = 'Sales is required.';

if (empty($_POST['priceperunit']))
  $errors['priceperunit'] = 'Price per unit is required.';

if (empty($_POST['totalsales']))
  $errors['totalsales'] = 'Total Sales is required.';

if (empty($_POST['remarks']))
  $errors['remarks'] = 'Remarks is required.';

if (!empty($errors)) {
  $data['errors']  = $errors;
  
} else {
  $data['message'] = 'Form data is going well';
  
  //inserting data into the database
    
    $item_date = $today;
	$pid = $_POST['pname'];
    $noinstock = $_POST['noinstock'];
    $addstock = $_POST['addstock'];
    $totalinstock = $_POST['totalinstock'];
    $closingstock = $_POST['closingstock'];
    $sales = $_POST['sales'];
    $priceperunit = $_POST['priceperunit'];
    $totalsales = $_POST['totalsales'];
    $remarks = $_POST['remarks'];

//confirm if the user had posted earlier in the database to prevent double entry of records for the same product in a day
  $try = "SELECT * FROM products where pid = 'pid' and update_date ='$update_date'";
  $result = mysqli_query($conn,$try);
  if($result){
    //check if there is an update already for the day
    if(mysqli_num_rows($result) >0){
      //don't update database to prevent double updates
    }else{
      //update the database 
    }

  }else{
    //update the database
  }
  
//inserting data into the sales table
  $query = "INSERT into sales(date, pid, noinstock, addstock, totalinstock, closingstock, sales, priceperunit, totalsales, remarks) VALUES ('$item_date', '$pid', '$noinstock', '$addstock', '$totalinstock', '$closingstock', '$sales', '$priceperunit', '$totalsales', '$remarks')";
  
  //update the products table
	$sql = "UPDATE products SET noinstock ='$closingstock', update_date='$item_date' WHERE pid = '$pid'";
  
  if(mysqli_query($conn, $query)) {
	mysqli_query($conn, $sql);
  } else {
	  echo "error while adding data";
  }
}
// response back.
echo json_encode($data);
?>
