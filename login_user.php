<?php

require('connection_in.php');
    $email = mysqli_real_escape_string($conn,$_POST["email"]);
    $password = mysqli_real_escape_string($conn,md5($_POST["password"]));
    $login_sql="Select * from users where email='$email' and password='$password'";
    $result=mysqli_query($conn , $login_sql);
    $rowcount=mysqli_num_rows( $result );
    if ($rowcount>0) {
        echo "correct";
        $_SESSION['User_login']=true;
        $login_row=mysqli_fetch_assoc($result);
        $_SESSION['User_detail']=$login_row;
        $_SESSION['id']=$login_row['id'];
        $_SESSION['name']=$login_row['Name'];
        die();
        # code...
    }else{
        echo "wrong";
    }

?>