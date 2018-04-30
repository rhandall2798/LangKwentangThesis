<?php
session_start();
include("connect.php");
 
// check request
if(isset($_POST))
{
    // get values
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userlevel = $_POST['userlevel'];
    $status = $_POST['status'];
 
    // Updaste User details
    $query = "UPDATE accounts SET username = '$username', password = '$password', user_level = '$userlevel', status='$status' WHERE id = '$id'";
    if (!$result = mysqli_query($conn, $query)) {
        exit(mysqli_error($conn));
    }else{
        echo 1;
    }
}
?>