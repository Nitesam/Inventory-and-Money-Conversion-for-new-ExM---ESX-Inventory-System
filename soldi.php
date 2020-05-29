<?php

$host = "INSERT HERE YOUR IP";
$db = "INSERT HERE YOUR DATABASE NAME";
$user = "root"; 
$password = "";

try {
  $connessione = new PDO("mysql:host=$host;dbname=$db", $user, $password);
  $connessione->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stringa = null;
  $i = 0;
	foreach ($connessione->query("SELECT identifier, money, bank FROM users ORDER BY identifier") as $row) {		
  		if ($row['identifier'] != "" && $row['identifier'] != "(Null)"){
  			echo "</br>";
        $banca = $row['bank'];
        $denaro = $row['money'];
        $stringa = '"bank":'. $banca .',"money":'. $denaro .',"black_money":0';
  			echo "UPDATE users SET accounts = '{". $stringa ."}' WHERE identifier = '".$row['identifier']."';";
  			$stringa = null;
        $i++;
    }
  }
  echo "</br>";
  echo "</br>";
  echo "</br>";
  echo "</br>";
  echo "Vi sono ".$i." stronzi";
  
  $connessione = null;
}
catch(PDOException $e)
{

  echo $e->getMessage();
}
?>