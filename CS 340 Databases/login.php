<?php
session_start();
//ini_set('display_errors', 1);
// this page accessed via index.html
	if(!empty($_POST['username']) && !empty($_POST['password'])) 
	{
		$username=$_POST['username'];// gets user name and pw from session data.
		$password=$_POST['password'];
		include 'connect.php';
		//checks username and pw with database
		$query = $db->query("SELECT * FROM user WHERE username='$username'AND pw ='$password'");
		if($query->num_rows != 0)
		{
		   $numrows = mysqli_num_rows($query);
            if ($numrows == 1)
            {
                      $row = mysqli_fetch_assoc($query);
                      $dbid = $row['id'];		//get the user data for the user name
                      $dbusername = $row['username'];
                      $dbpassword = $row['pw'];
                      $dbuserlvl=$row['usr_lvl'];
				if($username == $dbusername && $password == $dbpassword)// make sure they match
				{
					$_SESSION['sess_id'] = $dbuserlvl;//set session data with user data so it can be used on following pages.
					$_SESSION['sess_username'] = $dbusername;
					//echo "true";
					echo "<meta http-equiv='refresh' content='0; url=Dashboard.php'>";	
				}
			}
		} 
		else 
		{
			echo "Invalid username or password!";
		}
	} 
	else 
	{
		echo "All fields are required!<br>>";
	}
?>
