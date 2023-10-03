<?php 
session_start();

unset($_SESSION['Admin_login']);
unset($_SESSION["Admin_username"]);
header("location:login.php");


die();


?>