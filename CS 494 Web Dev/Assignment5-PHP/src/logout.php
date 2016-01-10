<?php
//Rob Sparks CS 494
session_start();
session_destroy();

 echo "You have logged out click to return to login page.";
 echo "<form action='login.php' method='Get'>";
 echo       "<button type='submit' action='login.php' value='goback' >Log in</button>";
 echo  "</form>";




?>
