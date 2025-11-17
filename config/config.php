<?php
// config/config.php
require_once __DIR__ . '/database.php';

// Configuración de la aplicación
define('BASE_URL', 'http://localhost/sisho');
define('SITE_NAME', 'SISHO - Sistema de Hoteles Huanta');

// Iniciar sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Función helper para rutas de vistas - CORREGIDA
// En config/config.php - CORREGIR esta función:
function view_path($path) {
    // Si el path ya incluye 'views/', no lo dupliques
    if (strpos($path, 'views/') === 0) {
        return __DIR__ . '/../' . $path;
    } else {
        return __DIR__ . '/../views/' . $path;
    }
}

// Función helper para assets
function asset($path) {
    return BASE_URL . '/' . ltrim($path, '/');
}

// Conexión a la base de datos
try {
    $database = new Database();
    $pdo = $database->getConnection();
    
    if (!$pdo) {
        throw new Exception("No se pudo establecer conexión con la base de datos");
    }
} catch (Exception $e) {
    die("Error de configuración: " . $e->getMessage());
}