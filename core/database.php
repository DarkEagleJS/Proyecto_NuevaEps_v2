<?php
class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        // Configuración de la base de datos (ajustar según tu entorno)
        $host = 'localhost';
        $dbName = 'proyecto';
        $username = 'root';
        $password = '';
        
        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Conexión fallida: ' . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->connection;
    }

    // Prevenir la clonación de la instancia
    private function __clone() {}

    // Prevenir la deserialización de la instancia
    public function __wakeup() {
        throw new Exception("No se puede deserializar una instancia de la clase Singleton.");
    }
}
