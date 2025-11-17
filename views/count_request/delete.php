<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../controllers/CountRequestController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new CountRequestController();
    $id = $_POST['id'] ?? 0;
    
    if ($id) {
        $controller->delete($id);
    }
}

header('Location: ' . BASE_URL . '/count_request');
exit;