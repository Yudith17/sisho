<?php
require_once __DIR__ . '/../models/ClientApi.php';
require_once __DIR__ . '/../models/CountRequest.php';
require_once __DIR__ . '/../models/TokenApi.php';

class ClientApiController {
    private $clientApiModel;

    public function __construct() {
        $this->clientApiModel = new ClientApi();
    }

    // ==================== ACCIÓN VER ====================

    public function index() {
        // TEMPORAL: Comentado para desarrollo
        // if (!isset($_SESSION['user_id'])) {
        //     header('Location: index.php?controller=auth&action=login');
        //     exit;
        // }

        $clients = $this->clientApiModel->getAll();
        require __DIR__ . '/../views/client_api/index.php';
    }

    public function view() {
        // TEMPORAL: Comentado para desarrollo  
        // if (!isset($_SESSION['user_id'])) {
        //     header('Location: index.php?controller=auth&action=login');
        //     exit;
        // }

        $id = $_GET['id'] ?? null;
        if ($id) {
            $client = $this->clientApiModel->find($id);
            if (!$client) {
                $_SESSION['error'] = 'Cliente no encontrado';
                header('Location: index.php?controller=clientapi&action=index');
                exit;
            }
            require __DIR__ . '/../views/client_api/view.php';
        } else {
            $_SESSION['error'] = 'ID no especificado';
            header('Location: index.php?controller=clientapi&action=index');
            exit;
        }
    }

    // ==================== ACCIÓN BUSCAR ====================

    public function search() {
        // TEMPORAL: Comentado para desarrollo
        // if (!isset($_SESSION['user_id'])) {
        //     header('Location: index.php?controller=auth&action=login');
        //     exit;
        // }

        $clientId = $_GET['id'] ?? null;
        
        if (!$clientId) {
            $_SESSION['error'] = 'ID de cliente no especificado';
            header('Location: index.php?controller=clientapi&action=index');
            exit;
        }

        try {
            $client = $this->clientApiModel->find($clientId);
            
            if (!$client) {
                $_SESSION['error'] = 'Cliente no encontrado';
                header('Location: index.php?controller=clientapi&action=index');
                exit;
            }

            $countRequestModel = new CountRequest();
            $stats = $countRequestModel->getStatsByClient($clientId);
            $requests = $countRequestModel->getByClientId($clientId);
            $tokenApiModel = new TokenApi();
            $tokens = $tokenApiModel->getByClientId($clientId);

            require_once __DIR__ . '/../views/client_api/search.php';
            
        } catch (Exception $e) {
            $_SESSION['error'] = 'Error al cargar los datos: ' . $e->getMessage();
            header('Location: index.php?controller=clientapi&action=index');
            exit;
        }
    }

    // ==================== NUEVA ACCIÓN PARA CLIENTE_API ====================
    
    public function cliente_api() {
        // Esta acción carga directamente el archivo cliente_api.php sin requerir autenticación
        // y sin pasar por las vistas del sistema
        
        // Incluir directamente el archivo cliente_api.php que está en la raíz
        include __DIR__ . '/../../cliente_api.php';
        exit; // Importante: salir para que no cargue el layout del sistema
    }
    // ==================== ACCIÓN PÚBLICA CLIENTE_API ====================

}