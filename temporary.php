<?php

require_once "funktioner.php";
require_once "klasser.php";

class ProductLines extends Db {
    public $productLine;
    public $textDescription;
    public $htmlDescription;
    public $image;

    function __construct($productLine) {
        
        $this->productLine = $productLine;
        $db = new Db;
        $pdo = $db->connect();


        // $stmt = $this->connect()->query("SELECT * FROM productlines");
        // while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
        //     $productLine = $row['productLine'];
            
        //     return $productLine;
        // }

        // $sql = "SELECT * FROM products WHERE productLine = '" . $this->productLine . "'";

        // $getProductLine = $pdo->prepare($sql);
        // $getProductLine->execute();

        // $rows = $getProductLine->fetchAll(PDO::FETCH_ASSOC);

        // $sql = "SELECT * FROM productlines";
        // $stmt = $pdo->prepare($sql);
        // $stmt->execute();

        // $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

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
    $pdo = $db->connect();
    
    $sql = "SELECT productLine FROM productlines";
    $stmt = $pdo->prepare($sql); 
    $stmt->execute();

    }

    public function createProductLine($productLine, $textDescription = null, $htmlDescription = null, $image = null) {
        $this->productLine = $productLine;
        $this->textDescription = $htmlDescription;
        $this->htmlDescription = $htmlDescription;
        $this->image = $image;

        $db = new Db;
        $pdo = $db->connect();

        $sql = "INSERT INTO productlines SET productLine ='" . $this->productLine . "', textDescription ='" . 
        $textDescription . "', htmlDescription ='" . $htmlDescription . "', image ='" . $image . "'";

        $stmt = $pdo->prepare($sql); 
        $stmt->execute();
    }

    public function getProductsInLine() {
        $db = new Db;
        $pdo = $db->connect();

        $sql = "SELECT * FROM products WHERE productLine = '" . $this->productLine . "'";

        $getProductsInLine = $pdo->prepare($sql);
        $getProductsInLine->execute();

        return $getProductsInLine;

        
    }

    public function getProductLines() {
        $db = new Db;
        $pdo = $db->connect();

        $sql = "SELECT productLine from productLines";

        $getproductLines = $pdo->prepare($sql);
        $getProductLines->execute();

        return $getProductLines; 
    }

}