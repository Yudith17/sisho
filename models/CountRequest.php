<?php
// models/CountRequest.php
require_once __DIR__ . '/../config/config.php';

class CountRequest {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    // 🔹 Obtener todos los registros con información del cliente
    public function getAllWithClient(): array {
        $sql = "SELECT cr.*, c.nombre as cliente_nombre 
                FROM count_requests cr 
                LEFT JOIN clientes_api c ON cr.cliente_id = c.id 
                ORDER BY cr.fecha DESC, cr.created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Obtener registro por ID
    public function getById(int $id): ?array {
        $sql = "SELECT * FROM count_requests WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    // 🔹 Obtener registro por ID con información del cliente
    public function getByIdWithClient(int $id): ?array {
        $sql = "SELECT cr.*, c.nombre as cliente_nombre 
                FROM count_requests cr 
                LEFT JOIN clientes_api c ON cr.cliente_id = c.id 
                WHERE cr.id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    // 🔹 Crear nuevo registro
    public function create(array $data): bool {
        $sql = "INSERT INTO count_requests (cliente_id, fecha, total_solicitudes, solicitudes_exitosas, solicitudes_fallidas, observaciones) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['cliente_id'],
            $data['fecha'],
            $data['total_solicitudes'],
            $data['solicitudes_exitosas'],
            $data['solicitudes_fallidas'],
            $data['observaciones']
        ]);
    }

    // 🔹 Actualizar registro
    public function update(int $id, array $data): bool {
        $sql = "UPDATE count_requests 
                SET cliente_id = ?, fecha = ?, total_solicitudes = ?, solicitudes_exitosas = ?, solicitudes_fallidas = ?, observaciones = ?
                WHERE id = ?";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['cliente_id'],
            $data['fecha'],
            $data['total_solicitudes'],
            $data['solicitudes_exitosas'],
            $data['solicitudes_fallidas'],
            $data['observaciones'],
            $id
        ]);
    }

    // 🔹 Eliminar registro
    public function delete(int $id): bool {
        $sql = "DELETE FROM count_requests WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    // 🔹 Obtener estadísticas generales
    public function getEstadisticas(): array {
        $sql = "SELECT 
                SUM(total_solicitudes) as total_solicitudes,
                SUM(solicitudes_exitosas) as exitosas,
                SUM(solicitudes_fallidas) as fallidas,
                AVG(total_solicitudes) as promedio_dia
                FROM count_requests";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔹 Obtener registros por cliente
    public function getByClienteId(int $cliente_id): array {
        $sql = "SELECT * FROM count_requests WHERE cliente_id = ? ORDER BY fecha DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$cliente_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Obtener estadísticas por rango de fechas
    public function getByDateRange(string $fecha_inicio, string $fecha_fin): array {
        $sql = "SELECT cr.*, c.nombre as cliente_nombre 
                FROM count_requests cr 
                LEFT JOIN clientes_api c ON cr.cliente_id = c.id 
                WHERE cr.fecha BETWEEN ? AND ? 
                ORDER BY cr.fecha DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$fecha_inicio, $fecha_fin]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}