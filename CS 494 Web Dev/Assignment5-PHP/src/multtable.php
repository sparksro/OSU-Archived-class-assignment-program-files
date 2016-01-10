<!--
<?php
//Rob Sparks CS 494
error_reporting(E_ALL);
ini_set('display_errors','On');
?>
-->
<!DOCTYPE html>
<html>
 <head>
  <title>Assignment 4 mult table</title>
 </head>
 <body>
 
<!--
<form action="multtable.php" method="GET">
 <p>Please enter a min multiplicand</p>
  <input type="text" name="min-multiplicand" /></p>
  <p>Please enter a max multiplicand</p>
  <input type="text" name="max-multiplicand" /></p>
  <p>Please enter a min multiplier</p>
  <input type="text" name="min-multiplier" /></p>
  <p>Please enter a max multiplier</p>
  <input type="text" name="max-multiplier" /></p>
 <p><input type="submit" name="Submit1" value="Submit" /></p>
</form>
-->
<?php

//asign GET values to internal values

$min_multiplicand = $_GET['min-multiplicand'];
$max_multiplicand = $_GET['max-multiplicand'];
$min_multiplier = $_GET['min-multiplier'];
$max_multiplier = $_GET['max-multiplier'];

//error check min-multiplicand
    if ( !is_numeric($min_multiplicand)) {
        echo "'{$min_multiplicand}' Min multiplicand is not a number!";
        echo "<br/>";
        }
    if ($min_multiplicand <= 0) {echo "Min multiplicand should be greater than zero!";
    echo "<br/>";}
    if ($min_multiplicand == NULL) {echo "Min multiplicand is missing!";
    echo "<br/> <br/>";}
//error check max-multiplicand and complare min and max
    if ( !is_numeric($max_multiplicand)) {
        echo "'{$max_multiplicand}' Max multiplicand is not a number!";
        echo "<br/>";}
    if ($max_multiplicand <= 0) {
        echo "Max multiplicand should be greater than zero!";
        echo "<br/>";}
    if ($max_multiplicand == NULL) {echo "Max multiplicand is missing!";
        echo "<br/> <br/>";}    
    if ($max_multiplicand < $min_multiplicand) {
        echo "Min multiplicand needs to be smaller than or equal to max multiplicand!";echo "<br/>";
        }

   //else {echo "Your min multiplicand is: {$min_multiplicand}<br>";echo "<br/>";
       //echo "Your max multiplicand is: {$max_multiplicand}<br>";echo "<br/>"; }


//error check min-multiplier
    if ( !is_numeric($min_multiplier)) {
        echo "'{$min_multiplier}' Min multiplier is not a number!";
        echo "<br/>";}
    if ($min_multiplier <= 0) {
        echo "Min multiplier should be greater than zero!";
        echo "<br/>";}
    if ($min_multiplier == NULL) {echo "Min multiplier is missing!";
    echo "<br/> <br/>";}   
//error check max-multiplier and complare min and max   
    if ( !is_numeric($max_multiplier)) {
        echo "'{$max_multiplier}' Max multiplier is not a number!";echo "<br/>";
        }
    if ($max_multiplier <= 0) {
        echo "Max Multiplier should be greater than zero!";
        echo "<br/>";
        }
    if ($max_multiplier == NULL) {echo "Max multiplier is missing!";
    echo "<br/> <br/>";}    
    if ($max_multiplier < $min_multiplier) {
        echo "Min multiplier needs to be smaller than or equal to max multiplier!";
        echo "<br/>";}
   
        //else {echo "Your min multiplier is: {$min_multiplier}<br>";echo "<br/>";
             //echo "Your max multiplier is: {$max_multiplier}<br>";echo "<br/>";
        //} 
if (($min_multiplicand > 0) && ($max_multiplicand > 0) && ($min_multiplier > 0) && ($max_multiplier)) {

    
    $wide = $max_multiplicand - $min_multiplicand + 1;
    $tall = $max_multiplier - $min_multiplier + 1;
    //$wide = 3;
    //$tall = 7;
    //echo $min_multiplier .PHP_EOL;
echo "<table border='1'><thead><tr><th>         </th>";
        $i = 0;
        while($i < $tall) {
        $hrow = $min_multiplier +$i; 
        echo "<th> $hrow </th>";
        $i++;
        }
        echo "</tr></thead>";     
            $j = 0;
            
        while($j < $wide) {
            $hcoll = $min_multiplicand +$j;
            echo "<th> $hcoll </th>";
            $j++;
                $k = 0;
                while($k < $tall) {
                $row = $min_multiplicand +$k;
                $mult = $min_multiplier+$k;
                $product = $mult * $hcoll; 
                echo "<td>$product</td>";
                $k++;
                }
        echo "</tr></thead>"; 
        }
    echo "</table>";
 }   
?>

 </body>
</html>

