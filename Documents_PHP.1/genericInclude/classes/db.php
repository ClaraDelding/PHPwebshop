<?php


class DB {
    private $host = 'my33b.sqlserver.se';
    private $dbName = '236972-claraaxel';
    private $user = '236972_la91213';
    private $pass = 'Axelclara10';
    private $charset = 'utf8mb4';
    public $pdo;

    public function __construct() {
        $dsn = "mysql:host=$this->host;dbname=$this->dbName;charset=$this->charset";

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
        } catch (\PDOexception $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}