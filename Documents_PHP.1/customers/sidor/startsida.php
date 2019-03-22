<?php
session_start();

require_once "../includeCustomers/classes/productClass.php";

//skapa objektet att loopa genom nedan
$lines = new Product();
$productLines = $lines->getProductLines();
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

    <?php require_once '../includeCustomers/other/header.php' ?>
        <aside class="mainChild aside">Aside vänster</aside>

        <main class="mainChild main"> 
            <div class="ngt">
            <h1> Kategorier </h1>

                <div class="itemContainerMain">

                <?php 

                while ($kat = $productLines->fetch()) {
                ?>
                <div class="mainItem">
                <a href="produkter.php?productLine=<?php echo $kat['productLine']; ?>"><?php echo $kat['productLine']; ?></a><br>
                <div>
                <?php
                } ?>
                  
                </div>
            </div>

        </main>

        <aside class="mainChild aside">aside höger</aside>

        <footer class="mainChild footer">Footer</footer>
    </div>
</body>
</html>