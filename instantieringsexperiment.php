<?php

require_once "funktioner.php";
require_once "klasser.php";
require_once "temporary.php";

//$stmt = $pdo->query("SELECT productLine FROM productLines");

$lines = new ProductLines;

$productLines = $lines->getProductLines();

var_dump($productLines);

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

     <?php
         foreach ($stmt as $kat) {
       
            echo "<p class='details'>";
            ?>
            <a href="instantieringsexperiment.php?productLine=<?php echo $kat['productLine']; ?>"><?php echo $kat['productLine']; ?></a><br>
            <?php
            echo "</p>";
     }
    ?>
    
 </body>
 </html>
