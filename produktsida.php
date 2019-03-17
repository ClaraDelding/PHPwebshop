<?php
require_once "funktioner.php";
require_once "klasser.php";

if (isset($_GET['product'])) {
    $productCode = filter_input(INPUT_GET, 'product', FILTER_SANITIZE_ENCODED);
} else {
    echo "Sorry, there is no such product";
}

$product = new Product($_GET['product']);
$product->getProduct();

?>

<!DOCTYPE html>
<html>
   <head>
       <link rel="stylesheet" type="text/css" href="produktlista.css">
       <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1">
   </head>
   <body>
       <main>
       <article>
       <section class="product-details">
               <h2><?php echo $product->productName; ?></h2>
               <p><?php echo $product->productDescription; ?></p>
              <h3><?php echo $product->MSRP; ?>kr</h3>
              <input type="submit" value="Lägg i varukorg">
       </section>
   </article>
       </main>
   </body>
</html>





