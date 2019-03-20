<?php

require_once "connect.php";
require_once "klasser.php";


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

    $newProduct = new Product();
    $newProduct->createProduct($_POST['productName'], $_POST['productLine'], $_POST['productScale'], $_POST['productVendor'], 
    $_POST['productDescription'],$_POST['quantityInStock'], $_POST['buyPrice'], $_POST['MSRP']);
}

//-----------------------------UPPDATERA/REDIGERA PRODUKT----------------------------------------------------------//

//If user pressed update-button, collect information from array $_POST and put inside variables
if (isset($_POST['update'])) {
    $name = $_POST['productName'];
    $description = $_POST['productDescription'];
    $price = $_POST['MSRP'];
    $productVendor = $_POST['productVendor'];
    $productNumber = $_POST['productNumber'];

    $newProduct = new Product();
    $newProduct->updateProduct($_POST['productName'], $_POST['productDescription'], $_POST['MSRP'], $_POST['productVendor'],
    $_POST['productNumber']);

    //Send values from $_POST-array through the variables and update proper column in table products in the row which PK matches the productcode

    //  $sql = "UPDATE products SET productName ='" . $name . "', productDescription = '" . $description . "', 
    //  MSRP = '" . $price . "', productVendor ='" . $productVendor . "' WHERE productCode = '" . $productNumber. "'";
    //  $stmt = $pdo->prepare($sql); // prepare the pdo
    //  $stmt->execute(); // execute does the actual update

}


//----------------------------DELETE FUNKTIONALITET--------------------------------------------------//

if (isset($_POST['delete'])) {

    $productNumber = filter_input(INPUT_POST, 'productNumber', FILTER_SANITIZE_STRING);
    //$productNumber = $_POST['productNumber'];

    $sql = "DELETE FROM products WHERE productCode = '$productNumber'";

    $stmt = $pdo->prepare($sql); //create prepared statement that deletes row
    $stmt->execute(); //executes the actual deleting of the row
}






?>