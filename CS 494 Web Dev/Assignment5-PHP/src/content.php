<?php
//Rob Sparks CS 494
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//header('Content-Type: text/plain');


session_start();

if(session_status() == PHP_SESSION_ACTIVE) {
    if($_POST['username'] == NULL){
    echo " A username must be entered. Click here to return to the login in sceen. ";echo "<br/>";
    session_destroy();
    ?>
    <form action="login.php" method="Get">
        <button type="submit" action="login.php" value="goback" >Return to Login</button>
    </form>
<?php
 }}   
 if(isset($_POST['username'])){
 $_SESSION['username'] = $_POST['username'];
 $_SESSION['visits']=$_SESSION['visits'] + 1;
    }
        
 if ($_POST['username'] != NULL){
     if (isset($_SESSION['username'])) {
                echo "Welcome, " . $_SESSION['username']. " You have visited " . $_SESSION ["visits"]. " times"; }
     }
      
//print_r($_SESSION);
echo "<br/>";echo "<br/>";

?>
<!DOCTYPE html>
<html>
 <head>
  <title>Assignment 4 login</title>
 </head>
 <body>

<?php
$myusername = $_POST['username'];
if ($_SESSION['username'] == NULL){;}

// this is another way to do it.  This was my first sucessfull method
else{//echo "Hello " . $_SESSION ["username"]. " You have visited " . $_SESSION ["visits"]. " times";echo "<br/>";
    echo "Click here to logout.";
?>
    <form action="logout.php" method="Get">
        <button type="submit" action="logout.php"value="goback" >Logout</button>
    </form>
<?php

}

?>

</body>
</html>














