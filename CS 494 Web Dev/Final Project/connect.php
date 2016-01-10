<?php
$dbhost = 'oniddb.cws.oregonstate.edu';
$dbname = 'sparksro-db';
$dbuser = 'sparksro-db';
$dbpass = 'xxxxxxxxxxx';

mysqli_select_db($dbname);
$success = NULL;
$mysqli = new mysqli($dbhost, $dbname, $dbpass, $dbuser);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}else{
//$success = 'Successfully connected to dbase!';
//echo ($success);
}

?>
