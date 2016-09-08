<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include ('conn.php');

$pid=isset($_GET['id'])? $_GET['id'] : null;


if($pid)
{
	$result = $conn->query("SELECT `pid`, `pname`, `noinstock`, `priceperunit` FROM `products` WHERE pid='$pid' AND `status`='1' ");	
}
else{
	$result = $conn->query("SELECT `pid`, `pname`, `noinstock`, `priceperunit` FROM `products` WHERE `status`='1' ");
}

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
		if ($outp != "") {$outp .= ",";}
		$outp .= '{"pid":"'  . $rs["pid"] . '",';        
		$outp .= '"pname":"'  . $rs["pname"] . '",';    		
		$outp .= '"priceperunit":"'  . $rs["priceperunit"] . '",';  
		$outp .= '"noinstock":"'. $rs["noinstock"]     . '"}';
}
	
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);
?> 