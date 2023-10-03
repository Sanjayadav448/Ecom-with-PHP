<?php

require('connection_in.php');

unset($_SESSION['User_login']);
unset($_SESSION['id']);
unset($_SESSION['Name']);
header('Location:index.php');
die();
?>