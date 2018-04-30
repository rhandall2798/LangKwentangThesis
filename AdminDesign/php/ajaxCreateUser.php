<?php
include 'connect.php';

   if(isset($_POST['username'])){
        $username = $_POST['username'];
    }
    if(isset($_POST['password'])){
        $password = $_POST['password'];
    }
    if(isset($_POST['userlevel'])){
        $userlevel = $_POST['userlevel'];
    }
    if(isset($_POST['status'])){
        $status = $_POST['status'];
    }

     $query_create = "insert into accounts (username,password,user_level,status) values ('$username','$password','$userlevel','$status')";
        mysqli_query($conn,$query_create);

if($query_create){
    echo 1;
}
else
{
    echo 0;
}

    

?>