<?php 
require('connection_in.php');
$name=mysqli_real_escape_string($conn,$_POST['name']);
$email=mysqli_real_escape_string($conn,$_POST['email']);
$mobile=mysqli_real_escape_string($conn,$_POST['mobile']);
$password=mysqli_real_escape_string($conn,md5($_POST['password']));
$time=date('y-m-d h:m:s');


$check_email_sql="Select * from users where email='$email'";

$result=mysqli_query($conn,$check_email_sql);

if (mysqli_num_rows($result)>0) {
    echo "present";
# code...
}else{
    echo"wrong";
$sql="INSERT INTO users (Name, Email, Mobile, Password, Add_on) VALUES ('$name', '$email', '$mobile', '$password', '$time')";
mysqli_query($conn,$sql);
echo "Registration Successfully!!";
}

?>