<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "../koneksi/koneksi.php";

if(empty($_SESSION["username"]) )
	{
	header('Location:login/');
	die();
	}

?>
