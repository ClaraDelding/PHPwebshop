<?php
    require_once "funktioner.php";

class Product extends Db {
    public $productCode;
    public $productName;
    public $productLine;
    public $productScale;
    public $productVendor;
    public $productDescription;
    public $quantityInStock;
    public $buyPrice;
    public $MSRP;
 
    function __construct($productCode = ""){

        if($productCode == "") {
            $db = new Db;
            $pdo = $db->connect();
            $getMaxID = $pdo->prepare("SELECT MAX(productCode) FROM products");
            $getMaxID->execute();
            $result = ($getMaxID->fetchColumn(0));      
            $this->productCode = substr($result, 0, 4).((int)substr($result, 4) + 1);
        } else {
            $this->productCode = $productCode;
        }
    }

    public function createProduct($productCode, $productName, $productLine, $productScale, $productVendor, $productDescription, $quantityInStock, $buyPrice, $MSRP) { 
        $this->productName = $productName;
        $this->productLine = $productLine;
        $this->productScale = $productScale;
        $this->productVendor = $productVendor;
        $this->productDescription = $productDescription;
        $this->quantityInStock = $quantityInStock;
        $this->buyPrice = $buyPrice;
        $this->MSRP = $MSRP; 
        $this->productCode = $productCode;

        $db = new Db;
        $pdo = $db->connect();

        // $sql = "INSERT INTO products SET productCode ='" . $this->productCode . "', productName ='" . 
        // $productName . "', productLine ='" . $productLine . "', productScale ='" . $productScale . "', productVendor = '" . 
        // $productVendor . "', productDescription = '" . $productDescription . "', quantityInStock = '" . $quantityInStock . "',
        // buyPrice = '" . $buyPrice . "', MSRP = '" . $MSRP . "'";

        // $stmt = $pdo->prepare($sql); 
        // $stmt->execute();

        $stmt = $pdo->prepare("INSERT INTO classicmodels.products (productCode, productName, productLine, productScale, productVendor,
         productDescription, quantityInStock, buyPrice, MSRP) 
        VALUES(:productCode, :productName, :productLine, :productScale, :productVendor, :productDescription, :quantityInStock, :buyPrice, :MSRP)");
        
        $stmt->bindValue(':productCode', $productCode, PDO::PARAM_STR);
        $stmt->bindValue(':productName', $productName, PDO::PARAM_STR);
        $stmt->bindValue(':productLine', $productLine, PDO::PARAM_STR);
        $stmt->bindValue(':productScale', $productScale, PDO::PARAM_STR);
        $stmt->bindValue(':productVendor', $productVendor, PDO::PARAM_STR);
        $stmt->bindValue(':productDescription', $productDescription, PDO::PARAM_STR);
        $stmt->bindValue(':quantityInStock', $quantityInStock, PDO::PARAM_INT);
        $stmt->bindValue(':buyPrice', $buyPrice, PDO::PARAM_INT);
        $stmt->bindValue(':MSRP', $MSRP, PDO::PARAM_INT);

    }

    public function getAllProducts() {
        $db = new Db;
        $pdo = $db->connect();

        $sql = "SELECT * FROM products";

        $getAllProducts =$pdo->prepare($sql);
        $getAllProducts->execute();

        return $getAllProducts;
    }

    public function getProduct() {
        $db = new Db;
        $pdo = $db->connect();

        $sql = "SELECT * FROM products WHERE productCode = '" . $this->productCode . "'";

        $getProduct = $pdo->prepare($sql); 
        $getProduct->execute();
        
        $rows = $getProduct->fetchAll(PDO::FETCH_ASSOC);

        $this->productName = $rows[0]["productName"];
        $this->productLine = $rows[0]["productLine"];
        $this->productScale = $rows[0]["productScale"];
        $this->productVendor = $rows[0]["productVendor"];
        $this->productDescription = $rows[0]["productDescription"];
        $this->quantityInStock = $rows[0]["quantityInStock"];
        $this->buyPrice = $rows[0]["buyPrice"];
        $this->MSRP = $rows[0]["MSRP"];
    }

    public function updateProduct($productName, $productDescription, $MSRP, $productVendor) {
        $this->productName = $productName;
        $this->productDescription =$productDescription;
        $this->MSRP = $MSRP;
        $this->productVendor = $productVendor;

        $db = new Db;
        $pdo = $db->connect();

        $sql = "UPDATE products SET productName ='" . $productName . "', productDescription = '" . $productDescription . "', 
        MSRP = '" . $MSRP . "', productVendor ='" . $productVendor . "' WHERE productCode = '" . $productCode. "'";
        $stmt = $pdo->prepare($sql); // prepare the pdo
        $stmt->execute(); // execute does the actual update

        // $stmt = $pdo->prepare("UPDATE products SET productName = :productName, productDescription = :productDescription, 
        // MSRP = :MSRP, productVendor = :productVendor WHERE productCode = :productNumber ");

        // $stmt->bindValue(':productName', $productName, PDO::PARAM_STR);
        // $stmt->bindValue(':productDescription', $productDescription, PDO::PARAM_STR);
        // $stmt->bindValue(':MSRP', $MSRP, PDO::PARAM_STR);
        // $stmt->bindValue(':productVendor', $productVendor, PDO::PARAM_STR);
        // $stmt->bindValue(':productNumber', $this->productCode, PDO::PARAM_STR);
        // $stmt->execute();
     
    }

    public function deleteProduct() {
        $db = new Db;
        $pdo = $db->connect();

        // $sql = "DELETE FROM products WHERE productCode = '" . $this->productCode . "'";

        // $deleteProducts = $pdo->prepare($sql);
        // $deleteProducts->execute();

        $stmt = $pdo->prepare("DELETE FROM products WHERE productCode = :productCode;");
        $stmt->execute([':productCode' => $productCode]);
    }

    public function getProductsInLine() {
        $db = new Db;
        $pdo = $db->connect();

        // $sql = "SELECT * FROM products WHERE productLine = '" . $this->productLine . "'";

        // $getProductLine = $pdo->prepare($sql);
        // $getProductLine->execute();

        $stmt = $pdo->prepare("SELECT * FROM products WHERE productLine = :productLine;");
        $stmt->execute([':productLine' => $productLine]);

        //$rows = $getProductLine->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductLines() {
        $db = new Db;
        $pdo = $db->connect();

        $sql = "SELECT productLine FROM productLines";

        $getProductLines = $pdo->prepare($sql);
        $getProductLines->execute();

        return $getProductLines;

    }

}
?>
