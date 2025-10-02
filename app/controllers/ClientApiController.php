<?php
require_once __DIR__ . '/../models/ClientApi.php';

class ClientApiController {
    private $clientApiModel;

    public function __construct() {
        $this->clientApiModel = new ClientApi(Database::getInstance());
    }

    public function index() {
        $clients = $this->clientApiModel->getAll();
        require __DIR__ . '/../views/client_api/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->clientApiModel->create(
                $_POST['ruc'],
                $_POST['razon_social'],
                $_POST['telefono'],
                $_POST['correo'],
                $_POST['estado']
            );
            header("Location: index.php?controller=clientapi&action=index");
            exit;
        }
        require __DIR__ . '/../views/client_api/create.php';
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) die("ID no especificado.");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->clientApiModel->update(
                $id,
                $_POST['ruc'],
                $_POST['razon_social'],
                $_POST['telefono'],
                $_POST['correo'],
                $_POST['estado']
            );
            header("Location: index.php?controller=clientapi&action=index");
            exit;
        } else {
            $client = $this->clientApiModel->find($id);
            require __DIR__ . '/../views/client_api/edit.php';
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->clientApiModel->delete($id);
            header("Location: index.php?controller=clientapi&action=index");
            exit;
        }
    }

    public function view() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $client = $this->clientApiModel->find($id);
            require __DIR__ . '/../views/client_api/view.php';
        }
    }
}