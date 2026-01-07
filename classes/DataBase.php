<?php
class DataBase {
    private static ?Database $instance = null;
    private ?PDO $connection = null;
    private string $host = "localhost";
    private string $dbName = "ma_bagnole";
    private string $username = "root";
    private string $password = "ME551234";
    private int $port = 3307;
    private function __construct() {
            $dsn = "mysql:host={$this->host};dbname={$this->dbName};port={$this->port};charset=utf8mb4";
            $this->connection = new PDO($dsn, $this->username, $this->password);
    }

  
    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection(): PDO {
        return $this->connection;
    }
}
