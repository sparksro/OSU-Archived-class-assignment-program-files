<?php
session_start();
include 'connect.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script src="ajax_script.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Member Login</title>
    <img src="./images/header.jpg" alt="Super Nova Top bar picture" height="150" width="99.0%"> 
</head>
<body>
  <h2>Welcome to My Sci-fi Show Data Base Access Site.</h2>
    <?php
      if($username && $userid) {
      echo "You are all ready logged in as <b>$dbuser</b>. <a href='member.php'>Click here\n</a>";
      }
        else {
        echo "<form id='login' name='login' action='./login.php' method='POST'>
        <table>
        <div id='error'> </div>
        <h3>Login</h3>
        <tr>
            <td>Username:</td>
            <td><input type='text' name='user'/></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type='password' name='password'/></td>
        </tr>
        <tr>
            <td></td>
            <td><input class='submit_button' type='submit' name='loginbtn' value='Login'/></td>
        </tr>
        </table>
        </form> 
       <form id='loginReg' name='register' action='./register.php'>
       Or register: 
       <input class='submit_button' type='submit' name='register' value='Register'/>
       </form>";
      
        if($_POST['loginbtn']) {
            $user = mysqli_real_escape_string($mysqli, $_POST['user']);
            $password = mysqli_real_escape_string($mysqli, $_POST['password']);
          
            if($user){
                if($password){
                  
                  $password = md5(md5("aG3d!b".$password."aSdg*6"));
                  $query = $mysqli->query("SELECT * FROM users WHERE username='$user'");
                  $numrows = mysqli_num_rows($query);
                  if ($numrows == 1) {
                      $row = mysqli_fetch_assoc($query);
                      $dbid = $row['id'];
                      $dbuser = $row['username'];
                      $dbpass = $row['password'];
                      $dbactive = $row['active'];
                      
                      if($password == $dbpass) {
                         if($dbactive == 1) {
                             $_SESSION['userid'] = $dbid;
                             $_SESSION['username'] = $dbuser;
                             
                             echo "<meta http-equiv='refresh' content='0; url=member.php'>";
                         }
                         else
                             echo "<p><script>myFunction('./messages/mustactacc.txt','error');</script></p>";
                      }                  
                      else
                          echo "<p><script>myFunction('./messages/incorrectpw.txt','error');</script></p>";
                  }
                  else
                      echo "<p><script>myFunction('./messages/usernamenfound.txt','error');</script></p>"; 
                      mysqli_close();
                }    
                else 
                    echo "<p><script>myFunction('./messages/mustusepw.txt','error');</script></p>";     
            }
            else
                echo "<p><script>myFunction('./messages/enterusrname.txt','error');</script></p>";
               
        } 
      }
    ?>
   
</body>
</html>

