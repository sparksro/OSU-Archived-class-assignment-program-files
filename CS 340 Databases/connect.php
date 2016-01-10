<?php
include('../../x/seq.php');
$dbhost = 'oniddb.cws.oregonstate.edu';
$dbname = $db;
$dbuser = $dbu;
$dbpass = $pw;

//echo $col;
//$msqli_connect($dbhost, $dbname, $dbpass);
//$mysqli_select_db($dbname);
$success = NULL;
$db = new mysqli($dbhost, $dbname, $dbpass, $dbuser);
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}else{
    //$success = 'Successfully connected to dbase!' ."<br>" ;
//echo ($success);
}
?>
