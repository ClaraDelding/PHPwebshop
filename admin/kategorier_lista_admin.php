<?php

include "connect.php";
include "klasser.php";
include "dbprocess.php";
include "temporary.php";


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
    <?php 
    include "design.php";
    ?>

     <br><br>
    
    <h2>Choose category to edit products in</h2>

    <?php while ($kat = $productLines->fetch()) {
    ?>
    <p> 
    <a href="produktlista_admin.php?productLine=<?php echo $kat['productLine']; ?>"><?php echo $kat['productLine']; ?></a><br>
    <p>
    <?php
    } ?>

 </body>
 </html>


<?php

// require_once "connect.php";

// $stmt = $pdo->query("SELECT productLine FROM productLines");


?>

<!-- <!DOCTYPE <!DOCTYPE html>
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
        //  foreach ($stmt as $kat) {
       
        //     echo "<p class='details'>";
        //     ?>
        //     <a href="produktlista_admin.php?productLine=<?php //echo $kat['productLine']; ?>"><?php //echo $kat['productLine']; ?></a><br>
        //     <?php
        //     echo "</p>";
     //}
    ?>
    
 </body>
 </html> -->