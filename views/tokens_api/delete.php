<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../controllers/TokenApiController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new TokenApiController();
    $id = $_POST['id'] ?? 0;
    
    if ($id) {
        $controller->delete($id);
    }
}

header('Location: ' . BASE_URL . '/tokens_api');
exit;