<?php
######## LOCAL ########
$host 		= '';
$user			= '';
$pass 		= '';
$database = '';
$port 		= '';


try{
	$conn = new PDO ("mysql:host=$host;port=$port;dbname=$database", $user, $pass);

		//echo "Connected!";
	}catch(PDOException $e){
		echo $e->getMessage();
	}
?>
