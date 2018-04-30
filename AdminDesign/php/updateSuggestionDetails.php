<?php
session_start();
include("connect.php");
 
// check request
if(isset($_POST))
{
    // get values
    $id = $_POST['id'];
    $subject = $_POST['subject'];
    $suggestion = $_POST['suggestion'];
    $status = $_POST['status'];
 
    // Updaste User details
    $query = "UPDATE suggestions SET subject = '$subject', suggestion = '$suggestion', status = '$status' WHERE id = '$id'";
    if (!$result = mysqli_query($conn, $query)) {
        exit(mysqli_error($conn));
    }else{
        echo 1;
    }
}
?>