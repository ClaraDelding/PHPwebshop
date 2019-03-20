<?php

include "productLineKlass.php";

//hämta värdet för productLine via url:en. Stoppa in den i arrayen $_GET. Om värde saknas, echo else
if (isset($_GET['productLine'])) {
    $productLine = filter_input(INPUT_GET, 'productLine', FILTER_SANITIZE_STRING);
} else {
    echo "Sorry, there is no such ProductLine";
}
//skapa objekt med productLine som argument via $_GET
$lines = new ProductLines($_GET['productLine']);
//Kalla på metoden som listar alla produkter i den specifika produktlinjen
$productsInLine = $lines->getProductsInLine();

?>
 
<!DOCTYPE <!DOCTYPE html>
 <html>
 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>Part 2 of R in CRUD</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
 </head>
 <body>
    <?php 
    //inkludera header//
    include "design.php";
    ?>
     <br><br>
     <h2>Choose product to edit</h2>
    <!-- loopa igenom arrayen med produkterna, lägg dem i dynamiska länkar som leder till respektive produktsida-->
     <?php while ($row = $productsInLine->fetch()) {
    ?>
    <p> 
    <a href="produktsida_admin.php?product=<?php echo $row['productCode']; ?>"><?php echo $row['productName']; ?></a> -
     <?php echo $row['productLine']; ?><br>
    <p>
    <?php
    } ?>
    
 </body>
 </html>




