<?php
require_once __DIR__ . '/../../config/database.php';

class Hotel {
    private $db;

    public function __construct($pdo = null) {
        $this->db = $pdo ?? Database::getInstance();
    }

    // Obtener todos los hoteles
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM hotels ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar un hotel por ID
    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM hotels WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo hotel
    public function create($name, $category, $description, $address, $district, $province, $department, $phone, $email, $website) {
        $stmt = $this->db->prepare("
            INSERT INTO hotels (name, category, description, address, district, province, department, phone, email, website)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$name, $category, $description, $address, $district, $province, $department, $phone, $email, $website]);
    }

    // Editar hotel
    public function update($id, $name, $category, $description, $address, $district, $province, $department, $phone, $email, $website) {
        $stmt = $this->db->prepare("
            UPDATE hotels 
            SET name=?, category=?, description=?, address=?, district=?, province=?, department=?, phone=?, email=?, website=?
            WHERE id=?
        ");
        return $stmt->execute([$name, $category, $description, $address, $district, $province, $department, $phone, $email, $website, $id]);
    }

    // Eliminar hotel
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM hotels WHERE id = ?");
        return $stmt->execute([$id]);
    }
        // Buscar hoteles por nombre o dirección
        public function searchByName($name) {
            $query = "SELECT * FROM hotels 
                     WHERE name LIKE :name 
                        OR address LIKE :name 
                        OR district LIKE :name
                        OR province LIKE :name
                     ORDER BY name";
            $stmt = $this->db->prepare($query);
            $searchTerm = "%" . $name . "%";
            $stmt->bindParam(":name", $searchTerm);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        // Buscar hoteles cercanos por coordenadas (si tu tabla tiene latitud y longitud)
        public function searchNearby($lat, $lng, $radius = 10) {
            // Primero verificar si la tabla tiene campos de coordenadas
            $stmt = $this->db->query("SHOW COLUMNS FROM hotels LIKE 'latitud'");
            $hasCoords = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$hasCoords) {
                // Si no tiene coordenadas, devolver todos los hoteles
                return $this->getAll();
            }
            
            $query = "SELECT *, 
                    (6371 * acos(cos(radians(:lat)) * cos(radians(latitud)) * 
                    cos(radians(longitud) - radians(:lng)) + sin(radians(:lat)) * 
                    sin(radians(latitud)))) AS distance 
                    FROM hotels 
                    HAVING distance < :radius 
                    ORDER BY distance 
                    LIMIT 50";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":lat", $lat);
            $stmt->bindParam(":lng", $lng);
            $stmt->bindParam(":radius", $radius);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        // Obtener todos los hoteles (método alternativo para el API)
        public function getAllHotels() {
            return $this->getAll();
        }
    
        // Obtener hotel por ID (método alternativo para el API)
        public function getHotelById($id) {
            return $this->find($id);
        }
    
      // Búsqueda avanzada de hoteles
public function searchHotels($filters = []) {
    $sql = "SELECT * FROM hotels WHERE 1=1";
    $params = [];
    
    if (isset($filters['q']) && !empty($filters['q'])) {
        $sql .= " AND (name LIKE ? OR address LIKE ? OR district LIKE ? OR province LIKE ? OR department LIKE ?)";
        $searchTerm = "%" . $filters['q'] . "%";
        $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm]);
    }
    
    if (isset($filters['category']) && !empty($filters['category'])) {
        $sql .= " AND category = ?";
        $params[] = $filters['category'];
    }
    
    if (isset($filters['location']) && !empty($filters['location'])) {
        $sql .= " AND (district LIKE ? OR province LIKE ? OR department LIKE ? OR address LIKE ?)";
        $locationTerm = "%" . $filters['location'] . "%";
        $params = array_merge($params, [$locationTerm, $locationTerm, $locationTerm, $locationTerm]);
    }
    
    $sql .= " ORDER BY name LIMIT 100";
    
    $stmt = $this->db->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
