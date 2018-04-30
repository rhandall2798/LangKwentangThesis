<?php
session_start();
require 'connect.php';

if(isset($_SESSION['UserIDmo'])) {
    $complaint_id = $_SESSION['complaint_id'];
    
    $query_get_answers = mysqli_query($conn, "SELECT * FROM comments WHERE post_id = $complaint_id");
    
    if(mysqli_num_rows($query_get_answers)) {
        
        while($row = mysqli_fetch_assoc($query_get_answers)) {

            $comments = $row['comment'];
            $username = $row['username'];
            $date = $row['date'];
    ?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    
  <div class="w3-card-4" style="width:100%;">
    <header class="w3-container w3-blue">
      <h1><?php echo $username ?></h1>
    </header>

    <div class="w3-container">
      <p><?php echo $comments ?></p>
    </div>

    <footer class="w3-container w3-blue">
      <h5><?php echo $date; ?></h5>
    </footer>
  </div>

<br>
<br>
    
    <?php
    }
    } else {
    ?>
    No data available
<?php } ?>
<?php
}
?>