<?php 
//include "connect.php";
include_once '../../genericInclude/classes/db.php';
include_once "../includeAdmin/classes/productClass.php";
//include "dbprocess.php";

//skapa nytt objekt av Product för att kunna hämta productCode.
$newProduct = new Product();
?>

<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>The C of CRUD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../includeAdmin/css/header.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../includeAdmin/css/main.css">
</head>
<body>
    <?php 
    require_once '../includeAdmin/other/header.php';
    ?>
<div class="form-wrap">
    <h1>Create new product</h1>
    <!-- send form to dbprocess for query-->
    <form action="dbprocess.php" method="POST">
        <label>Product Code</label><br>
        <input type="text" name="productCode" value="
        <?php echo $newProduct->productCode;?>
        "><br><br>
        <label>Product Name</label><br>
        <input type="text" name="productName" placeholder="Product name"><br><br>
        <label>Product line</label><br>
        <select name="productLine">
            <option name="productLine ">Motorcycles</option>
            <option name="productLine ">Classic Cars</option>
            <option name="productLine ">Planes</option>
            <option name="productLine ">Ships</option>
            <option name="productLine ">Trains</option>
            <option name="productLine ">Trucks & Buses</option>
            <option name="productLine ">Vintage Cars</option>
        </select><br><br>
        <label>Product scale</label><br>
        <input type="text" name="productScale" placeholder="Product scale"><br><br>
        <label>Product vendor</label><br>
        <input type="text" name="productVendor" placeholder="Vendor"><br><br>
        <label>Product description</label><br>
        <input type="text" rows="10"; name="productDescription"><br><br>
        <label>Quantity in stock</label><br>
        <input type="number" name="quantityInStock" placeholder="Quantity in stock"><br><br>
        <label>Buyprice</label><br>
        <input type="number" name="buyPrice" placeholder="Buyprice"><br><br>
        <label>Manufacturer's suggested retail price</label><br>
        <input type="number" name="MSRP" placeholder="MSRP"><br><br>
        <button type="submit" name="save">Save</button><br><br>
    </form>
</div>

</body>
</html> 