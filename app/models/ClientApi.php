<?php
require_once __DIR__ . '/../../config/database.php';

class ClientApi {
    private $pdo; // Cambia $db por $pdo para consistencia

    public function __construct() {
        $this->pdo = Database::getConnection(); // Usa getConnection como en tu código original
    }

    /**
     * Obtener todos los clientes API (para VER)
     */
    public function getAll() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM Cliente_Api ORDER BY fecha_registro DESC");
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error al obtener clientes API: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Buscar cliente por ID (para VER detalles)
     */
    public function find($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM Cliente_Api WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error al buscar cliente: " . $e->getMessage());
            return null;
        }
    }

    /**
     * BUSCAR clientes por diferentes criterios
     */
    public function search($searchTerm) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT * FROM Cliente_Api 
                WHERE 
                    ruc LIKE :search OR
                    razon_social LIKE :search OR
                    correo LIKE :search OR
                    telefono LIKE :search
                ORDER BY razon_social
            ");
            $stmt->execute([':search' => "%$searchTerm%"]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error en búsqueda: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Buscar cliente por token (para autenticación API)
     */
    public function findByToken($token) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT c.*, t.id as token_id 
                FROM Cliente_Api c 
                INNER JOIN Token t ON c.id = t.Id_cliente_Api 
                WHERE t.Token = ? AND c.estado = 'activo' AND t.Estado = 1
            ");
            $stmt->execute([$token]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error al buscar por token: " . $e->getMessage());
            return null;
        }
    }
     /**
     * CREAR nuevo cliente API
     */
    public function create($data) {
        try {
            // Validar que el RUC no exista
            $stmt = $this->pdo->prepare("SELECT id FROM Cliente_Api WHERE ruc = ?");
            $stmt->execute([$data['ruc']]);
            if ($stmt->fetch()) {
                throw new Exception("El RUC ya está registrado");
            }

            // Validar que el correo no exista
            $stmt = $this->pdo->prepare("SELECT id FROM Cliente_Api WHERE correo = ?");
            $stmt->execute([$data['correo']]);
            if ($stmt->fetch()) {
                throw new Exception("El correo electrónico ya está registrado");
            }

            $sql = "INSERT INTO Cliente_Api (ruc, razon_social, telefono, correo, estado) 
                    VALUES (?, ?, ?, ?, ?)";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $data['ruc'],
                $data['razon_social'],
                $data['telefono'],
                $data['correo'],
                $data['estado']
            ]);

            return $this->pdo->lastInsertId();

        } catch (PDOException $e) {
            error_log("Error al crear cliente API: " . $e->getMessage());
            throw new Exception("Error en la base de datos: " . $e->getMessage());
        }
    }

    /**
     * Registrar solicitud API
     */
    public function registerRequest($tokenId, $tipo) {
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO Count_Request (Id_Token, Tipo, fecha) 
                VALUES (?, ?, NOW())
            ");
            return $stmt->execute([$tokenId, $tipo]);
        } catch (PDOException $e) {
            error_log("Error al registrar request: " . $e->getMessage());
            return false;
        }
    }
}