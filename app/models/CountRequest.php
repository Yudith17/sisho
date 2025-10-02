<?php
require_once __DIR__ . '/../../config/database.php';

class CountRequest {
    private $db;

    public function __construct($pdo = null) {
        $this->db = $pdo ?? Database::getInstance();
    }

    // Obtener todas las solicitudes con información del token y cliente
    public function getAll() {
        $stmt = $this->db->query("
            SELECT cr.*, t.Token, c.razon_social 
            FROM Count_Request cr
            LEFT JOIN Token t ON cr.Id_Token = t.id
            LEFT JOIN Cliente_Api c ON t.Id_cliente_Api = c.id
            ORDER BY cr.fecha DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener estadísticas generales
    public function getStats() {
        $stats = [];

        // Total de solicitudes
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM Count_Request");
        $stats['total_requests'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        // Tokens únicos que han hecho solicitudes
        $stmt = $this->db->query("SELECT COUNT(DISTINCT Id_Token) as unique_tokens FROM Count_Request");
        $stats['unique_tokens'] = $stmt->fetch(PDO::FETCH_ASSOC)['unique_tokens'];

        // Solicitudes de hoy
        $stmt = $this->db->query("SELECT COUNT(*) as today FROM Count_Request WHERE DATE(fecha) = CURDATE()");
        $stats['today_requests'] = $stmt->fetch(PDO::FETCH_ASSOC)['today'];

        // Solicitudes por tipo
        $stmt = $this->db->query("SELECT Tipo, COUNT(*) as count FROM Count_Request GROUP BY Tipo");
        $stats['requests_by_type'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Solicitudes por token (top 5)
        $stmt = $this->db->query("
            SELECT t.Token, c.razon_social, COUNT(cr.Id) as request_count 
            FROM Count_Request cr
            LEFT JOIN Token t ON cr.Id_Token = t.id
            LEFT JOIN Cliente_Api c ON t.Id_cliente_Api = c.id
            GROUP BY cr.Id_Token 
            ORDER BY request_count DESC 
            LIMIT 5
        ");
        $stats['top_tokens'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $stats;
    }

    // Buscar una solicitud por ID
    public function find($id) {
        $stmt = $this->db->prepare("
            SELECT cr.*, t.Token, c.razon_social 
            FROM Count_Request cr
            LEFT JOIN Token t ON cr.Id_Token = t.id
            LEFT JOIN Cliente_Api c ON t.Id_cliente_Api = c.id
            WHERE cr.Id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear una nueva solicitud
    public function create($id_token, $tipo) {
        $stmt = $this->db->prepare("
            INSERT INTO Count_Request (Id_Token, Tipo, fecha) 
            VALUES (?, ?, NOW())
        ");
        return $stmt->execute([$id_token, $tipo]);
    }

    // Eliminar una solicitud
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM Count_Request WHERE Id = ?");
        return $stmt->execute([$id]);
    }

    // Obtener tokens activos para el formulario
    public function getActiveTokens() {
        $stmt = $this->db->query("
            SELECT t.id, t.Token, c.razon_social 
            FROM Token t
            LEFT JOIN Cliente_Api c ON t.Id_cliente_Api = c.id
            WHERE t.Estado = 1
            ORDER BY c.razon_social
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>