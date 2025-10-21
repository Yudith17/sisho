<?php
// buscar_hoteles.php - CON CONTRASEÑA CORRECTA
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json; charset=utf-8');

// Configuración CORRECTA (password: 'root')
$host = 'localhost';
$dbname = 'sisho';
$username = 'root';
$password = 'root';  // ← ESTA ES LA CONTRASEÑA CORRECTA

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Parámetros de búsqueda
    $search = $_GET['search'] ?? '';
    $category = $_GET['category'] ?? '';
    $sort = $_GET['sort'] ?? 'name';
    
    // Construir consulta
    $sql = "SELECT * FROM hotels WHERE 1=1";
    $params = [];
    
    if (!empty($search)) {
        $sql .= " AND (name LIKE ? OR address LIKE ? OR district LIKE ?)";
        $searchTerm = "%$search%";
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $params[] = $searchTerm;
    }
    
    if (!empty($category)) {
        $sql .= " AND category = ?";
        $params[] = $category;
    }
    
    // Ordenamiento
    switch ($sort) {
        case 'name_desc':
            $sql .= " ORDER BY name DESC";
            break;
        case 'category':
            $sql .= " ORDER BY category";
            break;
        case 'category_desc':
            $sql .= " ORDER BY category DESC";
            break;
        default:
            $sql .= " ORDER BY name";
            break;
    }
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $hotels = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'hotels' => $hotels,
        'total' => count($hotels)
    ]);
    
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Error de base de datos: ' . $e->getMessage()
    ]);
}
?>