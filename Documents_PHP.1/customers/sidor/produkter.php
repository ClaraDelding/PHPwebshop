<?php
session_start();

include_once "../includeCustomers/classes/productLineClass.php";
include_once "../includeCustomers/classes/productClass.php";
//hämta värdet för productLine via url:en. Stoppa in den i arrayen $_GET. Om värde saknas, echo else
if (isset($_GET['productLine'])) {
    $productLine = filter_input(INPUT_GET, 'productLine', FILTER_SANITIZE_STRING);
} else {
    echo "Sorry, there is no such ProductLine";
}
//skapa objekt med productLine som argument via $_GET
$product = new ProductLines($productLine);
//Kalla på metoden som listar alla produkter i den specifika produktlinjen
$productsInLine = $product->getProductsInLine();

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

    <?php include '../includeCustomers/other/header.php' ?>
       
        

        <aside class="mainChild aside">ASide vänster</aside>

        <main class="mainChild main"> 
            <div class="ngt">
            <h1> Produkter </h1>

                <div class="itemContainerMain">

                <?php while ($row = $productsInLine->fetch()) {
                ?>
                <div class="mainItem">
                <a href="enskildprodukt.php?product=<?php echo $row['productCode']; ?>"><?php echo $row['productName']; ?></a> -
                <?php echo $row['productLine']; ?><br>
                </div>
                <?php
                } ?>
            </div>

        </main>

        <aside class="mainChild aside">aside höger</aside>

        <footer class="mainChild footer">Footer</footer>
    </div>


</body>
</html>