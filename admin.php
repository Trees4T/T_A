<?php
date_default_timezone_set('Asia/Jakarta');
// memulai session
session_start();
error_reporting(0);
if (isset($_SESSION['levels']))
{
	// jika level admin
	if ($_SESSION['levels'] == "adm")
   {
   }
   elseif ($_SESSION['levels'] == "mkt" ) {

   }
   // jika kondisi level user maka akan diarahkan ke halaman lain
   else
   {
       header('location:login/');
   }
}
if (!isset($_SESSION['levels']))
{
	header('location:login/');
}

include 'layout-header.php';
include 'layout-sidebar-content-footer.php';
include 'layout-js.php';



 ?>
