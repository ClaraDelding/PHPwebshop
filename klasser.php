<?php
    //require_once "connect.php";
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

    public function createProduct($productName, $productLine, $productScale, $productVendor, $productDescription, $quantityInStock, $buyPrice, $MSRP) { 
        $this->productName = $productName;
        $this->productLine = $productLine;
        $this->productScale = $productScale;
        $this->productVendor = $productVendor;
        $this->productDescription = $productDescription;
        $this->quantityInStock = $quantityInStock;
        $this->buyPrice = $buyPrice;
        $this->MSRP = $MSRP; 

        $db = new Db;
        $pdo = $db->connect();

        $sql = "INSERT INTO products SET productCode ='" . $this->productCode . "', productName ='" . 
        $productName . "', productLine ='" . $productLine . "', productScale ='" . $productScale . "', productVendor = '" . 
        $productVendor . "', productDescription = '" . $productDescription . "', quantityInStock = '" . $quantityInStock . "',
        buyPrice = '" . $buyPrice . "', MSRP = '" . $MSRP . "'";

        $stmt = $pdo->prepare($sql); 
        $stmt->execute();
        
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

    public function updateProduct() {
        $db = new Db;
        $pdo = $db->connect();

        $sql = "UPDATE products
        SET productName = '" . $this->{"productName"} . "', productLine = '" . $this->{"productLine"} . "', productScale = '" . 
        $this->{"productScale"} . "', productVendor = '" . $this->{"productVendor"} . "', productDescription = '" . 
        $this->{"productDescription"} . "', quantityInStock = '" . $this->{"quantityInStock"} . "', buyPrice = '" . 
        $this->{"buyPrice"} . "', MSRP = '" . $this->{"MSRP"} . "'
        WHERE productCode = '" . $this->productCode . "'";

        $toSave = $pdo->prepare($sql);
        $toSave->execute();
    }

    public function deleteProduct() {
        $pdo = connect();

        $sql = "DELETE FROM products WHERE productCode = '" . $this->productCode . "'";

        $deleteProducts = $pdo->prepare($sql);
        $deleteProducts->execute();
    }
}
?>