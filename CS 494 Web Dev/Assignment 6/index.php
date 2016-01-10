<?php
ini_set('display_errors','On');
include 'connect.php';

print '<!DOCTYPE html><html lang="en"><head><meta charset="utf-8" /><title>grocery data base interface</title></head><body>';

//select query
$results = $mysqli->query("SELECT id, product_name, catigory, price FROM grocery");
/* Current inventory table*/
    Print '<h3>Grocery Data Base</h3>';
    Print '<h4>Current Inventory</h4>';
    print '<table border="1">';
    print '<tr>';
    print '<th> Id# </th>';
    print '<th> Product </th>';
    print '<th> Catigory </th>';
    print '<th> Price </th>';
    print '<th> </th>';
    print '</tr>';
    print '<section>';
    while($row = $results->fetch_assoc()) {
    print '<tr>';
    print '<td>'.$row ["id"].'</td>';
    //$item_id=$row ["id"];
    print '<td>'.$row ["product_name"].'</td>';
    print '<td>'.$row ["catigory"].'</td>';
    print '<td>'.$row ["price"].'</td>';
    /*delete item */
    print '<td> <form method="POST"action="delete.php"><input type="number" name="id" min="1" max="5000"required ></input> <input type="submit" value="Delete" ></form></td>';
}
    echo "To delete: enter ID # in box as confirmation and hit delete.";
    print '</table>';
    
/*change price of a catigory*/
    print '<section>';
    print '<h4>Change catigory price </h4>';
    print '<form action="change.php" method="POST">';
    /* drop down catigory select loop*/
    $results = $mysqli->query("SELECT id, product_name, catigory, price FROM grocery");    
        print 'Select the catigory  <select name="catigory" required >';
       while($row = $results->fetch_assoc()) {
            print '<option>'.$row ["catigory"].'</option>';}
        print '</select><br>';
    print 'Enter percent price change as a whole number. Example: 10% = 10<br>';
    print '% <input type="number" name="percent" min="1" max="500" required> </input><br>';
    //print 'Check increase <input type="checkbox" name="increase"></input>or decrease <input type="checkbox" name="decrease"></input><br>';
    print '<td> <form action="change.php"> <input type="submit" value="Change"></form></td>';
    print '</input></form></section>';
    print '</section>';
    
/*add inventory form*/
    print '<section>';
    print '<h4>Add to Inventory</h4>';
    print '<form action="add.php" method="POST">';
    print 'Enter product name: <input type="text" name="product_name" required></input><br>';
    print 'Enter product catigory: <input type="text" name="catigory"></input><br>'; 
    print 'Enter price (numbers only) value between 0.01 and 999.99<br>';
    print '$ <input type="number" name="price" min="0.00" step="0.01" max="999.99" required title="Numbers only please" > </input><br>';
    print '<td> <form action="add.php"> <input type="submit" value="Add Prouct"></form></td>';
    print '</input></form></section>';
    print '<section>';
    
/*reset the data base*/
    print '<h5>Reset the Data Base to Zero Inventory </h5>';
    print 'Delete all products';
    print '<td> <form action="reset.php"> <input type="submit" value="Reset"></form></td>';
    print '</input></form></section>';
    print '</body></html>';

?>
