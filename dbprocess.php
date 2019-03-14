<?php

require_once "connect.php";

//----------------------------SKAPA PRODUKT -------------------------------------//

//If user pressed save-button, collect information from array $_POST and put inside variables
if (isset($_POST['save'])) {
    $productCode = $_POST['productCode'];
    $productName = $_POST['productName'];
    $productLine = $_POST['productLine'];
    $productScale = $_POST['productScale'];
    $productVendor = $_POST['productVendor'];
    $productDescription = $_POST['productDescription'];
    $quantityInStock = $_POST['quantityInStock'];
    $buyPrice = $_POST['buyPrice'];
    $MSRP = $_POST['MSRP'];

    //Send values from $_POST-array through the variables and insert into proper column in table products to create new row.

    $sql = "INSERT INTO products SET productCode ='" . $productCode . "', productName ='" . $productName . "', productLine ='" . $productLine . "', productScale ='" . $productScale . "',
    productVendor = '" . $productVendor . "', productDescription = '" . $productDescription . "', quantityInStock = '" . $quantityInStock . "',
    buyPrice = '" . $buyPrice . "', MSRP = '" . $MSRP . "'";

    $stmt = $pdo->prepare($sql); // create prepared statement that inserts values through variables to the specified columns
    $stmt->execute(); // executes the insert
}


//-----------------------------UPPDATERA PRODUKT----------------------------------------------------------//

//If user pressed update-button, collect information from array $_POST and put inside variables
if (isset($_POST['update'])) {
    $name = $_POST['productName'];
    $description = $_POST['productDescription'];
    $price = $_POST['MSRP'];
    $productNumber = $_POST['productNumber'];

    //Send values from $_POST-array through the variables and update proper column in table products in the row which PK matches the productcode

     $sql = "UPDATE products SET productName ='" . $name . "', productDescription = '" . $description . "', MSRP = '" . $price . "' WHERE productCode = '" . $productNumber. "'"; //OBS you need ' before and after variables to mark them as strings as the sql demands it
     $stmt = $pdo->prepare($sql); // prepare the pdo
     $stmt->execute(); // execute does the actual update

}


//----------------------------DELETE FUNKTIONALITET--------------------------------------------------//

if (isset($_POST['delete'])) {

    $productNumber = $_POST['productNumber'];

    $sql = "DELETE FROM products WHERE productCode = '$productNumber'";

    $stmt = $pdo->prepare($sql); //create prepared statement that deletes row
    $stmt->execute(); //executes the actual deleting of the row
}






?>