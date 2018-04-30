<?php
// include Database connection file
session_start();
include("connect.php");
 
// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // get User ID
    $user_id = $_POST['id'];
 
    // Get User Details
    $query = mysqli_query($conn, "SELECT * FROM accounts WHERE id = '$user_id'");
    
    $response = array();
    if(mysqli_num_rows($query) > 0) {
        while($row = mysqli_fetch_assoc($query)) {
            $response = $row;
        }
    } else {
        $response['stats'] = 200;
        $response['message'] = 'No data found!';
    }
    
    echo json_encode($response);
} else {
    
    $response['stats'] = 200;
    $response['message'] = 'Invalid request';
    
}