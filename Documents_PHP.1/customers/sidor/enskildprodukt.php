<?php

include_once "../includeCustomers/classes/productClass.php";

//hämta produktkod via url för att kunna skapa objektet $products nedan
if (isset($_GET['product'])) {
    // $productCode = filter_input(INPUT_GET, 'product', FILTER_SANITIZE_ENCODED);
    $productCode = $_GET['product'];
} else {
    echo "Sorry, there is no such product";
}
//instantiera klassen Product med hjälp av värdet från $_GET
$product = new Product($productCode);
$product->getProduct();



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Design</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../includeCustomers/css/design.css">
    <script src="main.js"></script>
</head>
<body>

    <div class="container">
        <!--inkludera header -->
       <?php include_once '../includeCustomers/other/header.php' ?>
       
        

        <aside class="mainChild aside">Aside vänster</aside>

        <main class="mainChild main">
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
                    <input type="submit" value="Lägg i varukorg" name="lägg till i varukorgen">
                </a>
            </article>
       </main>

        <aside class="mainChild aside">aside höger</aside>

        <footer class="mainChild footer">Footer</footer>
    </div>

</body>
</html>