<?php
include 'connect.php';


                $sqlcount = "select count(*) as counted from accounts";
                $rescount = mysqli_query($conn,$sqlcount);
                $rowcount = mysqli_fetch_assoc($rescount);
    
    $_SESSION['CountUsers'] = $rowcount['counted'];

?>