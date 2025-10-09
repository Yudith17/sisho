<?php
 require_once __DIR__ . '/../models/ClientApi.php';
 require_once __DIR__ . '/../models/CountRequest.php';
 require_once __DIR__ . '/../models/TokenApi.php';

class ClientApiController {
    private $clientApiModel;
    private $hotelModel;

    public function __construct() {
        $this->clientApiModel = new ClientApi();
        $this->hotelModel = new Hotel();
    }

    // ==================== ACCIONES DE ADMINISTRACIÓN ====================

    public function index() {
        $clients = $this->clientApiModel->getAll();
        require __DIR__ . '/../views/client_api/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->clientApiModel->create(
                $_POST['ruc'],
                $_POST['razon_social'],
                $_POST['telefono'],
                $_POST['correo'],
                $_POST['estado']
            );
            header("Location: index.php?controller=clientapi&action=index");
            exit;
        }
        require __DIR__ . '/../views/client_api/create.php';
    }

    public function view() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $client = $this->clientApiModel->find($id);
            require __DIR__ . '/../views/client_api/view.php';
        }
    }
    
 
        
        public function search() {
            // Verificar autenticación
            if (!isset($_SESSION['user_id'])) {
                header('Location: index.php?controller=auth&action=login');
                exit;
            }
    
            $clientId = $_GET['id'] ?? null;
            
            if (!$clientId) {
                $_SESSION['error'] = 'ID de cliente no especificado';
                header('Location: index.php?controller=clientapi&action=index');
                exit;
            }
    
            try {
                // Obtener datos del cliente
                $clientApiModel = new ClientApi();
                $client = $clientApiModel->getById($clientId);
                
                if (!$client) {
                    $_SESSION['error'] = 'Cliente no encontrado';
                    header('Location: index.php?controller=clientapi&action=index');
                    exit;
                }
    
                // Obtener estadísticas de requests
                $countRequestModel = new CountRequest();
                $stats = $countRequestModel->getStatsByClient($clientId);
    
                // Obtener historial de requests
                $requests = $countRequestModel->getByClientId($clientId);
    
                // Obtener tokens del cliente
                $tokenApiModel = new TokenApi();
                $tokens = $tokenApiModel->getByClientId($clientId);
    
                // Cargar vista
                require_once __DIR__ . '/../views/client_api/search.php';
                
            } catch (Exception $e) {
                $_SESSION['error'] = 'Error al cargar los datos: ' . $e->getMessage();
                header('Location: index.php?controller=clientapi&action=index');
                exit;
            }
        }

    // ==================== ACCIONES DE API PARA CLIENTES ====================

    /**
     * Buscar hoteles según criterios
     */
    public function apiSearch() {
        try {
            // Verificar autenticación del cliente API
            $client = $this->authenticateApiClient();
            if (!$client) {
                return $this->jsonResponse(['error' => 'Acceso no autorizado'], 401);
            }

            // Registrar la solicitud en Count_Request
            $this->registerApiRequest($client['token_id'], 'search');

            // Obtener parámetros de búsqueda
            $searchParams = $this->getSearchParams();
            
            // Lógica de búsqueda usando el método getAll() del modelo Hotel
            $allHotels = $this->hotelModel->getAll();
            
            // Filtrar resultados según parámetros
            $results = $this->filterHotels($allHotels, $searchParams);
            
            return $this->jsonResponse([
                'success' => true,
                'data' => $results,
                'total' => count($results)
            ]);
            
        } catch (Exception $e) {
            return $this->jsonResponse(['error' => 'Error en la búsqueda: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Ver detalles de un hotel específico
     */
    public function apiView() {
        $id = $_GET['id'] ?? null;
        
        try {
            // Verificar autenticación del cliente API
            $client = $this->authenticateApiClient();
            if (!$client) {
                return $this->jsonResponse(['error' => 'Acceso no autorizado'], 401);
            }

            // Registrar la solicitud en Count_Request
            $this->registerApiRequest($client['token_id'], 'view');

            // Validar ID
            if (!is_numeric($id) || $id <= 0) {
                return $this->jsonResponse(['error' => 'ID inválido'], 400);
            }
            
            // Obtener detalles del hotel usando el método find() del modelo Hotel
            $hotelDetails = $this->hotelModel->find($id);
            
            if (!$hotelDetails) {
                return $this->jsonResponse(['error' => 'Hotel no encontrado'], 404);
            }
            
            return $this->jsonResponse([
                'success' => true,
                'data' => $hotelDetails
            ]);
            
        } catch (Exception $e) {
            return $this->jsonResponse(['error' => 'Error al obtener detalles: ' . $e->getMessage()], 500);
        }
    }

    // ==================== MÉTODOS PRIVADOS PARA API ====================

    /**
     * Autenticar cliente API mediante token
     */
    private function authenticateApiClient() {
        // Obtener API key del header
        $apiKey = $_SERVER['HTTP_X_API_KEY'] ?? $_GET['api_key'] ?? null;
        
        if (!$apiKey) {
            return false;
        }

        // Verificar si el token es válido y el cliente está activo
        return $this->clientApiModel->findByToken($apiKey);
    }

    /**
     * Registrar solicitud en Count_Request
     */
    private function registerApiRequest($tokenId, $tipo) {
        $this->clientApiModel->registerRequest($tokenId, $tipo);
    }

    /**
     * Obtener y validar parámetros de búsqueda
     */
    private function getSearchParams() {
        $params = [];
        
        $possibleParams = [
            'name', 'category', 'district', 'province', 'department',
            'page', 'limit'
        ];
        
        foreach ($possibleParams as $param) {
            if (isset($_GET[$param]) && !empty(trim($_GET[$param]))) {
                $params[$param] = trim($_GET[$param]);
            }
        }
        
        return $params;
    }

    /**
     * Filtrar hoteles según parámetros
     */
    private function filterHotels($hotels, $params) {
        $filtered = $hotels;
        
        if (isset($params['name']) && !empty($params['name'])) {
            $filtered = array_filter($filtered, function($hotel) use ($params) {
                return stripos($hotel['name'], $params['name']) !== false;
            });
        }
        
        if (isset($params['category']) && !empty($params['category'])) {
            $filtered = array_filter($filtered, function($hotel) use ($params) {
                return $hotel['category'] === $params['category'];
            });
        }
        
        if (isset($params['district']) && !empty($params['district'])) {
            $filtered = array_filter($filtered, function($hotel) use ($params) {
                return stripos($hotel['district'], $params['district']) !== false;
            });
        }
        
        if (isset($params['province']) && !empty($params['province'])) {
            $filtered = array_filter($filtered, function($hotel) use ($params) {
                return stripos($hotel['province'], $params['province']) !== false;
            });
        }
        
        if (isset($params['department']) && !empty($params['department'])) {
            $filtered = array_filter($filtered, function($hotel) use ($params) {
                return stripos($hotel['department'], $params['department']) !== false;
            });
        }
        
        // Aplicar paginación
        $limit = isset($params['limit']) ? (int)$params['limit'] : 10;
        $page = isset($params['page']) ? (int)$params['page'] : 1;
        $offset = ($page - 1) * $limit;
        
        return array_slice(array_values($filtered), $offset, $limit);
    }

    /**
     * Enviar respuesta JSON
     */
    private function jsonResponse($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }
}