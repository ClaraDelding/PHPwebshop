<?php

require_once "connect.php";
require_once "dbprocess.php";

if (isset($_GET['product'])) {
    $name = $_GET['productName'];
    $description = $_GET['productDescription'];
    $price = $_GET['MSRP'];
    $productNumber = $_GET['product'];
    $productVendor = $_GET['productVendor'];

}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>The U in CRUD</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="produktlista.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>

    <form action="dbprocess.php" method="post">
    <h2>Redigera produkt</h2>
    
    <label>ProductNumber</label><br>
    <input type="text" name="productNumber" readonly value="
<?php
    echo $productNumber;      /*Fills in the value of product number from the database.*/
?>    
    "><br><br>
    <label>Produktnamn</label><br>
    <input type="text" name="productName" placeholder="Produktnamn" value="
<?php
    echo $name; /*Fills in the value of name from the database*/
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
    echo $price;      /*Fills in the value of price from the database*/
?>
    "><br><br>
    <label>ProductVendor</label><br>
    <input type="text" name="ProductVendor"  value="
<?php
    echo $productVendor;      /*Fills in the value of price from the database.*/
?>  "><br><br> 
    <input type="submit" value="update" name="update"><br><br>
    <!-- <a href="dbprocess.php?product=<?php echo $productNumber['productCode']; ?>&productName=<?php echo $product['productName']; ?>&productDescription=<?php echo $product['productDescription']; ?>&MSRP=<?php echo $product['MSRP']; ?>&productVendor=<?php echo $product['productVendor'] ?>">-->
    <input type="submit" value="Delete product" name="delete">
    </a>
</form>

<!--Skicka delete-info via post eller get??-->
<!-- <section>
    <a href="dbprocess.php?product=<?php echo $productNumber['productCode']; ?>&productName=<?php echo $product['productName']; ?>&productDescription=<?php echo $product['productDescription']; ?>&MSRP=<?php echo $product['MSRP']; ?>&productVendor=<?php echo $product['productVendor'] ?>">
    <input type="button" value="Delete product" name="delete">
    </a>
</section>-->

    </body>
</html>

<!-- <!DOCTYPE html>
<html>
    <head>
        <title>The U in CRUD</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="produktlista.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>

    <form action="dbprocess.php" method="post">
    <h2>Redigera produkt</h2>
    <label>Produktnamn</label><br>
    <input type="text" name="Produktnamn" placeholder="Produktnamn" value="
<?php

    echo $name; /*Fills in the value of name from the database*/
?>    
    "><br><br>
    <label>Beskrivning</label><br>
    <input type="text" name="Beskrivning" placeholder="Beskrivning" value="
<?php
    
    echo $description;
?>    
    "><br><br>
    <label>Pris</label><br>
    <input type="text" name="Pris" placeholder="Fyll i Pris" value="
<?php
    echo $price;      /*Fills in the value of price from the database*/
?>

    "><br><br>
    <label>Produktnummer</label><br>
    <input type="text" name="Produktnummer" readonly value="

<?php
    echo $productNumber;      /*Fills in the value of price from the database.*/
?>    

    "><br><br>
    <!-- <label>Produktbild</label>
    <input type="file" name="upload" id="upload"> -->

    <!--<input type="submit" value="update">
</form>




    </body>
</html> -->