<?php
session_start();
unset($_SESSION["usernames"]);
unset($_SESSION['levels']);

header('location:../login/');

?>
