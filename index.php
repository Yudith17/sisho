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
    // AGREGAR ESTA NUEVA RUTA PARA CLIENTE_API - CORREGIDO
    elseif ($url === 'cliente_api') {
        $controller = 'clientapi';    // ← Controlador existente
        $action = 'cliente_api';      // ← Nueva acción que creamos
        $_GET['controller'] = $controller;
        $_GET['action'] = $action;
    }
}

// Si no está autenticado, redirigir al login (excepto para rutas de API)
if (!isset($_SESSION['usuario']) && !isset($_GET['url'])) {
    header("Location: public/index.php");
    exit;
}

// Si no está autenticado PERO está intentando acceder a rutas públicas de API, permitir
if (!isset($_SESSION['usuario']) && isset($_GET['url'])) {
    $url = $_GET['url'];
    $publicRoutes = [
        'api/client/search',
        'api/client/view',
        'cliente_api'  // ← SOLO mantener 'cliente_api'
    ];
    
    $isPublicRoute = false;
    foreach ($publicRoutes as $route) {
        if (strpos($url, $route) === 0) {
            $isPublicRoute = true;
            break;
        }
    }
    
    if (!$isPublicRoute) {
        header("Location: public/login.php");
        exit;
    }
}
// REDIRECCIÓN A LOGIN SI SE ACCEDE A LA RAIZ SIN PARÁMETROS
if (!isset($_GET['url']) && !isset($_GET['controller']) && !isset($_GET['action'])) {
    // VERIFICAR que no estamos ya en el login para evitar bucle
    $current_url = $_SERVER['REQUEST_URI'];
    if (strpos($current_url, 'login.php') === false) {
        header("Location: public/login.php");
        exit;
    }
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