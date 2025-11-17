<?php
// models/TokenApi.php
require_once __DIR__ . '/../config/config.php';

class TokenApi {
    private $db;

    public function __construct() {
        try {
            // Usar tu conexión PDO existente si está disponible
            if (isset($GLOBALS['pdo']) && $GLOBALS['pdo'] instanceof PDO) {
                $this->db = $GLOBALS['pdo'];
            } else {
                // Fallback a tu clase Database
                require_once __DIR__ . '/../config/database.php';
                $database = new Database();
                $this->db = $database->getConnection();
            }
        } catch (Exception $e) {
            die("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    // 🔹 Obtener todos los tokens con información del cliente
    public function getAllWithClient(): array {
        try {
            $query = "SELECT t.*, c.nombre as cliente_nombre, c.email as cliente_email
                      FROM tokens_api t 
                      LEFT JOIN clientes_api c ON t.cliente_id = c.id 
                      ORDER BY t.created_at DESC";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener tokens: " . $e->getMessage());
        }
    }

    // 🔹 Obtener token por ID
    public function getById(int $id): ?array {
        try {
            $id = (int)$id;
            $query = "SELECT * FROM tokens_api WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$result) {
                throw new Exception("Token no encontrado con ID: " . $id);
            }
            
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Error al obtener token: " . $e->getMessage());
        }
    }

    // 🔹 Crear nuevo token
    public function create(array $data): bool {
        try {
            // Validar datos requeridos
            if (empty($data['cliente_id'])) {
                throw new Exception("Cliente API es obligatorio");
            }

            $query = "INSERT INTO tokens_api (cliente_id, token, expiracion, descripcion, activo) 
                     VALUES (?, ?, ?, ?, ?)";
            
            // Generar token único si no se proporciona
            $token = $data['token'] ?? 'tok_' . bin2hex(random_bytes(32));
            
            $stmt = $this->db->prepare($query);
            $success = $stmt->execute([
                (int)$data['cliente_id'],
                $token,
                $data['expiracion'] ?? null,
                trim($data['descripcion'] ?? ''),
                $data['activo'] ?? 1
            ]);

            if (!$success) {
                throw new Exception("Error al crear en la base de datos");
            }

            return $success;
        } catch (PDOException $e) {
            throw new Exception("Error de base de datos: " . $e->getMessage());
        }
    }

    // 🔹 Actualizar token
    public function update(int $id, array $data): bool {
        try {
            // Validar datos requeridos
            if (empty($data['cliente_id'])) {
                throw new Exception("Cliente API es obligatorio");
            }

            $query = "UPDATE tokens_api 
                     SET cliente_id = ?, expiracion = ?, descripcion = ?, activo = ?, updated_at = NOW()
                     WHERE id = ?";
            
            $stmt = $this->db->prepare($query);
            $success = $stmt->execute([
                (int)$data['cliente_id'],
                $data['expiracion'] ?? null,
                trim($data['descripcion'] ?? ''),
                $data['activo'] ?? 1,
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

    // 🔹 Eliminar token
    public function delete(int $id): bool {
        try {
            $query = "DELETE FROM tokens_api WHERE id = ?";
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

    // 🔹 Revocar token (desactivar)
    public function revoke(int $id): bool {
        try {
            $query = "UPDATE tokens_api SET activo = 0 WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $success = $stmt->execute([$id]);

            if (!$success) {
                throw new Exception("Error al revocar token");
            }

            return $success;
        } catch (PDOException $e) {
            throw new Exception("Error de base de datos: " . $e->getMessage());
        }
    }

    // 🔹 Renovar token (generar nuevo token)
    public function renew(int $id): ?string {
        try {
            $newToken = 'tok_' . bin2hex(random_bytes(32));
            
            $query = "UPDATE tokens_api SET token = ?, updated_at = NOW() WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $success = $stmt->execute([$newToken, $id]);

            if (!$success) {
                throw new Exception("Error al renovar token");
            }

            return $newToken;
        } catch (PDOException $e) {
            throw new Exception("Error de base de datos: " . $e->getMessage());
        }
    }
}
?>