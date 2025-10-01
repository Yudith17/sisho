<?php
require_once __DIR__ . '/../config/database.php';

// Router básico
$controllerName = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';

// Cargar controlador
$controllerClass = ucfirst($controllerName) . 'Controller';
$controllerFile = __DIR__ . "/../app/controllers/{$controllerClass}.php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    
    // Verificar si la clase existe
    if (class_exists($controllerClass)) {
        $controller = new $controllerClass();
        
        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            die("La acción '$action' no existe en el controlador '$controllerClass'.");
        }
    } else {
        die("La clase '$controllerClass' no existe en el archivo.");
    }
} else {
    // Si no existe el controlador, redirigir al login
    header("Location: login.php");
    exit;
}