<?php
// simple display of grades for a studend and assignment.  The basics are here but it could get more visual upgrades.
// I want to encorporate this in to the TeacherGradebook page with Js so it all stays on the same page.
	//ini_set('display_errors', 1);
	session_start();
	include 'connect.php';
	$dbusername = $_SESSION['sess_username'];
	$dbuserlvl = $_SESSION['sess_id'];

	$aid = $_POST['assignment_id2'];
	$sid = $_POST['student_id2'];

	
	// Select based on student name and assignment to show grade for that assignment
	$query = $db->query("SELECT u.fname, u.lname, a.name, sa.percent, g.grade FROM user u INNER JOIN student_assignment sa ON sa.sid = u.id INNER JOIN assignment a ON a.id = sa.assignment_id INNER JOIN grade g ON g.percent_v = sa.percent WHERE a.id = '$aid' AND sa.sid = '$sid'");
            $row = mysqli_fetch_assoc($query);
            echo "Name        Assignment     Percent     Grade<br>";
            echo $row['fname'] . "  " . $row['lname'] . "  " . $row['name'] . "  " . $row['percent'] . "  " . $row['grade'] ; 
?>
      <form id="return" class="form-geofence" role="form" method="post" action="TeacherGradebook.php">
            <button id = "Add" class ="btn btn-primary" style = "margin: 10px 0">Return</button>
       		</form>


