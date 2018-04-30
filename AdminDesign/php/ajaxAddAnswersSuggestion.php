<?php
session_start();
require 'connect.php';

if(isset($_SESSION['UserIDmo'])) {
    
    if(isset($_POST['suggestion_id']) && isset($_POST['user_level']) && isset($_POST['userid']) && isset($_POST['myanswer'])) {
        
        $suggestion_id = $_POST['suggestion_id'];
        $user_level = $_POST['user_level'];
        $userid = $_POST['userid'];
        $myanswer = $_POST['myanswer'];
        
        $query_get_username = mysqli_query($conn, "SELECT username FROM accounts WHERE id = $_SESSION[UserIDmo]");
        $row = mysqli_fetch_assoc($query_get_username);
        
        $username = $row['username'];
        $date = date('F j, Y g:i:a  ');
        
        $query_add_answer = mysqli_query($conn, "INSERT INTO suggestioncomment(post_id, userid, comment, user_level, username,date) 
        VALUES($suggestion_id, $userid, '$myanswer', $user_level, '$username','$date')");
        
        if($query_add_answer) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
?>