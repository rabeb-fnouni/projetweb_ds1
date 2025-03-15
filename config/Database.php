<?php
// File: config/database.php
class Database {
    private static $instance = null;
    private $conn;
    
    private function __construct() {
        $host = 'localhost';
        $db_name = 'essect_clubs';
        $username = 'root';
        $password = '';
        
        try {
            $this->conn = new PDO(
                "mysql:host=$host;dbname=$db_name",
                $username,
                $password,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
        } catch(PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
    }
    
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->conn;
    }
}
