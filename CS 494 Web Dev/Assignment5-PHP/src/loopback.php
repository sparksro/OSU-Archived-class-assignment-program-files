<?php
//Rob Sparks CS 494
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
header('Content-Type: text/plain');

if($_GET != NULL) {
    $jsonOb = json_encode($_GET);
    echo $jsonOb;
    return $jsonOb;
}

if($_POST != NULL) {
    $jsonOb = json_encode($_POST);
    echo $jsonOb;
    return $jsonOb;
} 
 
?>


