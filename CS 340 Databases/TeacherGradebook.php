<?php
// This page is combinded php an html. It can only be accessed by a teacher based on user level.
// It uses user sesion data to screen useres.  This page sends data to AddGrades.php.
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
    <title>Gradebook</title>

    <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/dashboard/dashboard.css" rel="stylesheet">

  </head>
  <body>
    <!--navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
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
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <!--sidebar panel for easier navigation-->
            <li class="active"><a href="#">Current Pages<span class="sr-only">(current)</span></a></li>
            <li><a href="Dashboard.php">Dashboard</a></li>
            <li><a href="userInformation.php">My Info Page</a></li>
            <li><a href="TeacherAssignments.php">Teacher Enter Assignments</a></li>
            <li><a href="TeacherGradebook.php">Teacher Enter/View Grades</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Gradebook</h1>
          <!-- this gets the teachers user id and class name -->
        <?php $query = $db->query("SELECT c.id, c.cname FROM class c INNER JOIN user u ON u.id = c.teacher_id WHERE u.username='$dbusername'");
                    $row = mysqli_fetch_assoc($query);
                    $class_id = $row['id'];//for later use
                    $classname = $row['cname'];
                    ?> 
          <h4 class="page-header"><?php echo $classname . ": Welcome " .  $dbusername; ?> </h4><form action="AddGrades.php" method="POST" id = "AddGrade">
          <form  id="data" class="form-geofence" role="form" method="post" action="AddGrades.php">
            <!--Add Subject name to limit selection of assignment but that needs page update with stored variables Name -->            
             
             <!--Select Assignment Name -->
             <div class="form-group">
              <div class="input-group"> 
             <select name="assignment_id">
               <option value=" ">--- Assignment ---</option>       
            <?php 
            // Fills the the drop down with current assignments. The id number is used as option id.
            $result=$db->query("SELECT id, name FROM assignment WHERE class_id = '$class_id'");
                   while($row=mysqli_fetch_assoc($result))
                   {   
                    echo '<option value="'. $row['id'] .'">'. $row['name'] . '</option>';
                    }
                echo '</select>'; 
           ?>
           <!--Select Student Name -->
             <select name="student_id">
                <option value="">--- Student ---</option>         
             <?php
             // Fills the student dropdown with student names.  Student id is used as the option value.  
            $result=$db->query("SELECT u.id, u.fname, u.lname FROM user u INNER JOIN student_class sc ON sc.sid = u.id INNER JOIN class c ON c.id = sc.class_id WHERE cname ='$classname'ORDER by lname, fname");
                   while($row=mysqli_fetch_assoc($result)){
                    echo '<option value="'. $row['id'] .'">'. $row['fname'] . " " . $row['lname'] . '</option>';}
              ?>
             </div>
            </div>
              </select> 
            <!--forms for inputting values -->
            <div class="form-group">
              <div class="input-group">             
            </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <input type="number" class="form-control" name ="points" id="points" placeholder="Points" required="">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <input type="number" class="form-control" id="percent" name="percent" placeholder="Percent" required="">
              </div>
            </div>
              <div class="form-group">
              <div class="input-group">
                <input type="textarea" class="form-control" name="comment" id="comment" placeholder="Comment" required="">
              </div>
            </div>
            <input type="hidden" name="class_id" id="class_id" value="<?php echo $class_id; ?>" >
           <button id = "Add" class ="btn btn-primary" style = "margin: 10px 0">Add</button>
          </form>
        </div>
     
    <h3> View Students Grades for Assignment </h3><!-- later incorporate this into the page with JS -->
    
    <form  id="viewstudent_grades" class="form-geofence" role="form" method="post" action="viewGrades.php">
        <div class="form-group">
            <div class="input-group"> 
             <select name="assignment_id2">
               <option value=" ">--- Assignment ---</option>       
            <?php 
            // Fills the the drop down with current assignments. The id number is used as option id.
            $result2=$db->query("SELECT id, name FROM assignment WHERE class_id = '$class_id'");
                   while($row=mysqli_fetch_assoc($result2))
                   {   
                    echo '<option value="'. $row['id'] .'">'. $row['name'] . '</option>';
                    }
                echo '</select>'; 
           ?>
           <!--Select Student Name -->
             <select name="student_id2">
                <option value="">--- Student ---</option>         
             <?php
             // Fills the student dropdown with student names.  Student id is used as the option value.  
            $result2=$db->query("SELECT u.id, u.fname, u.lname FROM user u INNER JOIN student_class sc ON sc.sid = u.id INNER JOIN class c ON c.id = sc.class_id WHERE cname ='$classname'ORDER by lname, fname");
                   while($row=mysqli_fetch_assoc($result2)){
                    echo '<option value="'. $row['id'] .'">'. $row['fname'] . " " . $row['lname'] . '</option>';}
              ?>
             </div>
            </div>
              </select> 
               <button id = "view" class ="btn btn-primary" style = "margin: 10px 0">view</button>
          </form>
           </div>
    </div>
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

<?php 
}
else 
{
  echo "Sorry you are not authorized to view this page. <br>";
} 
?>
