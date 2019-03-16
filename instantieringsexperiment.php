<?php
require_once "funktioner.php";
require_once "klasser.php";
require_once "connect.php";

$pdo = connect();

$test = new Product;
$test->productCode = "S12_1099";
$result = $test->getProduct($pdo);

$result->fetch();

//var_dump($test);

?>

<!DOCTYPE html>
<html>
   <head>
       <script type="text/javascript" src="inlup.js"></script>
       <link rel="stylesheet" type="text/css" href="inlup.php">
       <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
   </head>
   <body>
       <main>
       <article>
       <section class="product-details">
               <h2><?php echo $test->$product['productName']; ?></h2>
               <p><?php echo $test->$product['productDescription']; ?></p>
              <h3><?php echo $test->$product['MSRP']; ?>kr</h3>
              <input type="submit" value="Lägg i varukorg">
       </section>
   </article>
       </main>
   </body>
</html>