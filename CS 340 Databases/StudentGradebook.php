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
    <link rel="icon" href="http://getbootstrap.com/favicon.ico">

    <title>Gradebook</title>

    <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/dashboard/dashboard.css" rel="stylesheet">
  </head>

  <body>

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
            <li><a href="#">Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="#">Class <span class="sr-only">(current)</span></a></li>
            <li class="active"><a href="StudentGradebook.php">Grades</a></li>
            <li><a href="StudentAssignments.html">Assignments</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Gradebook</h1>
<!--container for grade table-->
          <div = container> 
            <thead>
              <tr>
                <th>Name</th>
                <th>Points</th>
                <th>Percent</th>
                <th>Comment</th>
              </tr>
            </thead>
            <tbody>

        
          <!--PRINT GRADES OF ONLY THIS STUDENT-->
              <?php 
              //set query to obtain all assignment grades/name
               
                $result = $db->query(" SELECT a.name, gb.points, gb.comment, gb.percent FROM assignment a INNER JOIN gradebook_assignment gba ON gba.assignment_id = a.id LEFT JOIN gradebook gb ON gb.id = gba.gradebook_id INNER JOIN user u ON u.id = gb.sid WHERE u.username = '$dbusername'");
                while($row = mysqli_fetch_assoc($result))
                {
                  //while rows exist , input into table returned values from result
                  echo"
                  <tr>
                    <td>". $row['name'] ."</td>
                    <td>". $row['points'] ."</td>
                    <td>". $row['percent'] ."</td>
                    <td>". $row['comment'] ."</td>
                  </tr>
                  ";
                }
              ?> 
            </tbody>
          </div>
        </div>
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
  

<svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 200 200" preserveAspectRatio="none" style="visibility: hidden; position: absolute; top: -100%; left: -100%;"><defs></defs><text x="0" y="10" style="font-weight:bold;font-size:10pt;font-family:Arial, Helvetica, Open Sans, sans-serif;dominant-baseline:middle">200x200</text></svg>
  </body>
</html>
