<?php
session_start();
include 'connect.php';

?>

<table id="myTable" class="table table-hover table-bordered" >					
    <thead>
        <tr>
            <th>ID</th>
            <th>Suggestionee ID</th>
            <th>Subject</th>									
            <th>Status</th>								         
            <th>Option</th>
        </tr>

    </thead>
    <tbody>
        <tr>
        <?php
            
        $sessionid = $_SESSION['UserIDmo'];
        $query_data = mysqli_query($conn, "SELECT * FROM suggestions");

            while($row = mysqli_fetch_assoc($query_data)) {
                //fetch the rows for me please.
                $id = $row['id'];
                $suggestioneeid = $row['suggestioneeid'];
                $subject = $row['subject'];             
                $status = $row['status'];
                           
                 $active = "Solved";
                if($row['status'] == $active) {
                $status = '<label class="label label-success">Solved</label>';
               } else {
                $status = '<label class="label label-danger">Unsolved</label>'; 
               }

                
                
   
                
            ?>
            <td data-priority="1"><?php echo $id; ?></td>
            <td><?php echo $suggestioneeid; ?></td>
            <td data-priority="2"><?php echo $subject; ?></td>
            <td><?php echo $status; ?></td>
            <td>
               
                    <button id="update" name="action" class="btn btn-success" value="<?php echo $id; ?>" onclick="getSuggestionDetails('<?php echo $id; ?>')"><span class="glyphicon glyphicon-pencil"></span></button>                
              
                    <a href="../AdminDesign/suggestionreply.php?id=<?php echo $id; ?>">
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
    $('#myTable').DataTable({responsive: true,columnDefs: [
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 2, targets: -1 }
    ]});
    
});
</script>