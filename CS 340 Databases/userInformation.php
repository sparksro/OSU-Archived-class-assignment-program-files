<?php
// This page displays current user info.  It will be a place where the user can change user info.
include 'connect.php';
session_start();
$dbusername = $_SESSION['sess_username'];
$dbuserlvl = $_SESSION['sess_id'];
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

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
           
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
          	<li class="active"><a href="userInformation.php">My Info Page</a></li>
            <li><a href="Dashboard.php">Dashboard</a></li>
            <li><a href="StudentAssignments.html">Assignments</a></li>
            <li><a href="StudentGradebook.php">Grades</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">My Current Information</h1>
          <?php 
          	$query = $db->query("SELECT u.fname, u.lname, u.title, u.dob, c.address, c.city, c.state, c.zip, c.email, c.phone FROM user u INNER JOIN contact c ON u.id = c.uid WHERE u.username='$dbusername'");
                 $row = mysqli_fetch_assoc($query);
                 
          echo "<table border='2' style='width:100%'> 
          <tr>
          <th>First</th> <th>Last</th> <th>Title</th> <th>Dob</th> <th>Address</th> <th>City</th> <th>State</th> <th>zip</th> <th>Email</th> <th>Phone</th>
          </tr>";
          echo '<tr>
          <td>'.$row['fname'].'</td> <td>'.$row['lname'].'</td> <td>'.$row['title'].'</td> <td>'.$row['dob'].'</td> <td>'.$row['address'].'</td> <td>'.$row['city'].'</td> <td>'.$row['state'].'</td> <td>'.$row['zip'].'</td> <td>'.$row['email'].'</td> <td>'.$row['phone'].'</td>
          </tr> </table>';
          ?>
          
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
  

<svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 200 200" preserveAspectRatio="none" style="visibility: hidden; position: absolute; top: -100%; left: -100%;"><defs></defs><text x="0" y="10" style="font-weight:bold;font-size:10pt;font-family:Arial, Helvetica, Open Sans, sans-serif;dominant-baseline:middle">200x200</text></svg></body></html>
