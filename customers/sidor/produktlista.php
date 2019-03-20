<?php

require_once "funktioner.php";
require_once "klasser.php";
require_once "temporary.php";

//Hämta värdet för productLine via url:en, stoppa in i arrayen $_GET
if (isset($_GET['productLine'])) {
    $productLine = filter_input(INPUT_GET, 'productLine', FILTER_SANITIZE_STRING);
} else {
    echo "Sorry, there is no such ProductLine";
}

//skapa objekt av klassen ProductLines med värdet i  $_GET som argument
$lines = new ProductLines($_GET['productLine']);
//kalla på funktionen som listar alla produkter i en specifik produktlinje
$productsInLine = $lines->getProductsInLine();

?>
 
<!DOCTYPE <!DOCTYPE html>
 <html>
 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>Part 2 of R in CRUD</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" type="text/css" media="screen" href="produktlista.css">
 </head>
 <body>
     <br><br>
    <!--loopa igenom arrayen med produkter, lägg in dem i dynamiska länkar som leder till respektive produktsida-->
     <?php while ($row = $productsInLine->fetch()) {
    ?>
    <p> 
    <a href="produktsida.php?product=<?php echo $row['productCode']; ?>"><?php echo $row['productName']; ?></a> -
     <?php echo $row['productLine']; ?><br>
    <p>
    <?php
    } ?>
    
  
 </body>
 </html>



