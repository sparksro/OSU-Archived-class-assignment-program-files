<?php
session_start();
include 'connect.php';
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <script src="ajax_script.js"></script>
    <title>Member Register</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <img src="./images/header.jpg" alt="Super Nova Top bar picture" height="150" width="99.0%"> 
</head>
<body>

<div id="topMessage"> <h2>Welcome to My Sci-fi Show Data Base Access Site.</h2>.<h3><font color='blue'>User names and email addresses must be unique.  Once registered, an activation email will be sent to you.</font></h3></div>
<?php echo "
  <form id='register' action='./register' method='POST'>
     
    <div id='regDiv'>
    <table>
    <div id='error'></div> 
      <tr>
        <td>Username:</td>
        <td><input type='text' name='user'></td>   
      </tr> 
      <tr>  
        <td>Email:</td>
        <td><input type='text' name='email'></td>
      </tr>
      <tr>  
        <td>Password:</td>
        <td><input type='password' name='pass'></td>
      </tr>
      <tr>  
        <td>Retype Password:</td>
        <td><input type='password' name='retypepass'></td>
      </tr>    
      <tr>  
        <td><input class='submit_button' type='submit' name='registerbtn' value = 'Register'></td>
      </tr>
      </table>
      </div>
  </form>";
?>
<form id='registerLogin' action="./login.php">Or Login : <input class='submit_button' type='submit' value='login'/></form>

<?php

    if( $_POST['registerbtn']) {
       $getuser = $_POST['user'];
       $getmail = $_POST['email'];
       $getpassword = $_POST['pass'];
       $getretypepass = $_POST['retypepass'];
   
       if($getuser) {
          if ($getmail) {
              if ($getpassword) {
                  if ($getretypepass) {
                      if($getpassword === $getretypepass) {
                         if( (strlen($getmail) >= 7) && (strstr($getmail, "@")) && (strstr($getmail, ".")) ) { 
                         $query = $mysqli->query("SELECT * FROM users WHERE username='$getuser'");                 
                         $numrows = mysqli_num_rows($query);                        
                             if($numrows == 0) {                        
                                 $query = $mysqli->query("SELECT * FROM users WHERE email='$getmail'");                               
                                 $numrows = mysqli_num_rows($query);                             
                                 if($numrows == 0) {                                  
                                     $password = md5(md5("aG3d!b".$getpassword."aSdg*6") );
                                     $date = date("F d, Y");
                                     $code = md5(rand());
                                     $active = 0;
                                     $share = 0;                                                          
                                 /* prepare */
                                if (!($stmt = $mysqli->prepare("INSERT INTO users ( username, password, email, active, share, code ) VALUES ( ? , ?, ? ,? , ?, ? )")) ) {
                                 echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
                               }   
                               /* bind and execute */ 
                               if (!$stmt->bind_param("ssssss", $getuser, $password, $getmail, $active, $share, $code)) {
                                 echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
                               }
                               if (!$stmt->execute()) {
                                 echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                               }
                               /* close statement */
                               $stmt->close();              
                                     $query = $mysqli->query("SELECT * FROM users WHERE username='$getuser'");                                       
                                     $numrows = mysqli_num_rows($query);                                    
                                     if ($numrows == 1){                                                                          
                                         $site = "http://web.engr.oregonstate.edu/~sparksro/lastProject";
                                         $webmaster = "sparksro@oregonstate.edu";
                                         $headers =  "From: $webmaster";
                                         $subject = "Activate Your Account";
                                         $message = "Thanks for registering.  Click the link to activate your account.\n";
                                         $message .= "$site/activate.php?user=$getuser&code=$code\n";
                                         $message .= "You must activate your account to login.";
                                        if (mail($getmail, $subject, $message, $headers) ) {                                        
                                            echo "<script>myFunction('./messages/registered.txt','regDiv');</script>";
                                            //$errormsg = "You have been registered. You must activate your account from the activation link sent to <b>$getmail</b>"; 
                                            //echo "<p><font color='blue'>You have been registered.</font></p>";
                                            //echo "<p><font color='blue'>Please check your email for an activation link</font></p>"; 
                                            //echo "<p><font color='blue'>and allow several minutes to receieve the email.</font></p>";
                                            //echo "<p><font color='red'>Note: Keep track of your password! Its not stored here.</font></p>"; 
                                            //echo "<p><font color='red'>If you loose it we can't recover it for you.'</font></p>";
                                            $getuser = "";
                                            $getmail = "";
                                            $getpassword = "";
                                            $getretypepass ="";
                                         }
                                         else
                                            echo "<script>myFunction('./messages/activationnotsent.txt','error');</script>"; 
                                             //echo "<p><font color='red'>An error has occured. Your activation email was not sent.</font></p> ";      
                                     }
                                     else
                                         echo "<script>myFunction('./messages/regerror.txt','error');</script>"; 
                                         //echo "<p><font color='red'>An error has occured. Your account was not created.</font></p>";    
                                         
                                 }
                                 else
                                     echo "<script>myFunction('./messages/emailinuse.txt','error');</script>"; 
                                     //echo "<p><font color='red'>That email address is in use.</font></p>";  
                             }
                             
                             else
                                 echo "<script>myFunction('./messages/usernameinuse.txt','error');</script>"; 
                             //echo "<p><font color='red'>That username is all ready used.</font></p>";   
                             mysqli_close();
                              
                         }
                         else
                             echo "<script>myFunction('./messages/mustentvalemail2reg.txt','error');</script>"; 
                          //echo "<p><font color='red'>You must enter a valid email to register.</font></p>";       
                      }
                      else
                          echo "<script>myFunction('./messages/pwdontmatch.txt','error');</script>"; 
                          //echo "<p><font color='red'>Your passwords did not match.</font></p>";
                  }
                  else
                     echo "<script>myFunction('./messages/mustrenterpw2reg.txt','error');</script>"; 
                      //echo "<p><font color='red'>You must re-enter your password to register.</font></p>";
              }
              else
                  echo "<script>myFunction('./messages/mustentname2reg.txt','error');</script>"; 
                  //echo "<p><font color='red'>You must enter your password to register.</font></p>";
          }
          else
              echo "<script>myFunction('./messages/mustentemail2reg.txt','error');</script>"; 
              //echo "<p><font color='red'>You must enter your email to register.</font></p>";
       }        
        else
            echo "<script>myFunction('./messages/mustentname2reg.txt','error');</script>";     
    }
 
 ?>  
    
    
  

</body>
</html>
