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

	

	$query = "SELECT * FROM lga;";

	$stmt = $pdo->prepare ($query);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);  


?>

<form action="" method="POST">
<select name="lga">
    
    
    <option value="">selectlocal government</option>
    
    <?php
        foreach ($result as $ar) {?>
        
            <option value=" <?php echo $ar['lga_id']?>"> <?php echo $ar['lga_name'] ?> </option>
            <?php
        }
    ?>

</select>
<button> Submit </button>

</form>


<?php

if ($_SERVER["REQUEST_METHOD" ] === "POST") {

    if (!empty($_POST["lga"])) {
        
        $lga = $_POST["lga"];
    

    
    $f = (int) $lga ;
    
    
    

	$qu = "SELECT SUM(party_score) FROM announced_pu_results WHERE polling_unit_uniqueid = :e;";
	$stt = $pdo->prepare ($qu);
	$stt->bindParam(":e"  , $f);
	$stt->execute();
	$re = $stt->fetch(PDO::FETCH_ASSOC); 
	
	if (!empty($re["SUM(party_score)"])) {
	    
	    echo($re["SUM(party_score)"]);
	    
	}else {
	    echo("No record");
	}
	

    }else {
        echo("Please select an option");
    }
}



?>
