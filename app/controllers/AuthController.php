<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = new User();
            $user = $userModel->login($username, $password);

            if ($user) {
                $_SESSION['user'] = $user;
                header("Location: index.php?controller=hotel&action=index");
                exit;
            } else {
                $error = "Usuario o contraseña incorrectos.";
                require __DIR__ . '/../views/auth/login.php';
            }
        } else {
            require __DIR__ . '/../views/auth/login.php';
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        unset($_SESSION['user']);

        // Redirigir siempre al login
        header("Location: index.php?controller=auth&action=login");
        exit;
    }

    public function index() {
      
    }
}