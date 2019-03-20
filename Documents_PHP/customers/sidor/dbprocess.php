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
    $newProduct->createProduct($_POST['productCode'], $_POST['productName'], $_POST['productLine'], $_POST['productScale'], $_POST['productVendor'], 
    $_POST['productDescription'],$_POST['quantityInStock'], $_POST['buyPrice'], $_POST['MSRP']);
}

//-----------------------------UPPDATERA/REDIGERA PRODUKT----------------------------------------------------------//

//If user pressed update-button, collect information from array $_POST and put inside variables
//Fungerar ej som objektorienterad. Utkommenterad kod nedan funkar.
if (isset($_POST['update'])) {
    $productName = filter_input(INPUT_POST, 'productName', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'productDescription', FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, 'MSRP', FILTER_SANITIZE_NUMBER_INT);
    $productVendor = filter_input(INPUT_POST, 'productVendor', FILTER_SANITIZE_STRING);
    $productCode = filter_input(INPUT_POST, 'productCode', FILTER_SANITIZE_STRING);

    $newProduct = new Product();
    $newProduct->updateProduct($_POST['productName'], $_POST['productDescription'], $_POST['MSRP'], $_POST['productVendor'],
    $_POST['productCode']);

    //OBS nedanstående kod funkar, men är ej objektorienterad
    //  $sql = "UPDATE products SET productName ='" . $productName . "', productDescription = '" . $description . "', 
    //  MSRP = '" . $price . "', productVendor ='" . $productVendor . "' WHERE productCode = '" . $productCode. "'";
    //  $stmt = $pdo->prepare($sql); // prepare the pdo
    //  $stmt->execute(); // execute does the actual update

}


//----------------------------DELETE FUNKTIONALITET--------------------------------------------------//

if (isset($_POST['delete'])) {

    $productNumber = filter_input(INPUT_POST, 'productNumber', FILTER_SANITIZE_STRING);
    //$productNumber = $_POST['productNumber'];

    $sql = "DELETE FROM products WHERE productCode = '$productNumber'";

    $stmt = $pdo->prepare($sql); //prepared statement tar bort raden via ovan sql-statement
    $stmt->execute(); //tar bort raden
}






?>