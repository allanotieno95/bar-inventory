<?php
//declaring variables for connecting the db
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="app";

//creating the connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

//checking connection status
if($conn){
    // script for creating database if it does not exist
    
} else {
    
    echo "error in connection. check the error in the code and try again";
}

?>