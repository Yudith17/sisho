<?php
session_start();

// Si no está autenticado, redirigir al login
if (!isset($_SESSION['usuario'])) {
    header("Location: public/login.php");
    exit;
}

// Si sí está autenticado, proceder con el enrutamiento MVC
$controller = $_GET['controller'] ?? 'client_api';
$action     = $_GET['action'] ?? 'index';

$controllerClass = ucfirst($controller) . 'Controller';
$controllerFile  = __DIR__ . '/controllers/' . $controllerClass . '.php';

if (!file_exists($controllerFile)) {
    die("Controlador no encontrado: $controllerFile");
}

require_once $controllerFile;

$ctrl = new $controllerClass();

if (!method_exists($ctrl, $action)) {
    die("Acción no definida: $action");
}

$ctrl->$action();
