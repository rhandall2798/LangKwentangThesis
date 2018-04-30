<?php
include 'connect.php';

if(isset($_POST)){
    
    $population = $_POST['population'];

$query_update = "update population set countpopulation='$population'";

mysqli_query($conn,$query_update);
}
?>