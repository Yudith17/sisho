<?php
require_once __DIR__ . '/../models/ClientApi.php';

class ClientApiController {
    private $clientModel;

    public function __construct() {
        $this->clientModel = new ClientApi(Database::getInstance());
    }

    public function index() {
        $clients = $this->clientModel->getAll();
        require __DIR__ . '/../views/client_api/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->clientModel->create(
                $_POST['ruc'],
                $_POST['razon_social'],
                $_POST['telefono'],
                $_POST['correo']
            );
            header("Location: index.php?controller=client_api&action=index");
            exit;
        }
        require __DIR__ . '/../views/client_api/create.php';
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) die("ID no especificado.");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->clientModel->update(
                $id,
                $_POST['ruc'],
                $_POST['razon_social'],
                $_POST['telefono'],
                $_POST['correo'],
                $_POST['estado']
            );
            header("Location: index.php?controller=client_api&action=index");
            exit;
        } else {
            $client = $this->clientModel->find($id);
            require __DIR__ . '/../views/client_api/edit.php';
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->clientModel->delete($id);
            header("Location: index.php?controller=client_api&action=index");
            exit;
        }
    }

    public function view() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $client = $this->clientModel->find($id);
            require __DIR__ . '/../views/client_api/view.php';
        }
    }
}
