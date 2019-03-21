<?php

include_once '../../genericInclude/classes/db.php';


//---------------------------------------Klass för productLines---------------------------------------------------------

class ProductLines {
    public $productLine;
    public $textDescription;
    public $htmlDescription;
    public $image;
    public $pdo;

function __construct ($productLine) {
    
    $this->productLine = $productLine;
    $db = new DB;
    $this->pdo = $db->pdo;
}

//Hämtar allt från en specificerad productLine
public function getProductLine() {

    $sql = "SELECT * FROM productlines WHERE productLine = '" . $this->productLine . "'";

    $getProductLine = $this->pdo->prepare($sql); 
    $getProductLine->execute();
    
    $rows = $getProductLine->fetchAll(PDO::FETCH_ASSOC);

    $this->productLine = $rows[0]["productLine"];
    $this->textDescription = $rows[0]["textDescription"];
    $this->htmlDescription = $rows[0]["htmlDescription"];
    $this->image = $rows[0]["image"];

}

public function getProductLineName() {
    
    $sql = "SELECT productLine FROM productlines";
    $stmt = $this->pdo->prepare($sql); 
    $stmt->execute();

}

//Finns ej funktionalitet på sidan ännu för create productLine
public function createProductLine($productLine, $textDescription = null, $htmlDescription = null, $image = null) {
    $this->productLine = $productLine;
    $this->textDescription = $htmlDescription;
    $this->htmlDescription = $htmlDescription;
    $this->image = $image;

    $sql = "INSERT INTO productlines SET productLine ='" . $this->productLine . "', textDescription ='" . 
    $textDescription . "', htmlDescription ='" . $htmlDescription . "', image ='" . $image . "'";

    $stmt = $this->pdo->prepare($sql); 
    $stmt->execute();
}

//hämtar alla produkter i en viss kategori
public function getProductsInLine() {

    $sql = "SELECT * FROM products WHERE productLine = '" . $this->productLine . "'";

    $getProductsInLine = $this->pdo->prepare($sql);
    $getProductsInLine->execute();

    return $getProductsInLine;

    
}

//Hämtar alla kategorier från productLines
public function getProductLines() {
    $db = new Db;
    $pdo = $db->pdo;

    $sql = "SELECT productLine from productLines";

    $getproductLines = $pdo->prepare($sql);
    $getProductLines->execute();

    return $getProductLines; 
}

}
?>
