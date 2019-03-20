<?php
include "klasser.php";

//hämta produktkod via url för att kunna instantiera objektet nedan
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
    <?php 
        //inkludera header
        include "design.php";
    ?>
       <main>
       <article>
           <!--echoa ut värden från valda produkten-->
       <section class="product-details">
               <h2><?php echo $product->productName; ?></h2>
               <p><?php echo $product->productDescription; ?></p>
              <h3><?php echo $product->MSRP; ?>kr</h3>
       </section>
       <!-- gör länk som leder till redigeringsssida för produkt, skicka med värden från aktuella produkten via echo -->
       <a href="redigera_produkt.php?product=<?php echo $product->productCode; ?>&productName=<?php echo $product->productName;?>
                &productDescription=<?php echo $product->productDescription; ?>&MSRP=<?php echo $product->MSRP; ?>&productVendor=
                <?php echo $product->productVendor; ?>">
        <!-- gör länken till en knapp -->
        <input type="button" value="edit product" name="edit">
       </a>
   </article>
       </main>
   </body>
</html>

<?php

