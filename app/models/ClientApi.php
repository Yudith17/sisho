<?php
class ClientApi {
        private $db;
    
        public function __construct() {
            $this->db = Database::getConnection();
        }
    
        // ... métodos existentes ...
    
        public function getById($id) {
            $sql = "SELECT * FROM Cliente_Api WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
    

    // ==================== MÉTODOS CRUD BÁSICOS ====================

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM Cliente_Api ORDER BY fecha_registro DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM Cliente_Api WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($ruc, $razon_social, $telefono, $correo, $estado) {
        $stmt = $this->db->prepare("INSERT INTO Cliente_Api (ruc, razon_social, telefono, correo, estado) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$ruc, $razon_social, $telefono, $correo, $estado]);
    }

    public function update($id, $ruc, $razon_social, $telefono, $correo, $estado) {
        $stmt = $this->db->prepare("UPDATE Cliente_Api SET ruc = ?, razon_social = ?, telefono = ?, correo = ?, estado = ? WHERE id = ?");
        return $stmt->execute([$ruc, $razon_social, $telefono, $correo, $estado, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM Cliente_Api WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // ==================== MÉTODOS PARA API ====================

    /**
     * Obtener el historial de solicitudes del cliente
     */
    public function getSearchHistory($clientId) {
        $stmt = $this->db->prepare("
            SELECT cr.Tipo, cr.fecha 
            FROM Count_Request cr 
            INNER JOIN Token t ON cr.Id_Token = t.id 
            WHERE t.Id_cliente_Api = ? 
            ORDER BY cr.fecha DESC 
            LIMIT 10
        ");
        $stmt->execute([$clientId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtener el token activo del cliente
     */
    public function getTokenByClientId($clientId) {
        $stmt = $this->db->prepare("
            SELECT * FROM Token 
            WHERE Id_cliente_Api = ? AND Estado = 1 
            ORDER BY Fecha_registro DESC 
            LIMIT 1
        ");
        $stmt->execute([$clientId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Buscar cliente por token
     */
    public function findByToken($token) {
        $stmt = $this->db->prepare("
            SELECT c.*, t.id as token_id 
            FROM Cliente_Api c 
            INNER JOIN Token t ON c.id = t.Id_cliente_Api 
            WHERE t.Token = ? AND c.estado = 'activo' AND t.Estado = 1
        ");
        $stmt->execute([$token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Registrar solicitud en Count_Request
     */
    public function registerRequest($tokenId, $tipo) {
        $stmt = $this->db->prepare("
            INSERT INTO Count_Request (Id_Token, Tipo, fecha) 
            VALUES (?, ?, NOW())
        ");
        return $stmt->execute([$tokenId, $tipo]);
    }

    /**
     * Método para ejecutar consultas personalizadas
     */
    public function query($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Buscar por RUC
     */
    public function findByRuc($ruc) {
        $stmt = $this->db->prepare("SELECT * FROM Cliente_Api WHERE ruc = ?");
        $stmt->execute([$ruc]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Buscar por correo
     */
    public function findByEmail($correo) {
        $stmt = $this->db->prepare("SELECT * FROM Cliente_Api WHERE correo = ?");
        $stmt->execute([$correo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Obtener clientes activos
     */
    public function getActiveClients() {
        $stmt = $this->db->prepare("SELECT * FROM Cliente_Api WHERE estado = 'activo' ORDER BY razon_social");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Contar total de clientes
     */
    public function countAll() {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM Cliente_Api");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
}