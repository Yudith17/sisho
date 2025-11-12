<?php
// buscar_hoteles.php - CON CONTRASEÑA CORRECTA Y SISTEMA DE TOKENS
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json; charset=utf-8');

// Configuración CORRECTA (password: 'root')
$host = 'localhost';
$dbname = 'sisho';
$username = 'root';
$password = 'root';  // ← ESTA ES LA CONTRASEÑA CORRECTA

// Configuración del sistema de tokens
$cliente_api_url = 'http://localhost/cliente_api/index.php'; // Ajusta la URL según tu configuración

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Función para generar token seguro
    function generarToken($longitud = 32) {
        return bin2hex(random_bytes($longitud));
    }
    
    // Función para validar y almacenar token en la base de datos
    function almacenarToken($pdo, $token, $datosBusqueda) {
        $sql = "INSERT INTO tokens_api (token, datos_busqueda, fecha_creacion, fecha_expiracion, utilizado) 
                VALUES (:token, :datos_busqueda, NOW(), DATE_ADD(NOW(), INTERVAL 1 HOUR), 0)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':datos_busqueda', json_encode($datosBusqueda));
        
        return $stmt->execute();
    }
    
    // Función para enviar búsqueda a cliente_api
    function enviarABusquedaHoteles($datosBusqueda, $token) {
        global $cliente_api_url;
        
        $payload = array_merge($datosBusqueda, ['token' => $token]);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $cliente_api_url . '?action=buscarHoteles');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        return ['code' => $httpCode, 'data' => json_decode($response, true)];
    }
    
    // Verificar si es una solicitud de búsqueda con token
    $action = $_GET['action'] ?? '';
    
    if ($action === 'buscarConToken') {
        // Generar token único para esta búsqueda
        $token = generarToken();
        
        // Parámetros de búsqueda
        $search = $_GET['search'] ?? '';
        $category = $_GET['category'] ?? '';
        $sort = $_GET['sort'] ?? 'name';
        
        $datosBusqueda = [
            'search' => $search,
            'category' => $category,
            'sort' => $sort,
            'timestamp' => time()
        ];
        
        // Almacenar token en la base de datos
        if (almacenarToken($pdo, $token, $datosBusqueda)) {
            // Enviar búsqueda a cliente_api
            $resultadoAPI = enviarABusquedaHoteles($datosBusqueda, $token);
            
            if ($resultadoAPI['code'] === 200 && isset($resultadoAPI['data']['status']) && $resultadoAPI['data']['status'] === 'success') {
                // Éxito - redirigir a resultados
                echo json_encode([
                    'success' => true,
                    'token' => $token,
                    'redirect_url' => $cliente_api_url . '?action=resultados&token=' . $token,
                    'message' => 'Búsqueda procesada correctamente'
                ]);
            } else {
                // Falló la comunicación con cliente_api, pero igual mostramos resultados locales
                echo json_encode([
                    'success' => true,
                    'token' => $token,
                    'redirect_url' => $cliente_api_url . '?action=resultados&token=' . $token,
                    'warning' => 'Comunicación con API secundaria falló, pero la búsqueda fue procesada',
                    'datos_busqueda' => $datosBusqueda
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'error' => 'Error al generar token de seguridad'
            ]);
        }
        exit;
    }
    
    // BÚSQUEDA LOCAL ORIGINAL (se mantiene igual)
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
    
    // Si se solicita solo datos (sin token), devolver resultados normales
    if ($action === 'soloDatos') {
        echo json_encode([
            'success' => true,
            'hotels' => $hotels,
            'total' => count($hotels),
            'search_params' => [
                'search' => $search,
                'category' => $category,
                'sort' => $sort
            ]
        ]);
    } else {
        // Respuesta normal (compatible con el código original)
        echo json_encode([
            'success' => true,
            'hotels' => $hotels,
            'total' => count($hotels)
        ]);
    }
    
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Error de base de datos: ' . $e->getMessage()
    ]);
}
?>

<!-- HTML FORM PARA BÚSQUEDA CON TOKEN (se puede incluir o usar por separado) -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Hoteles con Token</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { padding: 8px; width: 300px; border: 1px solid #ddd; border-radius: 4px; }
        button { padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .resultado { margin-top: 20px; padding: 15px; border-radius: 5px; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .token-info { background: #fff3cd; color: #856404; border: 1px solid #ffeaa7; padding: 10px; margin: 10px 0; }
    </style>
</head>
<body>
    <h1>Buscar Hoteles con Sistema de Tokens</h1>
    
    <form id="busquedaForm">
        <div class="form-group">
            <label for="search">Buscar (nombre, dirección o distrito):</label>
            <input type="text" id="search" name="search" placeholder="Ej: Miraflores, Hotel Lima, etc.">
        </div>
        
        <div class="form-group">
            <label for="category">Categoría:</label>
            <select id="category" name="category">
                <option value="">Todas las categorías</option>
                <option value="5 estrellas">5 estrellas</option>
                <option value="4 estrellas">4 estrellas</option>
                <option value="3 estrellas">3 estrellas</option>
                <option value="2 estrellas">2 estrellas</option>
                <option value="1 estrella">1 estrella</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="sort">Ordenar por:</label>
            <select id="sort" name="sort">
                <option value="name">Nombre (A-Z)</option>
                <option value="name_desc">Nombre (Z-A)</option>
                <option value="category">Categoría (Ascendente)</option>
                <option value="category_desc">Categoría (Descendente)</option>
            </select>
        </div>
        
        <button type="button" onclick="buscarConToken()">Buscar con Token</button>
        <button type="button" onclick="buscarSinToken()">Busqueda Rápida (Sin Token)</button>
    </form>
    
    <div id="resultado"></div>
    <div id="resultadosHoteles"></div>

    <script>
        function buscarConToken() {
            const formData = new FormData(document.getElementById('busquedaForm'));
            const params = new URLSearchParams(formData);
            
            document.getElementById('resultado').innerHTML = '<div class="token-info">Generando token y procesando búsqueda...</div>';
            
            fetch('<?php echo $_SERVER['PHP_SELF']; ?>?action=buscarConToken&' + params.toString())
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('resultado').innerHTML = 
                            '<div class="success">' +
                            '<strong>✓ Búsqueda exitosa</strong><br>' +
                            'Token generado: ' + data.token + '<br>' +
                            (data.message || '') +
                            '</div>';
                        
                        // Redirigir a cliente_api para ver resultados
                        if (data.redirect_url) {
                            setTimeout(() => {
                                window.location.href = data.redirect_url;
                            }, 2000);
                        }
                    } else {
                        document.getElementById('resultado').innerHTML = 
                            '<div class="error"><strong>Error:</strong> ' + data.error + '</div>';
                    }
                })
                .catch(error => {
                    document.getElementById('resultado').innerHTML = 
                        '<div class="error"><strong>Error de conexión:</strong> ' + error.message + '</div>';
                });
        }
        
        function buscarSinToken() {
            const formData = new FormData(document.getElementById('busquedaForm'));
            const params = new URLSearchParams(formData);
            
            fetch('<?php echo $_SERVER['PHP_SELF']; ?>?action=soloDatos&' + params.toString())
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        let html = '<h3>Resultados de Búsqueda (' + data.total + ' hoteles encontrados)</h3>';
                        
                        if (data.hotels.length > 0) {
                            data.hotels.forEach(hotel => {
                                html += '<div style="border:1px solid #ddd; padding:10px; margin:5px 0;">' +
                                        '<strong>' + hotel.name + '</strong> - ' + hotel.category + '<br>' +
                                        'Dirección: ' + hotel.address + ', ' + hotel.district +
                                        '</div>';
                            });
                        } else {
                            html += '<p>No se encontraron hoteles para tu búsqueda.</p>';
                        }
                        
                        document.getElementById('resultadosHoteles').innerHTML = html;
                    } else {
                        document.getElementById('resultadosHoteles').innerHTML = 
                            '<div class="error">Error: ' + data.error + '</div>';
                    }
                });
        }
    </script>
</body>
</html>