<?php
// validar_token.php
session_start();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Configurar zona horaria
date_default_timezone_set('America/Lima');

// Manejar preflight requests de CORS
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

// Incluir la configuración de la base de datos
require_once 'config/database.php'; // Ajusta la ruta según tu estructura

// Función para conectar a la base de datos
function getDatabaseConnection() {
    try {
        $database = Database::getInstance();
        return $database;
    } catch (Exception $e) {
        error_log("Error de conexión: " . $e->getMessage());
        return null;
    }
}

// Función para validar el token
function validarToken($token) {
    if (empty($token)) {
        return ['success' => false, 'message' => 'Token vacío'];
    }
    
    $pdo = getDatabaseConnection();
    if (!$pdo) {
        return ['success' => false, 'message' => 'Error de conexión a la base de datos'];
    }
    
    try {
        // Buscar el token en la base de datos - AJUSTADO A TU ESTRUCTURA
        $stmt = $pdo->prepare("
            SELECT t.*, ca.razon_social 
            FROM Token t 
            INNER JOIN Cliente_Api ca ON t.Id_cliente_Api = ca.id 
            WHERE t.Token = ? AND t.Estado = 1
        ");
        
        $stmt->execute([$token]);
        $tokenData = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($tokenData) {
            return [
                'success' => true,
                'message' => 'Token válido',
                'cliente' => $tokenData['razon_social'],
                'token_data' => [
                    'id' => $tokenData['id'],
                    'fecha_registro' => $tokenData['Fecha_registro']
                ]
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Token inválido o expirado'
            ];
        }
        
    } catch (PDOException $e) {
        error_log("Error en validar_token.php: " . $e->getMessage());
        return [
            'success' => false,
            'message' => 'Error del servidor al validar token'
        ];
    }
}

// Procesar la solicitud
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    
    // Si no se pudo decodificar JSON, intentar con FormData
    if (!$data) {
        $data = $_POST;
    }
    
    $action = $data['action'] ?? $_POST['action'] ?? '';
    $token = $data['token'] ?? $_POST['token'] ?? '';
    
    if ($action === 'validarToken') {
        $resultado = validarToken($token);
        echo json_encode($resultado);
    } else {
        echo json_encode(['success' => false, 'message' => 'Acción no válida']);
    }
    
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // También permitir validación por GET para testing
    $token = $_GET['token'] ?? '';
    if (!empty($token)) {
        $resultado = validarToken($token);
        echo json_encode($resultado);
    } else {
        echo json_encode(['success' => false, 'message' => 'Token no proporcionado']);
    }
    
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>