<?php
require_once "connect.php";

if (isset($_GET['productLine'])) {
    $productLine = filter_input(INPUT_GET, 'productLine', FILTER_SANITIZE_STRING);
} else {
    echo "Sorry, there is no such ProductLine";
}


$stmt = $pdo->prepare("SELECT * FROM products WHERE productLine = :productLine;");
$stmt->execute([':productLine' => $productLine]);


?>

<!DOCTYPE <!DOCTYPE html>
 <html>
 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>Part 2 of R in CRUD</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" type="text/css" media="screen" href="produktlista.css">
     <script src="main.js"></script>
 </head>
 <body>
 <p>Ändring</p>
     <br><br><br><br><br>

     <?php while ($row = $stmt->fetch()) {
    ?>
    <p> 
    <a href="produktsida.php?product=<?php echo $row['productCode']; ?>"><?php echo $row['productName']; ?></a> - <?php echo $row['productLine']; ?><br>
    <p>
    <?php
    } 
    ?>
    

    
 </body>
 </html>




<?php

