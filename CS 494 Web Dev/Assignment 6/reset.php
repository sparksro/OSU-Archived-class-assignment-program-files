<?php
include 'connect.php';

//delete the table and reinitialize new one
if (!$mysqli->query("DROP TABLE IF EXISTS grocery") || !$mysqli->query("CREATE TABLE grocery(id INT( 7 ) NOT NULL AUTO_INCREMENT PRIMARY KEY, product_name VARCHAR( 225 ) NULL UNIQUE COMMENT 'must be unique' , catigory VARCHAR( 225 ), price DECIMAL( 5,2 ) UNSIGNED NOT NULL  ) ENGINE=MYISAM")) {
   echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

header('Location: index.php');

?>
