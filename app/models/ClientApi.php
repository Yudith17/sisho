<?php
require_once __DIR__ . '/../../config/database.php';

class ClientApi {
    private $db;

    public function __construct($pdo = null) {
        $this->db = $pdo ?? Database::getInstance();
    }

    // Obtener todos los clientes API
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM Cliente_Api ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar un cliente por ID
    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM Cliente_Api WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo cliente API
    public function create($ruc, $razon_social, $telefono, $correo, $estado) {
        $stmt = $this->db->prepare("
            INSERT INTO Cliente_Api (ruc, razon_social, telefono, correo, estado)
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$ruc, $razon_social, $telefono, $correo, $estado]);
    }

    // Editar cliente API
    public function update($id, $ruc, $razon_social, $telefono, $correo, $estado) {
        $stmt = $this->db->prepare("
            UPDATE Cliente_Api 
            SET ruc=?, razon_social=?, telefono=?, correo=?, estado=?
            WHERE id=?
        ");
        return $stmt->execute([$ruc, $razon_social, $telefono, $correo, $estado, $id]);
    }

    // Eliminar cliente API
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM Cliente_Api WHERE id = ?");
        return $stmt->execute([$id]);
    }
}