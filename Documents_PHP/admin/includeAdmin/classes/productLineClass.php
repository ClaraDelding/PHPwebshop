<?php
include_once '../../genericInclude/classes/db.php';
//---------------------------------------Klass för productLines---------------------------------------------------------

class ProductLines extends Db {
    public $productLine;
    public $textDescription;
    public $htmlDescription;
    public $image;

function __construct ($productLine) {
    
    $this->productLine = $productLine;
    $db = new Db;
    $pdo = $db->pdo;

}

//Hämtar allt från en specificerad productLine
public function getProductLine() {
    $db = new Db;
    $pdo = $db->connect();

    $sql = "SELECT * FROM productlines WHERE productLine = '" . $this->productLine . "'";

    $getProductLine = $pdo->prepare($sql); 
    $getProductLine->execute();
    
    $rows = $getProductLine->fetchAll(PDO::FETCH_ASSOC);

    $this->productLine = $rows[0]["productLine"];
    $this->textDescription = $rows[0]["textDescription"];
    $this->htmlDescription = $rows[0]["htmlDescription"];
    $this->image = $rows[0]["image"];

}

public function getProductLineName() {
    $db = new Db;
    $pdo = $db->pdo;
    
    $sql = "SELECT productLine FROM productlines";
    $stmt = $pdo->prepare($sql); 
    $stmt->execute();

}

//Finns ej funktionalitet på sidan ännu för create productLine
public function createProductLine($productLine, $textDescription = null, $htmlDescription = null, $image = null) {
    $this->productLine = $productLine;
    $this->textDescription = $htmlDescription;
    $this->htmlDescription = $htmlDescription;
    $this->image = $image;

    $db = new Db;
    $pdo = $db->pdo;

    $sql = "INSERT INTO productlines SET productLine ='" . $this->productLine . "', textDescription ='" . 
    $textDescription . "', htmlDescription ='" . $htmlDescription . "', image ='" . $image . "'";

    $stmt = $pdo->prepare($sql); 
    $stmt->execute();
}

//hämtar alla produkter i en viss kategori
public function getProductsInLine() {
    $db = new Db;
    $pdo = $db->pdo;

    $sql = "SELECT * FROM products WHERE productLine = '" . $this->productLine . "'";

    $getProductsInLine = $pdo->prepare($sql);
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