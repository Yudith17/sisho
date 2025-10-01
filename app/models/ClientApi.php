<?php
require_once __DIR__ . '/../../config/database.php';

class ClientApi {
    private $db;

    public function __construct($pdo = null) {
        $this->db = $pdo ?? Database::getInstance();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM client_api ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM client_api WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($ruc, $razon_social, $telefono, $correo) {
        $stmt = $this->db->prepare("
            INSERT INTO client_api (ruc, razon_social, telefono, correo)
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([$ruc, $razon_social, $telefono, $correo]);
    }

    public function update($id, $ruc, $razon_social, $telefono, $correo, $estado) {
        $stmt = $this->db->prepare("
            UPDATE client_api
            SET ruc = ?, razon_social = ?, telefono = ?, correo = ?, estado = ?
            WHERE id = ?
        ");
        return $stmt->execute([$ruc, $razon_social, $telefono, $correo, $estado, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM client_api WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
