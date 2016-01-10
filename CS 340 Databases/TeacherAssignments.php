<?php
// Combined html and php page.  Sends data via post to AddAssgnment.php.  Only accessable via teacher or higher user level.
// Html form bellow takes teacher entered data to insert into tables.  Data transfered via posts.
include 'connect.php';
session_start();
$dbusername = $_SESSION['sess_username'];
$dbuserlvl = $_SESSION['sess_id'];
if ($dbuserlvl == 0 || $dbuserlvl == 1 || $dbuserlvl == 2 ) {
?>
<!DOCTYPE html>
<!-- saved from url=(0043)http://getbootstrap.com/examples/dashboard/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Assignments</title>

    <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/dashboard/dashboard.css" rel="stylesheet">
  </head>
  <body>
    <!--nav bar using bootstrap-->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">X Grade School</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!--//nav bar-->

    <
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Current Pages<span class="sr-only">(current)</span></a></li>
             <li><a href="Dashboard.php">Dashboard</a></li>
             <li><a href="userInformation.php">My Info Page</a></li>
            <li><a href="TeacherAssignments.php">Teacher Enter Assignments</a></li>
            <li><a href="TeacherGradebook.php">Teacher Enter/View Grades</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
           <h1 class="page-header">Enter New Assignments</h1>
           <h4 class="page-header">Welcome <?php echo $dbusername; ?> </h4>
        <form action="AddAssignment.php" method="post">
              <div class="form-group">
              <div class="input-group">
              <input type="text" class="form-control" id="name" name="name" placeholder="Name: needs to be unique" required="">
            </div>
          </div>
            <div class="form-group">
            <div class="input-group">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required="">
            </div>
          </div>
            <div class="form-group">
            <div class="input-group">
              <input type="number" class="form-control" id="ppoints" name="ppoints" placeholder="Possible Points" required="">
            </div>
          </div>
            <div class="form-group">
              <div class="input-group">
                <label for="comment">Date from must be year-month-day like -> 2015-01-25</label>
                <input type="date" class="form-control" id="due" name="due" placeholder="Due Date" required="">
              </div>
            </div>  
          <div class="form-class">
            <label for="comment">Description:</label>
            <textarea class="form-control" rows="5" id="descript" name ="descript"></textarea>
          </div>
          <br>
          <div class="form-group">
              <div class="input-group">
              <!-- Gets the teachers id from session data to print class at top of page.  -->
              <?php $query = $db->query("SELECT c.id, c.cname FROM class c INNER JOIN user u ON u.id = c.teacher_id WHERE u.username='$dbusername'");
                    $row = mysqli_fetch_assoc($query);
                    $class_id = $row['id'];
                    $_SESSION['class_id'] = $class_id;// set the value in session data so it can be used in AddAssignments.php
              ?>
                <input type="hidden" class="form-control" id="class_id" name="class_id" value="<?php echo $class_id; ?>"  placeholder="" >
              </div>
            </div> 
          <button id = "Add" class ="btn btn-primary" style = "margin: 10px 0">Add</button>
       </form>
        </div>
      </div>
    </div>
  </div>

<!--MAYBE PRINT OFF ASSIGNMENT LIST AS WELL-->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./Dashboard Template for Bootstrap_files/jquery.min.js"></script>
    <script src="./Dashboard Template for Bootstrap_files/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="./Dashboard Template for Bootstrap_files/holder.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./Dashboard Template for Bootstrap_files/ie10-viewport-bug-workaround.js"></script>

<svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 200 200" preserveAspectRatio="none" style="visibility: hidden; position: absolute; top: -100%; left: -100%;"><defs></defs><text x="0" y="10" style="font-weight:bold;font-size:10pt;font-family:Arial, Helvetica, Open Sans, sans-serif;dominant-baseline:middle">200x200</text></svg></body></html>
<?php }
else {echo "Sorry you are not authorized to view this page. <br>";} 
?>
