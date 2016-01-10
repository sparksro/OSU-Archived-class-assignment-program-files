<?php
//Rob Sparks CS 494
session_start();
session_destroy();
?>




<!DOCTYPE html>
<html>
 <head>
  <title>Assignment 4 login</title>
 </head>
 <body>
<form action="content.php" method="POST">
 <p>Please Enter Your User Name</p>
  <input type="text" name="username" /></p>
  <p>Please Enter Your Password</p>
  <input type="Password" name="password" /></p>
  
 <p><input type="submit" name="Submit1" value="Submit" /></p>
</form>
</body>
</html>

