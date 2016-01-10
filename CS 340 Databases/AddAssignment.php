<?php
//ini_set('display_errors', 1);
// Receives data from TeacherAssignment.php.  Inserts data into assignment table.  
    session_start();
    include 'connect.php';
    $dbusername = $_SESSION['sess_username'];
	$dbuserlvl = $_SESSION['sess_id'];
	
if(!empty($_POST['name']) && !empty($_POST['subject'])&& !empty($_POST['ppoints'])&& !empty($_POST['due'])&& !empty($_POST['descript']) && !empty($_POST['class_id']))
{
	$id=NULL;
	$name=$_POST['name'];
	$subject=$_POST['subject'];
	$ppoints=$_POST['ppoints'];
	$due=$_POST['due'];
	$descript=$_POST['descript'];
	$class_id = $_SESSION['class_id'];
	
	//$query= $db->query("SELECT * FROM assignment");
	// inserts data into assignment based on class id obtained through session data from TeacherAssignment.php
	$insert = $db->prepare("INSERT INTO assignment(subject,name,descript,ppoints,due,class_id) VALUES(?,?,?,?,?,?)");
	$insert->bind_param("sssisi", $subject, $name, $descript, $ppoints, $due, $class_id);
	if($insert -> execute())
	{
		echo "successfully added assignment";
		$insert->close(); 
		include './TeacherAssignments.php';
	} 
	else 
	{
		echo "Assignment add failed!" . "<br>";
		echo "Try changing the name!" . "<br>";
		echo "<div class='form-group'>";
        echo "<div class='input-group'>";// link to take user back in the event the insert fails.
        echo "<form id='return' action='./TeacherAssignments.php'> <input class='submit_button' type='submit' value='Return to Assignments'></form><br>";
        echo "</div></div>";        
	}
}
else 
{
	echo "All fields are required!";
}
?>
