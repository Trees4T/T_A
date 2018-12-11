<?php
######## LOCAL ########
$host 		= 'localhost';
$user			= 'root';
$pass 		= '';
$database = '';


try{
	$conn = new PDO ("mysql:host=$host;dbname=$database", $user, $pass);

		//echo "Connected!";
	}catch(PDOException $e){
		echo $e->getMessage();
	}
?>
