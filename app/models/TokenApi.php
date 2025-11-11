<?php
require_once __DIR__ . '/../../config/database.php';

class TokenApi {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getByClientId($clientId) {
        $stmt = $this->db->prepare("
            SELECT * FROM Token 
            WHERE Id_cliente_Api = ? 
            ORDER BY Fecha_registro DESC
        ");
        $stmt->execute([$clientId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener todos los tokens
    public function getAll() {
        $stmt = $this->db->query("
            SELECT t.*, c.razon_social 
            FROM Token t 
            LEFT JOIN Cliente_Api c ON t.Id_cliente_Api = c.id 
            ORDER BY t.id DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar un token por ID
    public function find($id) {
        $stmt = $this->db->prepare("
            SELECT t.*, c.razon_social 
            FROM Token t 
            LEFT JOIN Cliente_Api c ON t.Id_cliente_Api = c.id 
            WHERE t.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Buscar cliente API por ID
    public function findClienteApi($id) {
        $stmt = $this->db->prepare("SELECT * FROM Cliente_Api WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo token
    public function create($id_cliente_api, $token, $estado) {
        $stmt = $this->db->prepare("
            INSERT INTO Token (Id_cliente_Api, Token, Estado)
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$id_cliente_api, $token, $estado]);
    }

    // Editar token
    public function update($id, $id_cliente_api, $token, $estado) {
        try {
            if (empty($token)) {
                throw new Exception("El token no puede estar vacío");
            }

            $stmt = $this->db->prepare("
                UPDATE Token 
                SET Id_cliente_Api = ?, Token = ?, Estado = ?
                WHERE id = ?
            ");
            
            return $stmt->execute([$id_cliente_api, $token, $estado, $id]);
            
        } catch (PDOException $e) {
            error_log("Error en TokenApi::update: " . $e->getMessage());
            throw new Exception("Error al actualizar el token: " . $e->getMessage());
        }
    }

    // Eliminar token
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM Token WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // MÉTODO MEJORADO: Generar token seguro único
    public function generateToken($id_cliente_api = null) {
        try {
            // Validar que se proporcione un ID
            if ($id_cliente_api === null || $id_cliente_api === '') {
                throw new Exception("ID de cliente API es requerido para generar el token");
            }

            // Verificar que el cliente existe
            $cliente = $this->findClienteApi($id_cliente_api);
            if (!$cliente) {
                throw new Exception("Cliente API no encontrado con ID: " . $id_cliente_api);
            }

            // Generar un token seguro único (64 caracteres)
            $token = bin2hex(random_bytes(32));
            
            // Agregar prefijo con el ID del cliente para identificación
            $prefix = 'cli_' . $id_cliente_api . '_';
            $token = $prefix . $token;
            
            return $token;
            
        } catch (Exception $e) {
            error_log("Error en TokenApi::generateToken: " . $e->getMessage());
            throw new Exception("Error al generar token: " . $e->getMessage());
        }
    }

    // MÉTODO ALTERNATIVO: Generar token con formato específico (como tu versión original)
    public function generateTokenWithFormat($id_cliente_api) {
        try {
            if ($id_cliente_api === null || $id_cliente_api === '') {
                throw new Exception("ID de cliente API es requerido para generar el token");
            }

            // Verificar que el cliente existe
            $cliente = $this->findClienteApi($id_cliente_api);
            if (!$cliente) {
                throw new Exception("Cliente API no encontrado con ID: " . $id_cliente_api);
            }

            // Generar hash/contraseña segura
            $password = bin2hex(random_bytes(8));
            
            // Obtener fecha actual en formato Ymd (año, mes, día)
            $fecha = date('Ymd');
            
            // Formato: password-fecha-id_cliente_api
            return "{$password}-{$fecha}-{$cliente['id']}";
            
        } catch (Exception $e) {
            error_log("Error en TokenApi::generateTokenWithFormat: " . $e->getMessage());
            throw new Exception("Error al generar token: " . $e->getMessage());
        }
    }

    // Método completo para crear token automáticamente (VERSIÓN MEJORADA)
    public function createAutoToken($id_cliente_api, $estado = 1) {
        try {
            // Generar el token con el nuevo método seguro
            $token = $this->generateToken($id_cliente_api);
            
            // Insertar en la base de datos
            $stmt = $this->db->prepare("
                INSERT INTO Token (Id_cliente_Api, Token, Estado)
                VALUES (?, ?, ?)
            ");
            
            $result = $stmt->execute([$id_cliente_api, $token, $estado]);
            
            if ($result) {
                return [
                    'success' => true,
                    'token' => $token,
                    'id' => $this->db->lastInsertId(),
                    'id_cliente_api' => $id_cliente_api
                ];
            } else {
                throw new Exception("Error al insertar token en la base de datos");
            }
            
        } catch (Exception $e) {
            error_log("Error en TokenApi::createAutoToken: " . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    // NUEVO MÉTODO: Crear token con formato específico si lo prefieres
    public function createFormattedToken($id_cliente_api, $estado = 1) {
        try {
            // Generar el token con formato específico
            $token = $this->generateTokenWithFormat($id_cliente_api);
            
            // Insertar en la base de datos
            $stmt = $this->db->prepare("
                INSERT INTO Token (Id_cliente_Api, Token, Estado)
                VALUES (?, ?, ?)
            ");
            
            $result = $stmt->execute([$id_cliente_api, $token, $estado]);
            
            if ($result) {
                return [
                    'success' => true,
                    'token' => $token,
                    'id' => $this->db->lastInsertId(),
                    'id_cliente_api' => $id_cliente_api
                ];
            } else {
                throw new Exception("Error al insertar token en la base de datos");
            }
            
        } catch (Exception $e) {
            error_log("Error en TokenApi::createFormattedToken: " . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    // NUEVO MÉTODO: Verificar si un token existe
    public function tokenExists($token) {
        $stmt = $this->db->prepare("SELECT id FROM Token WHERE Token = ?");
        $stmt->execute([$token]);
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }

    // NUEVO MÉTODO: Generar token único que no exista en la BD
    public function generateUniqueToken($id_cliente_api) {
        $maxAttempts = 5;
        $attempts = 0;
        
        while ($attempts < $maxAttempts) {
            $token = $this->generateToken($id_cliente_api);
            
            if (!$this->tokenExists($token)) {
                return $token;
            }
            
            $attempts++;
        }
        
        throw new Exception("No se pudo generar un token único después de $maxAttempts intentos");
    }
}