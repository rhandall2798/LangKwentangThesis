<?php
session_start();
include 'connect.php';

?>

<table id="myTable" class="table table-hover table-bordered" >					
    <thead>
        <tr>
            <th>ID</th>
            <th>Complainee ID</th>								
            <th>Subject</th>
            <th>Status</th>								   
            <th>Option</th>
        </tr>

    </thead>
    <tbody>
        <tr>
        <?php
            
        $idadmin = 3;
        $query_data = mysqli_query($conn, "SELECT * FROM complaints ");

            while($row = mysqli_fetch_assoc($query_data)) {
                //fetch the rows for me please.
                $id = $row['id'];
                $complaineeid = $row['complaineeid'];
                $subject = $row['subject'];
                $status = $row['status'];
                
                
                 $active = "Solved";
                if($row['status'] == $active) {
                $status = '<label class="label label-success">Solved</label>';
               } else {
                $status = '<label class="label label-danger">Unsolved</label>'; 
               }

                
                
   
                
            ?>
            <td><?php echo $id; ?></td>
            <td><?php echo $complaineeid; ?></td>
            <td><?php echo $subject; ?></td>
            <td><?php echo $status; ?></td>
            <td>
                <button id="update" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Update Complaint" onclick="getComplaintDetails('<?php echo $id; ?>');"><span class="glyphicon glyphicon-pencil"></span></button>
                <a href="../AdminDesign/complaintsreply.php?id=<?php echo $id; ?>">
                <button id="view" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="View Complaint">
                <span class="glyphicon glyphicon-comment"></span></button>
                </a>
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