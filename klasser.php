<?php

    require_once "connect.php";

    // function connect() {
    
    // $host = 'localhost';
    // $db   = 'classicmodels';
    // $user = 'root';
    // $pass = '';
    // $charset = 'utf8mb4';

    // $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    // $options = [
    // PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // PDO::ATTR_EMULATE_PREPARES   => false,
    // ];

    // try {
    //     $pdo = new PDO($dsn, $user, $pass, $options);
    // } catch (\PDOException $e) {
    //     throw new \PDOException($e->getMessage(), (int)$e->getCode());
    //     }
    // }


class Product {

    //properties:

    public $product = ['productCode' => '0', 'productName' => 'undefined', 'productLine' => 'undefined', 'productScale' => '1:10', 'productVendor' => 'undefined', 'productDescription' => 'undefined', 'quantityInStock' => 0, 'buyPrice' => 0.0, 'MSRP' => 0.0];

    //methods:

    public function __construct(){}


    // public function createProduct() {

    //     $pdo = connect();


    //     $sql = 

    // }

    public function getProduct($pdo) {

        $pdo = connect();

        $sql = "SELECT * FROM products WHERE productCode = '" . $this->{"productCode"} . "'";

        $getProduct = $pdo->prepare($sql); // prepared statement
        $getProduct->execute(); // execute sql statment

        return $getProduct;

    }


    public function updateProduct() {
        $pdo = connect();
        
        $sql = "UPDATE products
        SET productName = '" . $this->{"productName"} . "', productLine = '" . $this->{"productLine"} . "', productScale = '" . $this->{"productScale"} . "', productVendor = '" . $this->{"productVendor"} . "', productDescription = '" . $this->{"productDescription"} . "', quantityInStock = '" . $this->{"quantityInStock"} . "', buyPrice = '" . $this->{"buyPrice"} . "', MSRP = '" . $this->{"MSRP"} . "'
        WHERE productCode = '" . $this->{"productCode"} . "'";

        $toSave = $pdo->prepare($sql);
        $toSave->execute();

        return TRUE;

    }


    public function deleteProduct() {
        $pdo = connect();

        $sql = "DELETE FROM products WHERE productCode = '" . $this->{"productCode"} . "'";

        $deleteProducts = $pdo->prepare($sql);
        $deleteProducts->execute();

        return TRUE;

    }






}

//-------------------------------------------------------------------------------------------


// class productLines


?>