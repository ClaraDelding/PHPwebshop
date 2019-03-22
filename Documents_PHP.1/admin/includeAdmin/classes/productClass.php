<?php
    include_once '../../genericInclude/classes/db.php';
    
//----------------------------Klass för products------------------------------------------------------------------------------

class Product {
    public $productCode;
    public $productName;
    public $productLine;
    public $productScale;
    public $productVendor;
    public $productDescription;
    public $quantityInStock;
    public $buyPrice;
    public $MSRP;
    public $pdo;
 
    //i konstruktor, om ingen produktkod anges, skapa produktkod genom att hämta högsta värdet från db och sedan +1
    function __construct($productCode = ""){
        $db = new DB;
        $this->pdo = $db->pdo;
        if($productCode == "") {
            $getMaxID = $this->pdo->prepare("SELECT MAX(productCode) FROM products");
            $getMaxID->execute();
            $result = ($getMaxID->fetchColumn());   
            $string1 = substr($result, 0, 4);
            $string2 = ((int)substr($result, 4) +1);
            $string3 =$string1 . $string2;
            $this->productCode = $string3;
            //$string 1, 2 & 3 ihopslagen: $this->productCode = substr($result, 0, 4).((int)substr($result, 4) + 3);
        } else {
            $this->productCode = $productCode;

        }
     }
    
    //skapa produkt
    public function createProduct($productCode, $productName, $productLine, $productScale, $productVendor, $productDescription, $quantityInStock, 
        $buyPrice, $MSRP) { 
        $this->productName = $productName;
        $this->productLine = $productLine;
        $this->productScale = $productScale;
        $this->productVendor = $productVendor;
        $this->productDescription = $productDescription;
        $this->quantityInStock = $quantityInStock;
        $this->buyPrice = $buyPrice;
        $this->MSRP = $MSRP; 
        $this->productCode = $productCode;

        $stmt = $this->pdo->prepare("INSERT INTO products (productCode, productName, productLine, productScale, productVendor,
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
        $stmt->execute();

    }
    //Denna funktionalitet används ej någonstans på sidan
    public function getAllProducts() {

        $sql = "SELECT * FROM products";

        $getAllProducts =$this->pdo->prepare($sql);
        $getAllProducts->execute();

        return $getAllProducts;
    }

    public function getProduct() {


        $sql = "SELECT * FROM products WHERE productCode = '$this->productCode'";

        $getProduct = $this->pdo->prepare($sql); 
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

    //Denna funktionalitet fungerar ej ännu, utförs istället i dbProcess under UPPDATERA PRODUKT
    public function updateProduct($productName, $productDescription, $MSRP, $productVendor) {
        $this->productName = $productName;
        $this->productDescription =$productDescription;
        $this->MSRP = $MSRP;
        $this->productVendor = $productVendor;

        $sql = "UPDATE products SET productName ='" . $productName . "', productDescription = '" . $productDescription . "', 
        MSRP = '" . $MSRP . "', productVendor ='" . $productVendor . "' WHERE productCode = '" . $this->productCode. "'";
        $stmt = $this->pdo->prepare($sql); // prepare the pdo
        $stmt->execute(); // execute does the actual update
     
    }

    //ta bort produkt. Fungerar ej pga foreign key constraint
    public function deleteProduct() {

        $stmt = $this->pdo->prepare("DELETE FROM products WHERE productCode = :productCode;");
        $stmt->execute([':productCode' => $productCode]);
    }

    public function getProductsInLine() {
   
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE productLine = :productLine;");
        $stmt->execute([':productLine' => $productLine]);

    }

    //bör ligga i klassen productLines, men blir catch 22 situation att ange productLine som startvärde när en vill hämta productLines
    //(se constructor för productLines)
    
    public function getProductLines() {

        $sql = "SELECT productLine FROM productlines";

        $getProductLines = $this->pdo->prepare($sql);
        $getProductLines->execute();
        return $getProductLines;

    }

}

?>
