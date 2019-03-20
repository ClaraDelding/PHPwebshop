<?php
include "../include/dbklass.php";
include "../include/klasser.php";
include "../include/dbprocess.php";

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
        include "../include/generic/design.php";
    ?>
       <main>
       <article>
       <section class="product-details">
               <h2><?php echo $product->productName; ?></h2>
               <p><?php echo $product->productDescription; ?></p>
              <h3><?php echo $product->MSRP; ?>kr</h3>
       </section>
       <a href="redigera_produkt.php?product=<?php echo $product->productCode; ?>&productName=<?php echo $product->productName;?>
                &productDescription=<?php echo $product->productDescription; ?>&MSRP=<?php echo $product->MSRP; ?>&productVendor=
                <?php echo $product->productVendor; ?>">
        <input type="button" value="edit product" name="edit">
       </a>
   </article>
       </main>
   </body>
</html>

<?php

