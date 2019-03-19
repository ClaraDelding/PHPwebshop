<?php

require_once "connect.php";
require_once "klasser.php";
require_once "dbprocess.php";
require_once "temporary.php";

//$stmt = $pdo->query("SELECT productLine FROM productLines");

$lines = new Product();

$productLines = $lines->getProductLines();

?>

<!DOCTYPE <!DOCTYPE html>
 <html>
 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>Part 1 of R in CRUD</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" type="text/css" media="screen" href="produktlista.css">
     <script src="main.js"></script>
 </head>
 <body>
     <br><br>

    <?php while ($kat = $productLines->fetch()) {
    ?>
    <p> 
    <a href="produktlista.php?productLine=<?php echo $kat['productLine']; ?>"><?php echo $kat['productLine']; ?></a><br>
    <p>
    <?php
    } ?>

 </body>
 </html>