<?php

include_once "../includeAdmin/classes/productClass.php";

//Hämta lista över kategorier via metoden getProductLines i klassen Product
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
     <link rel="stylesheet" type="text/css" media="screen" href="../includeAdmin/css/header.css">
     <link rel="stylesheet" type="text/css" media="screen" href="../includeAdmin/css/main.css">
     <script src="main.js"></script>
 </head>
 <body>
    <?php 
    //inkludera header 
    require_once '../includeAdmin/other/header.php';
    ?>

     <br><br>
    
    <h2>Choose category to edit products in</h2>
    <!--loopa igenom productLines, hämta nästa rad för varja varv-->
    <?php while ($kat = $productLines->fetch()) {
    ?>
    <p>
    <a href="produktlista_admin.php?productLine=<?php echo $kat['productLine']; ?>"><?php echo $kat['productLine']; ?></a><br>
    <p>
    <?php
    } ?>

 </body>
 </html>


