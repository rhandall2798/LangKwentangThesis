<?php session_start(); 
include '../UserDesign/php/connect.php';
    
if(isset($_SESSION['UserIDmo'])) {
    
    $query_get_user_level = mysqli_query($conn, "SELECT user_level FROM accounts WHERE id = $_SESSION[UserIDmo]");
    
    $row = mysqli_fetch_assoc($query_get_user_level);
    
    $user_level = $row['user_level'];
    
    
                       $sqlcount = "select count(*) as counted from accounts";
                $rescount = mysqli_query($conn,$sqlcount);
                $rowcount = mysqli_fetch_assoc($rescount);
    
           $usercountid = $rowcount['counted'];
    
            $bilangin = "select count(*) as total from complaints";
            $rescounty = mysqli_query($conn,$bilangin);
            $rowcounty = mysqli_fetch_assoc($rescounty);
    
           $complaintcountid = $rowcounty['total'];
    
                $bilanginmoto = "select count(*) as total from suggestions";
            $rescountyy = mysqli_query($conn,$bilanginmoto);
            $rowcountyy = mysqli_fetch_assoc($rescountyy);
    
           $suggestioncountid = $rowcountyy['total'];
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Area | Posts</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
      <link href="datatable/datatables.css">
       <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
   <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script src="js/sweetalert.min.js"></script>  
      <link rel="stylesheet" href="datatable/dataTables.bootstrap.min.css">
  </head>
  <body>

     <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Barangay Electronic Portal</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="../AdminDesign/index.php">Dashboard</a></li>
            <li><a href="../AdminDesign/pages.php">Suggestions</a></li>
            <li class="active"><a href="../AdminDesign/posts.php">Complaints</a></li>
            <li><a href="../AdminDesign/users.php">Users</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><?php echo $_SESSION['Username'] ?></a></li>
            <li><a href="../php/logout.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Complaints</h1>
          </div>
          <div class="col-md-2">
          </div>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li>Dashboard</li>
          <li>Complaints</li>
            <li class="active">Reply</li>
            
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="../AdminDesign/index.php" class="list-group-item">
                 <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <a href="../AdminDesign/pages.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Suggestions <span class="badge"><?php echo $suggestioncountid; ?></span></a>
              <a href="../AdminDesign/posts.php" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Complaints <span class="badge"><?php echo $complaintcountid; ?> </span></a>
            </div>

            <div class="well">
              <h4>Disk Space Used</h4>
<a href="https://time.is/Angono" id="time_is_link" rel="nofollow" style="font-size:21px;color:Red">Time in Angono:</a><br> <hr>
<span id="Angono_z42c" style="font-size:21px;color:Red"></span>
<script src="//widget.time.is/en.js"></script>
<script>
time_is_widget.init({Angono_z42c:{template:"TIME<br>DATE", time_format:"12hours:minutes:secondsAMPM", date_format:"dayname, monthname dnum, year, week"}});
</script>
            </div>
          </div>
            
            <?php
            $complaint_id = $_GET['id'];
            
            $query_get_complain = mysqli_query($conn, "SELECT * FROM complaints WHERE id = $complaint_id");
            $row = mysqli_fetch_assoc($query_get_complain);
            
            $subject = $row['subject'];
            $problem = $row['problem'];
            ?>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title" style="font-weight: bolder;"><?php echo $subject; ?></h3>
              </div>
                <div class="panel-heading" style="color:#34495e">
                     <p style="text-indent: 30px;padding-bottom: 20px;"><?php echo $problem; ?></p>
                </div>
                 
              <div class="panel-body">
                 
                  <div class="col-md-12">
                         <textarea class="form-control" rows="3" id="myanswer" placeholder="Your Reply Here"></textarea>
                      <br>
                      </div>
                  <br>
                  <br>

                     
                     <button id="post" class="btn btn-primary" type="button" value="button" style="display: block; margin: 0 auto;" onclick="AddAnswers('<?php echo $complaint_id; ?>', '<?php echo $user_level; ?>', '<?php echo $_SESSION["UserIDmo"]; ?>');">Post Answer</button>
                     
                  
                  <br>
                  <br>
      
      
     <div id="answers-list" style="font-weight:bolder;">
                    <?php $_SESSION['complaint_id'] = $complaint_id; ?>
                </div>
</div>
                  
             
                <br>
              </div>
              </div>

          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
      <p>Barangay Electronic Portal &copy; 2017</p>
    </footer>

    <!-- Modals -->
          <div class="modal fade" id="addComplaint" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Complaint</h4>
      </div>
      <div class="modal-body">
        <div class="modal-body">
	      	<div class="messages"></div>

			  <div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="name" class="col-sm-2 control-label">Subject</label>
			    <div class="col-sm-10"> 
			      <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
				<!-- here the text will apper  -->
			    </div>
			  </div>
            <br></br>
			  <div class="form-group">
			    <label for="address" class="col-sm-2 control-label">Problem</label>
			    <div class="col-sm-10">
			      <label for="comment"></label>
                    <textarea class="form-control" rows="3" id="problem" placeholder="Your Complaint Here"></textarea>
			    </div>
                  <br>
                  <br>
			  </div>	
          <br>
	      </div>
      </div>
        <br>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       <input type="button" onclick="manageData('addComplaint')" value="Save" class="btn btn-success">
      </div>
    </form>
    </div>
  </div>
</div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
        <script src="../js/jquery-3.1.1.min.js"></script>
 <script src="datatable/jquery.dataTables.min.js"></script>
<script src="datatable/dataTables.bootstrap.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
      <script src="js/index.js"></script>
    <script src="js/jquery.AddAnswers.js"></script>
  </body>
</html>
