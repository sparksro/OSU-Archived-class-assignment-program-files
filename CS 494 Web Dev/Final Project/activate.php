<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
include 'connect.php';
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Member Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <img src="./images/header.jpg" alt="Super Nova Top bar picture" height="150" width="99%"> 
</head>
<body>
 <?php
    $getuser = $_GET['user'];
    $getcode = $_GET['code'];
    
    if ($_POST['activatebtn']) {
        $getuser = $_POST['user'];
        $getcode = $_POST['code'];
        
        if ($getuser) {
        
            if($getcode) {
            $query = $mysqli->query("SELECT * FROM users WHERE username='$getuser'");
            $numrows = mysqli_num_rows($query);
           
            if ($numrows == 1) {
            
                $row = mysqli_fetch_assoc($query);
                $dbcode = $row['code'];
                
                $dbactive = $row['active'];
              
                if ($dbactive == 0) {
                
                    if ($dbcode == $getcode) {
                    
                        $mysqli->query("UPDATE users SET active='1' WHERE username='$getuser'");
                        $query = $mysqli->query("SELECT * FROM users WHERE username='$getuser' AND active='1'");
                        $numrows = mysqli_num_rows($query);
                        
                        if ($numrows == 1) {
                        
                            $errormsg = "Your account has been activated.  You may now login. <a href='./login.php'>Here</a>";
                            $getuser = "";
                            $getcode = "";
                        }
                        else
                            $errormsg = "An error has occured.  Your accont was not activated.";
                    }
                    else
                        $errormsg = "Your code is incorrect.";
                }
                else
                    $errormsg = "This account is already activated.";
            }
            mysql_close();
            }
            else
                $errormsg = "You must enter your code";       
        }
        else
            $errormsg = "You must enter a user name.";
    }
    
    $form = "<form id='activate' action= 'activate.php' method='POST'>
    <table>
    <tr>
        <td>Username:</td>
        <td><input type='text' name='user' value='$getuser'/></td>
    </tr>
    <tr>
        <td>Code:</td>
        <td><input type='text' name='code' value='$getcode'/></td>
    </tr>
    <tr>
        <td>Code:</td>
        <td><input class='submit_button' type='submit' name='activatebtn' value='Activate'/></td>
    </tr>
     <tr>
        <td></td>
        <td>$errormsg</td>
    </tr>
    
   </table>
   </form>";
   
   echo $form; 
   
   
 ?>
</body>
</html>
