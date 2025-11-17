<?php
// models/ClientApi.php
require_once __DIR__ . '/../config/config.php';

class ClientApi {
    private $db;

    public function __construct() {
        try {
            require_once __DIR__ . '/../config/database.php';
            $database = new Database();
            $this->db = $database->getConnection();
        } catch (Exception $e) {
            die("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    // 🔹 Obtener todos los clientes API
    public function getAll(): array {
        try {
            $query = "SELECT * FROM clientes_api ORDER BY id DESC";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Error al obtener clientes: " . $e->getMessage());
        }
    }

    // 🔹 Obtener cliente API por ID - CORREGIDO
    public function getById(int $id) {
        try {
            $id = (int)$id;
            $query = "SELECT * FROM clientes_api WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $result = $stmt->fetch();
            
            if (!$result) {
                throw new Exception("Cliente no encontrado con ID: " . $id);
            }
            
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Error al obtener cliente: " . $e->getMessage());
        }
    }

    // 🔹 Crear nuevo cliente API
    public function create(array $data): bool {
        try {
            // Validar datos requeridos
            if (empty($data['nombre']) || empty($data['email'])) {
                throw new Exception("Nombre y email son obligatorios");
            }

            // Verificar si el email ya existe
            if ($this->emailExists($data['email'])) {
                throw new Exception("El email ya está registrado");
            }

            $query = "INSERT INTO clientes_api (nombre, email, empresa, telefono, descripcion, api_key) 
                     VALUES (?, ?, ?, ?, ?, ?)";
            
            // Generar API key única
            $api_key = 'sk_' . bin2hex(random_bytes(16));
            
            $stmt = $this->db->prepare($query);
            $success = $stmt->execute([
                trim($data['nombre']),
                trim($data['email']),
                trim($data['empresa'] ?? ''),
                trim($data['telefono'] ?? ''),
                trim($data['descripcion'] ?? ''),
                $api_key
            ]);

            if (!$success) {
                throw new Exception("Error al crear en la base de datos");
            }

            return $success;
        } catch (PDOException $e) {
            throw new Exception("Error de base de datos: " . $e->getMessage());
        }
    }

    // 🔹 Actualizar cliente API
    public function update(int $id, array $data): bool {
        try {
            // Validar datos requeridos
            if (empty($data['nombre']) || empty($data['email'])) {
                throw new Exception("Nombre y email son obligatorios");
            }

            // Verificar si el email ya existe (excluyendo el actual)
            if ($this->emailExists($data['email'], $id)) {
                throw new Exception("El email ya está registrado por otro cliente");
            }

            $query = "UPDATE clientes_api SET 
                     nombre = ?, 
                     email = ?, 
                     empresa = ?, 
                     telefono = ?, 
                     descripcion = ?,
                     updated_at = NOW()
                     WHERE id = ?";
            
            $stmt = $this->db->prepare($query);
            $success = $stmt->execute([
                trim($data['nombre']),
                trim($data['email']),
                trim($data['empresa'] ?? ''),
                trim($data['telefono'] ?? ''),
                trim($data['descripcion'] ?? ''),
                $id
            ]);

            if (!$success) {
                throw new Exception("Error al actualizar en la base de datos");
            }

            return $success;
        } catch (PDOException $e) {
            throw new Exception("Error de base de datos: " . $e->getMessage());
        }
    }

    // 🔹 Eliminar cliente API
    public function delete(int $id): bool {
        try {
            $query = "DELETE FROM clientes_api WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $success = $stmt->execute([$id]);

            if (!$success) {
                throw new Exception("Error al eliminar en la base de datos");
            }

            return $success;
        } catch (PDOException $e) {
            throw new Exception("Error de base de datos: " . $e->getMessage());
        }
    }

    // 🔹 Verificar si el email ya existe
    private function emailExists($email, $excludeId = null) {
        $query = "SELECT id FROM clientes_api WHERE email = ?";
        $params = [trim($email)];
        
        if ($excludeId) {
            $query .= " AND id != ?";
            $params[] = $excludeId;
        }
        
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetch() !== false;
    }
}
?>