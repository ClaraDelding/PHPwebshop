<?php
require_once "dbklass.php";
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Design</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="design.css">
    <script src="main.js"></script>
</head>
<body>
    <div class="container">
        <?php include 'header.php' ?>
    </div>
    
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
</div>

    <!-- <div class="container">
       
        <aside class="mainChild aside">ASide vänster</aside>


        <main class="mainChild main"> 
            <div class="ngt">
                <h1> Produkter </h1>

                <div class="itemContainerMain">


                    <div class="mainItem" >
                    <h2><?php //echo $product->productName; ?></h2>
                    <p><?php //echo $product->productDescription; ?></p>
                    <h3><?php// echo $product->MSRP; ?>kr</h3>
                    <input type="submit" value="Lägg i varukorg">
                    </div>
                  
                </div>
            </div>

        </main>

        <aside class="mainChild aside">aside höger</aside>

        <footer class="mainChild footer">Footer</footer>
    </div> -->



    <!-- <div class="footer-inner">
  <div>One</div>
  <div>Two</div>
  <div>Three</div>
  <div>Four</div>
</div> -->

</body>
</html>





