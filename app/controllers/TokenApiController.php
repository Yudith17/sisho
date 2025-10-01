<?php
require_once __DIR__ . '/../models/TokenApi.php';
require_once __DIR__ . '/../models/ClientApi.php';

class TokenApiController {
    private $tokenModel;
    private $clientModel;

    public function __construct() {
        $this->tokenModel = new TokenApi(Database::getInstance());
        $this->clientModel = new ClientApi(Database::getInstance());
    }

    public function index() {
        $tokens = $this->tokenModel->getAll();
        require __DIR__ . '/../views/token_api/index.php';
    }

    public function create() {
        $clients = $this->clientModel->getAll();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->tokenModel->create(
                $_POST['id_client_api'],
                $_POST['token']
            );
            header("Location: index.php?controller=token_api&action=index");
            exit;
        }
        require __DIR__ . '/../views/token_api/create.php';
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) die("ID no especificado.");

        $clients = $this->clientModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->tokenModel->update(
                $id,
                $_POST['id_client_api'],
                $_POST['token'],
                $_POST['estado']
            );
            header("Location: index.php?controller=token_api&action=index");
            exit;
        } else {
            $token = $this->tokenModel->find($id);
            require __DIR__ . '/../views/token_api/edit.php';
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->tokenModel->delete($id);
            header("Location: index.php?controller=token_api&action=index");
            exit;
        }
    }

    public function view() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $token = $this->tokenModel->find($id);
            require __DIR__ . '/../views/token_api/view.php';
        }
    }
}
