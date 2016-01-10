<?php
    session_start();
    include 'connect.php';
    $userid = $_SESSION['userid'];
    $username = $_SESSION['username'];
    ?>
<link rel="stylesheet" type="text/css" href="style.css">    
<div id="entryForm">
<form id='entryform' action='newentry.php' method='POST' enctype='multipart/form-data'>
 <fieldset>   
     <tr>
       <td>Enter the name of series including season and episode if appropriate:<br> </td>
       <?php
       echo "<input type='hidden' name='user' value='$username'>"
       ?>
        <td><input type='text' name='name'/><br></td>
        <td>
        <label>Description of Media Form:</label>
          <select name="description">
            <option value="TV Show">TV Show</option>
            <option value="Movie">Movie</option>
            <option value="Book">Book</option>
            <option value="Magazine">Magazine</option>
            <option value="Electronic -epub ect.">Electronic -epub ect</option>
            <option value="-">Other</option>
          </select>
          </td><br>
        <td> 
        <h4>Tell us what you think.</h4>Enter 1000 Characters Max.
          <textarea name="dotell" rows="7" cols="80">
Replace this text with yours.  Include any relivent info and what you did and or did not like.  Is this your favorite episode?
          </textarea>
        </td>  
         <br><br>
        <td>Upload a small picture or screen capture (1 mb max size).</td>
         <br>
        <td><input type='file' name="fileToUpload" id="fileToUpload"></td> <br>
        <td></td>       
          <form>
          <td><br></td>
          <td>Do you want to share this with the rest of the members?
            <input type="radio" name="share" value="1" value="red" checked />Yes
            <input type="radio" name="share" value="0" />No<br>
            Please note if you check no only you will be able to see your entry.</td>
          </form>
       <input class='submit_button' type='submit' value="Upload Your Entry." name='submit'>
      </tr>
  </fieldset>      
</form>
</div>    
