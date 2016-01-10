<?php
include 'connect.php';
$product_id = $_POST["id"];

/*remove via query works*/
if (!($stmt = $mysqli->query("DELETE FROM grocery WHERE grocery . id = '$product_id' LIMIT 1 "))) {
   echo "item delete failed: (" . $mysqli->errno . ") " . $mysqli->error;}
header('Location: index.php');
?>
