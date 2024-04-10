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


 if ($_SERVER["REQUEST_METHOD" ] === "POST"){  
     
     
     
     if (!empty($_POST["lga"]) && !empty($_POST["party"]) && !empty($_POST["re"])) {
    
        
        $lg =$_POST["lga"];
        $pa= $_POST["party"];
        $r = $_POST["re"];
        $i = "192.168.1.101";
         
         
 
        $qy = "INSERT INTO announced_pu_results (polling_unit_uniqueid, party_abbreviation, party_score,user_ip_address) VALUES(:pid, :pa, :ps, :ui);";

        $s = $pdo->prepare($qy);
        $s->bindParam(":pid", $lg);
        $s->bindParam(":pa", $pa);
        $s->bindParam(":ps", $r);
        $s->bindParam(":ui", $i);
        $s->execute();
        
        echo "record save"






         
         
         
         
         
         
         
         
     }else {
         echo("All form is required");
     }
     
     
     
 }





    $query = "SELECT * FROM lga;";
	$stmt = $pdo->prepare ($query);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);  
	
	$qu = "SELECT * FROM party;";
	$smt = $pdo->prepare ($qu);
	$smt->execute();
	$re = $smt->fetchAll(PDO::FETCH_ASSOC);  


?>


<form action="" method="POST">
   lga 
   
   <select name="lga">

    

    
    <option value="">selectlocal government</option>
    
    <?php
        foreach ($result as $ar) {?>
        
            <option value=" <?php echo $ar['lga_id']?>"> <?php echo $ar['lga_name'] ?> </option>
            <?php
        }
    ?>

</select >
   
   
   party
   
   <select name="party">
   
   <option value="">select party</option>
    
    <?php
        foreach ($re as $arr) {?>
        
            <option value=" <?php echo $arr['partyid']?>"> <?php echo $arr['partyname'] ?> </option>
            <?php
        }
    ?>
   
   
   </select>
  Result  <input type="text" name="re"/>

    <button>upload</button>
</form>