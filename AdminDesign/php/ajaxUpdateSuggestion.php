<?php
require 'connect.php';

if(isset($_POST['userid'])) {
    
    $userid = $_POST['userid'];
    $status = "Solved"
    $query_delete = mysqli_query($conn, "update suggestions set status = '$status' WHERE id = $userid");
    
    if($query_delete) {
        
        echo 1;
    } else {
        
        echo 0;
    }
}
?>