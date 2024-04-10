<?php

$dsn = "mysql:host=localhost;dbname=bincomphptest";
$dbusername = "root";
$dbpassword = "";

try {

	$pdo = new PDO($dsn, $dbusername, $dbpassword);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	} catch (PDOEXception $e) {

	echo "Connection failed:" . $e->getMessage();
}


	
	$query = "SELECT * FROM polling_unit;";
	$stmt = $pdo->prepare ($query);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);  

	

foreach ($result as $ar) {



	echo "<h2>".$ar['polling_unit_name']."</h2>" ;


	$qu = "SELECT * FROM announced_pu_results WHERE polling_unit_uniqueid = :e;";
	$stt = $pdo->prepare ($qu);
	$stt->bindParam(":e"  ,$ar['uniqueid']);
	$stt->execute();
	$re = $stt->fetchAll(PDO::FETCH_ASSOC);  

	
	foreach ($re as $arr) {

	echo $arr['party_abbreviation'] ." = " . $arr['party_score'] ."<br>";

	}
	
}



?>

