<?php
require_once __DIR__ . '/../models/TokenApi.php';
require_once __DIR__ . '/../models/ClientApi.php';

class TokenApiController {
    private $tokenApiModel;
    private $clientApiModel;

    public function __construct() {
        $this->tokenApiModel = new TokenApi(Database::getInstance());
        $this->clientApiModel = new ClientApi(Database::getInstance());
    }

    public function index() {
        $tokens = $this->tokenApiModel->getAll();
        $clients = $this->clientApiModel->getAll();
        require __DIR__ . '/../views/token_api/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // OBTENER el id_cliente_api del formulario
            $id_cliente_api = $_POST['id_cliente_api'] ?? null;
            
            // CORRECCIÓN: Pasar el id_cliente_api como parámetro
            $token = $this->tokenApiModel->generateToken($id_cliente_api);
            
            $this->tokenApiModel->create(
                $id_cliente_api,
                $token,
                $_POST['estado']
            );
            header("Location: index.php?controller=tokenapi&action=index");
            exit;
        }
        
        $clients = $this->clientApiModel->getAll();
        require __DIR__ . '/../views/token_api/create.php';
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) die("ID no especificado.");
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['token'] ?? '';
            if (empty($token)) {
                $_SESSION['error'] = "El token no puede estar vacío";
                header("Location: index.php?controller=tokenapi&action=edit&id=" . $id);
                exit;
            }
    
            $this->tokenApiModel->update(
                $id,
                $_POST['id_cliente_api'],
                $token,
                $_POST['estado']
            );
            header("Location: index.php?controller=tokenapi&action=index");
            exit;
        } else {
            $token = $this->tokenApiModel->find($id);
            $clients = $this->clientApiModel->getAll();
            require __DIR__ . '/../views/token_api/edit.php';
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->tokenApiModel->delete($id);
            header("Location: index.php?controller=tokenapi&action=index");
            exit;
        }
    }

    public function view() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $token = $this->tokenApiModel->find($id);
            require __DIR__ . '/../views/token_api/view.php';
        }
    }
}