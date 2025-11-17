<?php
// models/Hotel.php
require_once __DIR__ . '/../config/config.php';

class Hotel {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    // 🔹 Obtener todos los hoteles con búsqueda, límite y offset
    public function getAll(int $limit = 20, int $offset = 0, string $search = ''): array {
        $sql = "SELECT id, nombre, categoria, descripcion, direccion, distrito, provincia, telefono, email 
                FROM hoteles 
                WHERE nombre LIKE :search OR descripcion LIKE :search
                ORDER BY nombre ASC
                LIMIT :limit OFFSET :offset";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Contar hoteles (para paginación y búsqueda)
    public function count(string $search = ''): int {
        $sql = "SELECT COUNT(*) FROM hoteles WHERE nombre LIKE :search OR descripcion LIKE :search";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    // 🔹 Obtener hotel por ID
    public function getById(int $id): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM hoteles WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    // 🔹 Crear nuevo hotel
    public function create(array $data): bool {
        $sql = "INSERT INTO hoteles (nombre, categoria, descripcion, direccion, distrito, provincia, telefono, email) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['nombre'],
            $data['categoria'],
            $data['descripcion'],
            $data['direccion'],
            $data['distrito'],
            $data['provincia'],
            $data['telefono'],
            $data['email']
        ]);
    }

    // 🔹 Actualizar hotel
    public function update(int $id, array $data): bool {
        $sql = "UPDATE hoteles 
                SET nombre = ?, categoria = ?, descripcion = ?, direccion = ?, distrito = ?, provincia = ?, telefono = ?, email = ? 
                WHERE id = ?";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['nombre'],
            $data['categoria'],
            $data['descripcion'],
            $data['direccion'],
            $data['distrito'],
            $data['provincia'],
            $data['telefono'],
            $data['email'],
            $id
        ]);
    }

    // 🔹 Eliminar hotel
    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM hoteles WHERE id = ?");
        return $stmt->execute([$id]);
    }
}