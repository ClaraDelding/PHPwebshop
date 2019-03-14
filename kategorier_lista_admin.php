<?php

require_once "connect.php";

$stmt = $pdo->query("SELECT productLine FROM productLines");

foreach ($stmt as $kat) {
       
       echo "<p class='details'>";
       ?>
       <a href="produktlista_admin.php?productLine=<?php echo $kat['productLine']; ?>"><?php echo $kat['productLine']; ?></a><br>
       <?php
       echo "</p>";
}


?>

<!DOCTYPE <!DOCTYPE html>
 <html>
 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>Part 1 of R in CRUD</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" type="text/css" media="screen" href="produktlista.css">
     <script src="main.js"></script>
 </head>
 <body>
     <br><br><br><br><br>

     <?php //while ($row = $stmt->fetch()) {
    ?>
    <p> 
    <!--<a href="produktsida.php?product=<?php echo $row['productCode']; ?>"><?php echo $row['productName']; ?></a> - <?php echo $row['productLine']; ?><br>
    <p>
    <?php
    //} ?>
    
    <?php 
    //foreach ($stmt as $kat) {

// for ($i = 0; $i < 1; $i++) {
//     $kat;
//     echo "<p class='details'>";
//     //echo implode(", ", $kat);
//     ?>
//     <!-- <a href="produktlista.php?productLine=<?php echo $kat['productLine']; ?>"><?php echo $kat['productLine']; ?></a><br>
//     <?php
//     echo "</p>";
// }
// }
    ?>
 </body>
 </html>