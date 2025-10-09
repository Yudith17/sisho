<?php
session_start();


// ==================== RUTAS DE API PÚBLICAS ====================
// Estas rutas no requieren autenticación de sesión
if (isset($_GET['url'])) {
    $url = $_GET['url'];
    
    // Rutas de API para clientes
    if ($url === 'api/client/search') {
        $controller = 'clientapi';
        $action = 'apiSearch';
        $_GET['controller'] = $controller;
        $_GET['action'] = $action;
    } 
    elseif (preg_match('#^api/client/view/(\d+)$#', $url, $matches)) {
        $controller = 'clientapi';
        $action = 'apiView';
        $_GET['controller'] = $controller;
        $_GET['action'] = $action;
        $_GET['id'] = $matches[1];
    }
}

// Si no está autenticado, redirigir al login (excepto para rutas de API)
if (!isset($_SESSION['usuario']) && !isset($_GET['url'])) {
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