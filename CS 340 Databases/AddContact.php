<?php
if(!empty($_POST['address']) && !empty($_POST['city'])&& !empty($_POST['state'])&& !empty($_POST['zip'])&& !empty($_POST['phone']))
{
	$address=$_POST['address'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$zip=$_POST['zip'];
	$phone=$_POST['phone'];
	//connect to database
	include connect.php;
	
	$query= $db->query("SELECT * FROM contact WHERE username='".$username."'");
	//prepare statements for insert
	$insert = $db->prepare("INSERT INTO contact(address,city,state,zip,phone) VALUES(?,?,?,?,?,?)");
	$insert->bind_param('ssssi', $address,$city,$state,$zip,$phone);
	if($insert -> execute())
	{
		include 'contactform.html';
	} 
	else 
	{
		echo "Account creation failed!";
	}
}
else 
{
	echo "All fields are required!";
}
?>
