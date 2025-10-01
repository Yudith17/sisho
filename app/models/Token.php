<?php
class Token {
    private $pdo;
    private $table_name = "tokens";

    public $id;
    public $cliente_api_id;
    public $token;
    public $fecha_creacion;
    public $fecha_expiracion;
    public $estado;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function create(){
        $sql = "INSERT INTO {$this->table_name} 
                (cliente_api_id, token, fecha_creacion, fecha_expiracion, estado)
                VALUES (:cliente_api_id, :token, :fecha_creacion, :fecha_expiracion, :estado)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':cliente_api_id' => $this->cliente_api_id,
            ':token' => $this->token,
            ':fecha_creacion' => $this->fecha_creacion,
            ':fecha_expiracion' => $this->fecha_expiracion,
            ':estado' => $this->estado
        ]);
    }

    public function readAll(){
        $sql = "SELECT t.*, c.razon_social 
                FROM {$this->table_name} t 
                LEFT JOIN cliente_api c ON t.cliente_api_id = c.id 
                ORDER BY t.id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readOne(){
        $sql = "SELECT t.*, c.razon_social 
                FROM {$this->table_name} t 
                LEFT JOIN cliente_api c ON t.cliente_api_id = c.id 
                WHERE t.id = :id LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $this->id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(){
        $sql = "UPDATE {$this->table_name}
                SET cliente_api_id=:cliente_api_id, fecha_creacion=:fecha_creacion, 
                    fecha_expiracion=:fecha_expiracion, estado=:estado
                WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':cliente_api_id' => $this->cliente_api_id,
            ':fecha_creacion' => $this->fecha_creacion,
            ':fecha_expiracion' => $this->fecha_expiracion,
            ':estado' => $this->estado,
            ':id' => $this->id
        ]);
    }

    public function delete(){
        $sql = "DELETE FROM {$this->table_name} WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $this->id]);
    }
}