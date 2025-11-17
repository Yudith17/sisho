<?php
// controllers/AuthController.php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    // 🔹 Mostrar formulario de login
    public function showLogin() {
        if (isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/hoteles');
            exit;
        }
        require_once view_path('views/auth/login.php');
    }

    // 🔹 Procesar login
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->login($email, $password);
            
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nombre'];
                $_SESSION['user_email'] = $user['email'];
                
                header('Location: ' . BASE_URL . '/hoteles');
                exit;
            } else {
                $_SESSION['error'] = 'Credenciales incorrectas. Usa tu email y contraseña personalizados';
                header('Location: ' . BASE_URL . '/login');
                exit;
            }
        } else {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    // 🔹 Cerrar sesión
    public function logout() {
        session_destroy();
        header('Location: ' . BASE_URL . '/login');
        exit;
    }
}