<?php

class Db {
     protected function connect() {

    // Establish a connection to the database 

    $host = 'localhost';
    $db   = 'classicmodels';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';
    
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    
    try {
      $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
      throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }

     return $pdo;
}
}

// function productline_names($pdo) {

//      $sql = "SELECT DISTINCT productLine FROM productlines";

//      $toGet = $pdo->prepare($sql); // prepared statement
//      $toGet->execute(); // execute sql statment

//      return $toGet;
// }

// function get_all_productlines($pdo, $limit, $offset) {
//      $sql = "";
//      if($offset>0){
//           $sql = "SELECT * FROM productlines LIMIT $limit, $offset" ;
//      } else {
//           $sql = "SELECT * FROM productlines LIMIT $limit" ;
//      }
//      $toGet = $pdo->prepare($sql); // prepared statement
//      $toGet->execute(); // execute sql statment

//      return $toGet;

// }

// function get_all_products($pdo, $limit, $offset) {
//      $sql = "";
//      if($offset>0){
//      $sql = "SELECT * FROM products LIMIT $limit, $offset";
     
//      } else {
//           $sql = "SELECT * FROM products LIMIT $limit";
//      }

//      $toGet = $pdo->prepare($sql); // prepared statement
//      $toGet->execute(); // execute sql statment

//      return $toGet;
// }

?>