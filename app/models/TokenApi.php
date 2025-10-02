<?php
require_once __DIR__ . '/../../config/database.php';

class TokenApi {
    private $db;

    public function __construct($pdo = null) {
        $this->db = $pdo ?? Database::getInstance();
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

    // Crear un nuevo token
    public function create($id_cliente_api, $token, $estado) {
        $stmt = $this->db->prepare("
            INSERT INTO Token (Id_cliente_Api, Token, Estado)
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$id_cliente_api, $token, $estado]);
    }

    // Editar token
    // Editar token - con mejor manejo de errores
public function update($id, $id_cliente_api, $token, $estado) {
    try {
        // Validar que el token no sea nulo o vacío
        if (empty($token)) {
            throw new Exception("El token no puede estar vacío");
        }

        $stmt = $this->db->prepare("
            UPDATE Token 
            SET Id_cliente_Api = ?, Token = ?, Estado = ?
            WHERE id = ?
        ");
        
        return $stmt->execute([
            $id_cliente_api, 
            $token, 
            $estado, 
            $id
        ]);
        
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

    // Generar token único
    public function generateToken() {
        return bin2hex(random_bytes(32));
    }
}