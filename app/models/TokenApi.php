<?php
require_once __DIR__ . '/../../config/database.php';

class TokenApi {
    private $db;

    public function __construct($pdo = null) {
        $this->db = $pdo ?? Database::getInstance();
    }

    public function getAll() {
        $stmt = $this->db->query("
            SELECT t.*, c.ruc, c.razon_social 
            FROM tokens_api t
            JOIN client_api c ON t.id_client_api = c.id
            ORDER BY t.id DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $stmt = $this->db->prepare("
            SELECT t.*, c.ruc, c.razon_social 
            FROM tokens_api t
            JOIN client_api c ON t.id_client_api = c.id
            WHERE t.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($id_client_api, $token) {
        $stmt = $this->db->prepare("
            INSERT INTO tokens_api (id_client_api, token)
            VALUES (?, ?)
        ");
        return $stmt->execute([$id_client_api, $token]);
    }

    public function update($id, $id_client_api, $token, $estado) {
        $stmt = $this->db->prepare("
            UPDATE tokens_api
            SET id_client_api = ?, token = ?, estado = ?
            WHERE id = ?
        ");
        return $stmt->execute([$id_client_api, $token, $estado, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM tokens_api WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
