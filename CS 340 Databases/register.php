<?php
// This page dynamically adds user data into three tables user, contact and parent.  It repeatadly loops back on it self untill
// the user is finished entering users data.  It does not now look like a lot but this was a good days work figuring out all the 
// things it needed to do.
session_start();
$parent1_id = $_SESSION['pid1'];//session data that is use to insert values into parent table.
$parent2_id = $_SESSION['pid2'];


if(!empty($_POST['title']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['birthday']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip']) && !empty($_POST['phone']) )
{
	//user entered variables to be entered into the database
	$title=$_POST['title'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$birthday=$_POST['birthday'];
	$address=$_POST['address'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$zip=$_POST['zip'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	

	if (strlen($username) <=3)//password controll
	{
		echo "Username must be longer than three characters";
	}
	else 
	{
		if (strlen($password) <=6)
		{
			echo "Password must be longer than 6 characters";
		}	
		else
		{
				include 'connect.php';//checks to see if user name is all ready used.
				$query= $db->query("SELECT * FROM user WHERE username= '$username'");
				$row = mysqli_fetch_assoc($query);
				if($row['username'] == $username)
				{
					echo "That username already exists! Please try again with another.";
				} 
				else 
				{				
					$date = date('Y-m-d');// insert into user from user entered data
					$insert = $db->prepare("INSERT INTO user(username, fname, lname, title, dob, enr_date, pw) VALUES(?,?,?,?,?,?,?)");
					$insert->bind_param('ssssssi', $username, $fname, $lname, $title, $birthday, $date, $password);
					if($insert -> execute())
					{	//get the user id number from newly entered user
						$query= $db->query("SELECT id FROM user WHERE username= '$username'");
						$row = mysqli_fetch_assoc($query);
						$uid = $row['id'];
						if($title == 'parent' &&  $parent1_id == NULL)// saves user number as parent1 in session data
						{							
							$_SESSION['pid1'] = $uid;
							//echo "parent 1<br>";
						}
						if($title == 'parent' &&  $parent1_id != NULL)// saves user number as parent2 in session data
						{
							$_SESSION['pid2'] = $uid;
							
						}
						if($title == 'student')
						{

							if($parent1_id != NULL)// if parent1 then save into parent table
							{
								$insert3 = $db->prepare("INSERT INTO parent(uid, sid) VALUES(?,?)");
								$insert3->bind_param('ii', $parent1_id, $uid);
								if($insert3 -> execute()){echo"parent1 - student ids inserted sucessfully.<br>";}
							}
							else{echo "Did you select parent when registering the parent? - Parent id number not found!<br>";}

							if($parent2_id != NULL)// if parent2 then save into parent table
							{
								$insert4 = $db->prepare("INSERT INTO parent(uid, sid) VALUES(?,?)");
								$insert4->bind_param('ii', $parent2_id, $uid);
							if($insert4 -> execute()){echo"parent2 - student ids inserted sucessfully.<br>";}
							}

						}

						//now enter the contact info for each user
						$insert2 = $db->prepare("INSERT INTO contact(uid,address,city,state,zip,email,phone) VALUES(?,?,?,?,?,?,?)");
						$insert2->bind_param('isssiss',$uid,$address,$city,$state,$zip,$email,$phone);
						if($insert2 -> execute())
						{
							echo "user sucessfully entered in data base";
							include 'register.html';
						}
						else {echo "Insert of contact data failed!";}
					} 
					else 
					{
						echo "Account creation failed!";
					}
				}
		}
		
	}
}	
else 
{
	echo "All fields are required!";
}
?>
