<?php

require_once "connect.php";

//get product via URL, else give error message
if (isset($_GET['product'])) {
    $productCode = filter_input(INPUT_GET, 'product', FILTER_SANITIZE_ENCODED);
} else {
    echo "Sorry, there is no such product";
}

//prepare & execute statement, assign value to $productCode
$stmt = $pdo->prepare("SELECT * FROM classicmodels.products WHERE productCode = :product_code;");
$stmt->execute([ ':product_code' => $productCode]);

//PDO::FETCH_ASSOC returns result as associated array
$product = $stmt->fetchAll(PDO::FETCH_ASSOC);
$product = $product[0];

 ?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="produktlista.css">
        <title>Part 3 of R in CRUD</title>

    </head>

    <body>

        <!-- call keys and show their values from $product array -->
        <main>
            <article>          
                <section class="img">
                    <img src="<?php echo $product['productImage']; ?>">
                </section>
            <section class="details">
                <h2><?php echo $product['productName']; ?></h2>
                    <p><?php echo $product['productDescription']; ?></p>
                <h3><?php echo $product['MSRP']; ?>kr</h3>
                <input type="submit" value="Lägg i varukorg">
            </section>
        </article>
        </main>


    </body>
</html>



<?php


?>

<?php
// if (isset($_GET['product'])) {
//     $productCode = filter_input(INPUT_GET, 'product', FILTER_SANITIZE_ENCODED);
// } else {
//     $product = 'product_code';
// }



// $stmt = $pdo->prepare("SELECT * FROM classicmodels.products WHERE productCode = :product_code");

// $stmt->execute([':product_code' => $productCode]);

// $product = $stmt->fetchAll(PDO::FETCH_ASSOC);

// $product = $product[12];

?>

 <!DOCTYPE html>
 <!-- <html>
     <head>
         <script type="text/javascript" src="inlup.js"></script>
         <link rel="stylesheet" type="text/css" href="inlup.css">
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
     </head>

     <body>
         <main>
             <article>          
                 <section class="gallery">
                 <img src="<?php echo $product['productImage']; ?>">
                 </section>
                <section class="product-details">
                     <h2><?php echo $product['productName']; ?></h2>
                         <p><?php echo $product['productDescription']; ?></p>
                     <h3><?php echo $product['MSRP']; ?> $</h3>
                     <input type="submit" value="Lägg i varukorg">
                 </section>
             </article>
         </main>
     </body>
 </html> -->





