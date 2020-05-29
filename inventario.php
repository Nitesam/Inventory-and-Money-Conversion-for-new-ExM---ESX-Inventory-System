<?php

$host = "INSERT HERE YOUR IP";
$db = "INSERT HERE YOUR DATABASE NAME";
$user = "root"; 
$password = "";

try {
  $connessione = new PDO("mysql:host=$host;dbname=$db", $user, $password);
  $connessione->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $locale = null;
  $stringa = null;
  $check = false;
  $primavolta = true;

	foreach ($connessione->query("SELECT identifier, item, count FROM user_inventory WHERE count > 0 ORDER BY identifier") as $row) {		

		if ($locale == "suca" or $primavolta){
			$locale = $row['identifier'];
			$identificativo = $row['identifier'];
			$check = true; 
			$primavolta = false;

		}

  		if ($row['identifier'] != $locale){
  			echo "</br>";
  			echo "UPDATE users SET inventory = '{".substr($stringa, 0, -1)."}' WHERE identifier = '".$identificativo."';";
  			echo "</br>";
  			$stringa = null;
  			$check = false; 
			$stringa = $stringa . " \"" . $row["item"] . "\": " . $row["count"]. ",";
  			$locale = "suca";
  		}

  		if ($check == true) {

    		$stringa = $stringa . " \"" . $row["item"] . "\": " . $row["count"]. ",";
    	}



    }
  
  $connessione = null;
}
catch(PDOException $e)
{

  echo $e->getMessage();
}
?>