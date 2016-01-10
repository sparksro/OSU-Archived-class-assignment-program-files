<?php
include 'connect.php';

$product_name = $_POST["product_name"];
$catigory = $_POST["catigory"];
$price = $_POST["price"];

/*add via query*/
if (!($stmt = $mysqli->query("INSERT INTO grocery(id, product_name, catigory, price) VALUES (NULL, '$product_name', '$catigory', '$price DECIMAL(5,2)')"))) {
  
   if ($mysqli->errno == 1062){echo "Error: Product_name must be unique";}
   if ($mysqli->errno != 1062){echo "An entry error occured";}
    print '<td> Press to return <form action="index.php"> <input type="submit" value="Return to form"></form></td>';
    }
      
header('Location: index.php');
?>
