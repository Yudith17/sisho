<?php
// config/database.php
class Database {
    private $host = 'localhost';
    private $db_name = 'sisho';
    private $username = 'root';
    private $password = 'root'; // Contraseña por defecto en MAMP
    private $port = '8889'; // Puerto por defecto en MAMP
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name . ";charset=utf8mb4",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_PERSISTENT => false
                ]
            );
        } catch(PDOException $exception) {
            // Mostrar error solo en desarrollo
            if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
                die("Error de conexión a la base de datos: " . $exception->getMessage());
            } else {
                die("Error de conexión. Por favor contacta al administrador.");
            }
        }
        return $this->conn;
    }
}