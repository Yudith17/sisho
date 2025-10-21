<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../app/controllers/PublicApiController.php';

$controller = new PublicApiController();
$method = $_SERVER['REQUEST_METHOD'];
$request = $_GET;

try {
    if ($method == 'GET') {
        if (isset($request['action'])) {
            switch ($request['action']) {
                case 'search':
                    $results = $controller->searchHotels($request);
                    echo json_encode([
                        'success' => true,
                        'data' => $results,
                        'count' => count($results)
                    ]);
                    break;
                    
                case 'get_hotel':
                    if (isset($request['id'])) {
                        $hotel = $controller->getHotel($request['id']);
                        echo json_encode([
                            'success' => true,
                            'data' => $hotel
                        ]);
                    } else {
                        throw new Exception('ID de hotel requerido');
                    }
                    break;
                    
                default:
                    throw new Exception('Acción no válida');
            }
        } else {
            // Acción por defecto - mostrar todos los hoteles
            $results = $controller->searchHotels([]);
            echo json_encode([
                'success' => true,
                'data' => $results,
                'count' => count($results)
            ]);
        }
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>