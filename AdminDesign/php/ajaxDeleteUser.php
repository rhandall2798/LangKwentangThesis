<?php
require 'connect.php';

if(isset($_POST['userid'])) {
    
    $userid = $_POST['userid'];
    
    $query_delete = mysqli_query($conn, "DELETE FROM accounts WHERE id = $userid");
    
    if($query_delete) {
        
        echo 1;
    } else {
        
        echo 0;
    }
}
?>