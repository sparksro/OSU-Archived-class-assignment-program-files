<?php
// This page takes data sent via post from TeacherGradebook.php and inserts the data into gradebook, 
// gradbook_assignment, student_assignment

	//ini_set('display_errors', 1);
	session_start();
	include 'connect.php';
	$dbusername = $_SESSION['sess_username'];
	$dbuserlvl = $_SESSION['sess_id'];
//Enter the data if all blanks are filled.
if( !empty($_POST['assignment_id']) && !empty($_POST['student_id']) && !empty($_POST['points']) && !empty($_POST['percent']) && !empty($_POST['comment']) && !empty($_POST['class_id']))
{
	$aid = $_POST['assignment_id'];
	$sid = $_POST['student_id'];
	$points = $_POST['points'] ;
	$percent = $_POST['percent'];
	$comment = $_POST['comment'];
	$cid = $_POST['class_id'];

    // Insert collumn data into gradebook.
	$insert = $db->prepare("INSERT INTO gradebook(sid,points,comment,percent) VALUES(?,?,?,?)");
	$insert->bind_param('iisi', $sid, $points, $comment, $percent);
	if($insert -> execute())
	{
		//get the newly inserted gradebook row id number.
		$query = $db->query("SELECT id FROM gradebook WHERE sid ='$sid' AND points = '$points' AND comment = '$comment' AND percent = '$percent'");
                    $row = mysqli_fetch_assoc($query);
                    $gid = $row['id'];
         // put it and the assignment id number into gradebook_assignment          
	     $insert = $db->prepare ("INSERT INTO gradebook_assignment(gradebook_id, assignment_id) VALUES(?,?)");              
	     $insert->bind_param('ii', $gid, $aid);
		if($insert -> execute())
		{
			echo "gradebook_assignment added successfully.<br>";
		} 
		else {echo "gradebook_assignment add failed.<br>";}
		// Insert data into student_assignment
		$insert = $db->prepare ("INSERT INTO student_assignment(assignment_id, sid, percent) VALUES(?,?,?)");              
	    $insert->bind_param('iii', $aid, $sid, $percent);
		if($insert -> execute())
		{
			include './TeacherGradebook.php';// done go back
		}
		else {echo "student_assignment add failed.<br>";}
	} 
	else 
	{
		echo "Grade add failed!<br>";
		echo "Maybe you all ready added it!<br>";
	}
}
else 
{
	echo "All fields are required!<br>";
}	

?>
