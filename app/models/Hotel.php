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
}
