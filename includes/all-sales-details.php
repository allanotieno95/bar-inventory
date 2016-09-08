<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include ('conn.php');

/*$pid=isset($_GET['id'])? $_GET['id'] : null;


if($pid)
{
	$result = $conn->query("SELECT `pid`, `pname`, `noinstock`, `priceperunit` FROM `products` WHERE pid='$pid' ");	
}
else{
	$result = $conn->query("SELECT `pid`, `pname`, `noinstock`, `priceperunit` FROM `products`");
} */

 $sql = "SELECT `sales`.`date`, `sales`.`sales`, `sales`.`priceperunit`, `sales`.`totalsales`, `products`.`pname` from sales JOIN `products` ON `sales`.`pid` = `products`.`pid` ORDER BY `sales`.`date` DESC";
$result = mysqli_query($conn, $sql);

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
		if ($outp != "") {$outp .= "";}
		$outp .= ''  . $rs["date"] . ';';        
		$outp .= ''  . $rs["pname"] . ';';
        $outp .= ''  . $rs["sales"] . ';'; 
		$outp .= ''  . $rs["priceperunit"] . ';';  
		$outp .= ''  . $rs["totalsales"]     . ';';
}
	
$outp =$outp;
$conn->close();

echo($outp);
?> 