<?php
// app/controllers/AdminController.php
require_once __DIR__ . '/../models/Admin.php';

class AdminController {
    private $model;
    public function __construct() {
        $this->model = new Admin();
    }

    public function loginForm() {
        require __DIR__ . '/../views/admin/login.php';
    }

    public function login() {
        // Si es GET, mostrar formulario
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            require __DIR__ . '/../views/admin/login.php';
            return;
        }
        
        // Si es POST, procesar login
        session_start();
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        
        $admin = $this->model->findByUsername($username);
        
        if ($admin && password_verify($password, $admin['password_hash'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            header('Location: /?route=hotel:index');
            exit;
        } else {
            $_SESSION['flash'] = 'Usuario o contraseña inválidos';
            // Mantener en la misma ruta pero será GET por la redirección
            header('Location: /?route=admin:login');
            exit;
        }
    }
}
