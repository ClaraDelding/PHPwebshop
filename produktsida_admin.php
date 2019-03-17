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

// require_once "connect.php";


// if (isset($_GET['product'])) {
//     $productCode = filter_input(INPUT_GET, 'product', FILTER_SANITIZE_ENCODED);
// } else {
//     echo 'Sorry, there is no such product';
// }

// $stmt = $pdo->prepare("SELECT * FROM classicmodels.products WHERE productCode = :product_code;");

// $stmt->execute([ ':product_code' => $productCode]);

// $product = $stmt->fetchAll(PDO::FETCH_ASSOC);

// $product = $product[0];

 ?>

<!-- <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="produktlista.css">


    </head>

    <body>
        <main>
            <article>          
                <section class="img">
                    <img src="<?php echo $product['productImage']; ?>">
                </section>
                <section class="details">
                    <h2><?php echo $product['productName']; ?></h2>
                        <p><?php echo $product['productDescription']; ?></p>
                    <h3><?php echo $product['MSRP']; ?>kr</h3>
                </section>
                <section>  
                    <!-- <a href="redigera_produkt.php?product=<?php echo $product['productCode']; ?>&productName=<?php echo $product['productName']; ?>&productDescription=<?php echo $product['productDescription']; ?>&MSRP=<?php echo $product['MSRP']; ?>">
                    <input type="button" value="edit product" name="edit">
                    </a> -->
                    <!-- <a href="redigera_produkt.php?product=<?php echo $product['productCode']; ?>&productName=<?php echo $product['productName']; ?>&productDescription=<?php echo $product['productDescription']; ?>&MSRP=<?php echo $product['MSRP']; ?>&productVendor=<?php echo $product['productVendor'] ?>">
                    <input type="button" value="edit product" name="edit">
                    </a>
                </section>
                <section>
                    <a href="dbprocess.php?product=<?php echo $product['productCode']; ?>">        
                </section>
            </article>
        </main>

    </body>
</html> --> -->



<?php

?>
