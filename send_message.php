<?php 
require('connection_in.php');
$name=mysqli_real_escape_string($conn,$_POST['name']);
$email=mysqli_real_escape_string($conn,$_POST['email']);
$mobile=mysqli_real_escape_string($conn,$_POST['mobile']);
$msg=mysqli_real_escape_string($conn,$_POST['msg']);
$time=date('y-m-d h:m:s');


$sql="INSERT INTO contact_us (Name, Email, Mobile, Query, Date) VALUES ('$name', '$email', '$mobile', '$msg', '$time')";
mysqli_query($conn,$sql);
echo "Thank you";


?>