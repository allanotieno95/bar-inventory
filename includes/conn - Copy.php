<?php
//declaring variables for connecting the db
    $servername="localhost";
    $username="root";
    $password="";

//creating the connection
$db_conn = mysqli_connect($servername, $username, $password);

//checking connection status
if($db_conn){
    
    $sql_create_db = mysqli_query($db_conn,"CREATE DATABASE IF NOT EXISTS `sales`;");
    if($sql_create_db)
    {
        $db = "sales";
        $conn = mysqli_connect($servername, $username, $password,$db);
        if(!$conn)
        {
            die("Ooops Cant connect to db");
        }
        $sql_create_table = mysqli_query($conn,"CREATE TABLE `expenses` (
  `exp_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `cost` int(11) NOT NULL,
  `reason_for_expenditure` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
        if($sql_create_table)
        {
            $sql_create_items = mysqli_query($conn,"CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `in_stock` int(11) NOT NULL,
  `price_per_unit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
            if($sql_create_items)
            {
                $sql_create_sales = mysqli_query($conn,"CREATE TABLE `sales` (
  `sale_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `opening_stock` int(11) NOT NULL,
  `add_stock` int(11) NOT NULL,
  `total_in_stock` int(11) NOT NULL,
  `closing_stock` int(11) NOT NULL,
  `total_Sales` int(11) NOT NULL,
  `price_per_unit` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
");
                if($sql_create_sales)
                {
                    $sql_create_users = mysqli_query($conn,"CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `dept` varchar(30) NOT NULL,
  `access_level` int(2) NOT NULL DEFAULT '1',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
                    if($sql_create_users)
                    {
                        $sql_insert = mysqli_query($conn,"INSERT INTO `users` (`uid`, `fname`, `lname`, `uname`, `pass`, `dept`, `access_level`, `timestamp`) VALUES
(1, 'Allan', 'Dhoye', 'allan@astute.co.ke', '79dc89706c6cec3ccf5699302de9144b', 'bar', 0, '2015-11-10 18:34:45'),
(2, 'Solomon', 'Mwanga', 'solomon@astute.co.ke', 'bbdd0e294fd183663ccadb3d3f94dca1', 'bar', 1, '2015-11-10 18:35:59');");
                        if($sql_create_users)
                        {
                            echo "You successfully completed installation";
                        }
                        else
                        {
                            echo "cant insert admin data";
                        }
                    }
                    else
                    {
                        echo "couldnt create table `users`";
                    }
                }
                else
                {
                    echo "couldnt create table `sales`";
                }
                
            }
            else
            {
                echo "Couldnt create table `items`";
            }
        }
        else
        {
            echo "Couldnt Create table `expenses`";
        }
    }
    else
    {
        echo "Oops!Cannot create database".mysqli_error($db_conn);
    }
} else {
    
    echo"error in connection. check the error in the code and try again";
}

?>