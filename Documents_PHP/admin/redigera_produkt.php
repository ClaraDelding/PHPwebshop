<?php

include "../include/generic/connect.php";
include "../include/dbprocess.php";

//hämta värdena för de kolumner som ska redigeras via $_GET metoden (url via dynamisk länk från föregående sida)
if (isset($_GET['product'])) {
    $name = $_GET['productName'];
    $description = $_GET['productDescription'];
    $price = $_GET['MSRP'];
    $productCode = $_GET['product'];
    $productVendor = $_GET['productVendor'];

}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>The U in CRUD</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" media="screen" href="../include/css/template.css">
        <link rel="stylesheet" type="text/css" media="screen" href="../include/css/skapa_produkt.css">
    </head>

    <body>

    <?php 
    include "../include/generic/design.php";
    ?>
    <!--OBS ÄNDRA PATH I FORM ACTION OCKSÅ??????-->
    <!--echoa ut alla värden i rutorna som placeholder-värden. När formuläret submittas, skicka till dbprocess för att utföra olika metoder-->
    <form action="../include/dbprocess.php" method="post">
    <h2>Redigera produkt</h2>
    
    <label>ProductNumber</label><br>
    <input type="text" name="productCode" readonly value="
<?php
    echo $productCode;
?>    
    "><br><br>
    <label>Produktnamn</label><br>
    <input type="text" name="productName" placeholder="Produktnamn" value="
<?php
    echo $name;
?>    
    "><br><br>
    <label>Beskrivning</label><br>
    <input type="text" name="productDescription" placeholder="Beskrivning" value="
<?php
    echo $description;
?>    
    "><br><br>
    <label>Pris</label><br>
    <input type="text" name="MSRP" placeholder="Fyll i Pris" value="
<?php
    echo $price;
?>
    "><br><br>
    <label>ProductVendor</label><br>
    <input type="text" name="productVendor"  value="
    <?php 
    echo $productVendor;
?>  "><br><br> 
    <input type="submit" value="update" name="update"><br><br>
    <!--<a href="dbprocess.php?product=<?php echo $productNumber['productCode']; ?>&productName=<?php echo $product['productName']; ?>
    &productDescription=<?php echo $product['productDescription']; ?>&MSRP=<?php echo $product['MSRP']; ?>
    &productVendor=<?php echo $product['productVendor'] ?>">-->
    <input type="submit" value="Delete product" name="delete">
    </a>
</form>