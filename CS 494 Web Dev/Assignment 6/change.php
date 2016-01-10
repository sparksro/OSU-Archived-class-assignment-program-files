<?php
ob_start();
//ini_set('display_errors','On');
include_once 'connect.php';

$catigory = $_POST["catigory"];
$increse = $_POST["increase"];
$decrese = $_POST["decrease"];
$percent = $_POST["percent"];
$per = ($percent/100);

/*error messages for both check or not checked increase and decrease*/
    //if($increse == 'on' && $decrese == 'on')   {
       // print "Error can not have both increase and decrease checked at the same time.";
        //print '<td> <form action="index.php"> <input type="submit" value="Return to form"></form></td>';
       // break;
       // }  
   // if(($increse != 'on') && ($decrese != 'on'))   {
       //print "Error need to check either increase or decrease.";
       // print '<td> <form action="index.php"> <input type="submit" value="Return to form"></form></td>';
       // break;
        //}  
/*increase and decrease*/
    //if($increse == 'on') {
       // $stmt = $mysqli->query("UPDATE grocery SET price=( price + price * '$per' ) WHERE catigory='$catigory'");
       // header('Location: index.php');
        //}
    //if($decrese == 'on') {
        //$stmt = $mysqli->query("UPDATE grocery SET price=( price - price * '$per' ) WHERE catigory='$catigory'");
       // header('Location: index.php');
       // }
       
 /*changed due to testing requirements -I did the precent a bit differently above changed to more simple form to 
 conform to test pattern.  I was increasing or decreasing by a check box and had error messages etc.  Its still all there
 just shut off. */      
     
     $stmt = $mysqli->query("UPDATE grocery SET price=( price * '$per' ) WHERE catigory='$catigory'");
     header('Location: index.php');  
     
        
?>
