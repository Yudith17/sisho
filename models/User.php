<?php
// models/User.php
require_once __DIR__ . '/../config/config.php';

class User {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    // 🔹 Verificar credenciales de usuario (con MD5)
    public function login($email, $password) {
        $email = trim($email);
        
        // Usar MD5 para comparar contraseñas
        $password_md5 = md5($password);
        
        $stmt = $this->pdo->prepare("SELECT id, nombre, email, password FROM usuarios WHERE email = ? AND password = ?");
        $stmt->execute([$email, $password_md5]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            // Eliminar la contraseña del array antes de retornar
            unset($user['password']);
            return $user;
        }
        return false;
    }

    // 🔹 Obtener usuario por ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT id, nombre, email FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔹 Crear usuario (para futuras expansiones)
    public function create($nombre, $email, $password) {
        $password_md5 = md5($password);
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$nombre, $email, $password_md5]);
    }
}