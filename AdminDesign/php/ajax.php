<?php
session_start();
include 'connect.php';

?>

<table id="myTable" class="table table-hover table-bordered" >					
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>									
            <th>Password</th>
            <th>User Level</th>								
            <th>Active</th>
            <th>Option</th>
        </tr>

    </thead>
    <tbody>
        <tr>
        <?php
            
        $idadmin = 3;
        $query_data = mysqli_query($conn, "SELECT * FROM accounts where user_level!='$idadmin'");

            while($row = mysqli_fetch_assoc($query_data)) {
                //fetch the rows for me please.
                $userid = $row['id'];
                $username = $row['username'];
                $password = $row['password'];
                $userlevel = $row['user_level'];
                
                
                 $active = "Active";
                if($row['status'] == $active) {
                $status = '<label class="label label-success">Active</label>';
               } else {
                $status = '<label class="label label-danger">Inactive</label>'; 
               }

                
                
   
                
            ?>
            <td><?php echo $userid; ?></td>
            <td><?php echo $username; ?></td>
            <td><?php echo $password; ?></td>
            <td><?php echo $userlevel; ?></td>
            <td><?php echo $status; ?></td>
            <td><button id="delete" class="btn btn-danger" onclick="DeleteUser('<?php echo $userid; ?>');"><span class="glyphicon glyphicon-floppy-remove"></span></button>
                <button id="delete" class="btn btn-success" onclick="GetUserDetails('<?php echo $userid; ?>');"><span class="glyphicon glyphicon-wrench"></span></button>
                </td>
        </tr>
            <?php
            }
            
        ?>
    </tbody>
</table>
<script>
$(document).ready(function(){
    $('#myTable').DataTable();
    
});
</script>