<?php
// index.php
require_once __DIR__ . '/config/config.php';

// Incluir controladores
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/HotelController.php';
require_once __DIR__ . '/controllers/ClientApiController.php';
require_once __DIR__ . '/controllers/TokenApiController.php';
require_once __DIR__ . '/controllers/CountRequestController.php';

// Enrutamiento básico
$request = $_SERVER['REQUEST_URI'];
$base_path = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
$route = str_replace($base_path, '', $request);
$route = explode('?', $route)[0];

// Instanciar controladores
$authController = new AuthController();
$hotelController = new HotelController();

// Rutas
switch ($route) {
    case '/':
    case '/login':
        $authController->showLogin();
        break;
        
    case '/auth/login':
        $authController->login();
        break;
        
    case '/logout':
        $authController->logout();
        break;
        
    case '/hoteles':
        $hotelController->index();
        break;
        
    case '/hoteles/create':
        $hotelController->create();
        break;
        
    case '/hoteles/store':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hotelController->store($_POST);
        } else {
            header('Location: ' . BASE_URL . '/hoteles');
        }
        break;
        
    case str_starts_with($route, '/hoteles/view/'):
        $id = str_replace('/hoteles/view/', '', $route);
        $hotelController->show($id);
        break;
        
    case str_starts_with($route, '/hoteles/edit/'):
        $id = str_replace('/hoteles/edit/', '', $route);
        $hotelController->edit($id);
        break;
        
    case str_starts_with($route, '/hoteles/update/'):
        $id = str_replace('/hoteles/update/', '', $route);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hotelController->update($id, $_POST);
        } else {
            header('Location: ' . BASE_URL . '/hoteles');
        }
        break;
        
    case str_starts_with($route, '/hoteles/delete/'):
        $id = str_replace('/hoteles/delete/', '', $route);
        $hotelController->delete($id);
        break;

// ==================== CLIENT API ROUTES ====================
case '/client_api':
    $clientApiController = new ClientApiController();
    $clientApiController->index(); // Este método ahora carga la vista
    break;
    
case '/client_api/create':
    $clientApiController = new ClientApiController();
    $clientApiController->create();
    break;
    
case '/client_api/store':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $clientApiController = new ClientApiController();
        $clientApiController->store($_POST);
    }
    break;
    
case str_starts_with($route, '/client_api/edit/'):
    $id = str_replace('/client_api/edit/', '', $route);
    $clientApiController = new ClientApiController();
    $clientApiController->edit($id);
    break;
    
case str_starts_with($route, '/client_api/update/'):
    $id = str_replace('/client_api/update/', '', $route);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $clientApiController = new ClientApiController();
        $clientApiController->update($id, $_POST);
    }
    break;
    
case '/client_api/delete':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $clientApiController = new ClientApiController();
        $clientApiController->delete($_POST['id']);
    }
    break;
case str_starts_with($route, '/tokens_api/edit/'):
    $id = str_replace('/tokens_api/edit/', '', $route);
    
    // Usar el modelo directamente o crear una instancia del controlador
    require_once __DIR__ . '/controllers/TokenApiController.php';
    $tokenController = new TokenApiController();
    $token = $tokenController->edit($id);
    
    if ($token) {
        require_once view_path('views/tokens_api/edit.php');
    } else {
        header('Location: ' . BASE_URL . '/tokens_api');
        exit;
    }
    break;

   // ==================== TOKENS API ROUTES ====================
case '/tokens_api':
case '/tokens_api/list':
    $tokenApiController = new TokenApiController();
    $tokenApiController->list();
    break;
    
case '/tokens_api/create':
    $tokenApiController = new TokenApiController();
    $tokenApiController->create();
    break;
    
case '/tokens_api/store':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tokenApiController = new TokenApiController();
        $tokenApiController->store($_POST);
    }
    break;
    
case str_starts_with($route, '/tokens_api/edit/'):
    $id = str_replace('/tokens_api/edit/', '', $route);
    $tokenApiController = new TokenApiController();
    $tokenApiController->edit($id);
    break;
    
case str_starts_with($route, '/tokens_api/update/'):
    $id = str_replace('/tokens_api/update/', '', $route);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tokenApiController = new TokenApiController();
        $tokenApiController->update($id, $_POST);
    }
    break;
    
case '/tokens_api/delete':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tokenApiController = new TokenApiController();
        $tokenApiController->delete($_POST['id']);
    }
    break;

// ==================== COUNT REQUEST ROUTES ====================
case '/count_request':
    $countRequestController = new CountRequestController();
    $countRequestController->index();
    break;
    
case '/count_request/create':
    $countRequestController = new CountRequestController();
    $countRequestController->create();
    break;
    
case '/count_request/store':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $countRequestController = new CountRequestController();
        $countRequestController->store($_POST);
    }
    break;
        
    case str_starts_with($route, '/count_request/edit/'):
    $id = str_replace('/count_request/edit/', '', $route);
    $countRequestController = new CountRequestController();
    $countRequestController->edit($id);
    break;
        
  case str_starts_with($route, '/count_request/update/'):
    $id = str_replace('/count_request/update/', '', $route);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $countRequestController = new CountRequestController();
        $countRequestController->update($id, $_POST);
    }
    break;
        
   case str_starts_with($route, '/count_request/view/'):
    $id = str_replace('/count_request/view/', '', $route);
    $countRequestController = new CountRequestController();
    $countRequestController->view($id);
    break;
        
    case '/count_request/delete':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $countRequestController = new CountRequestController();
            $countRequestController->delete($_POST['id']);
        }
        break;
        
    default:
        http_response_code(404);
        echo 'Página no encontrada';
        break;
}