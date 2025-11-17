<?php
// controllers/ClientApiController.php - CORREGIDO
require_once __DIR__ . '/../models/ClientApi.php';

class ClientApiController {
    private $clientApiModel;

    public function __construct() {
        $this->clientApiModel = new ClientApi();
    }

    // 🔹 Verificar autenticación
    private function checkAuth() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    // 🔹 Listar clientes API
    public function index() {
        $this->checkAuth();
        $clientes = $this->clientApiModel->getAll();
        require_once __DIR__ . '/../views/client_api/index.php';
    }

    // 🔹 Mostrar formulario de creación
    public function create() {
        $this->checkAuth();
        require_once __DIR__ . '/../views/client_api/create.php';
    }

    // 🔹 Guardar nuevo cliente API
    public function store() {
        $this->checkAuth();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->clientApiModel->create([
                'nombre' => $_POST['nombre'],
                'email' => $_POST['email'],
                'empresa' => $_POST['empresa'] ?? '',
                'telefono' => $_POST['telefono'] ?? '',
                'descripcion' => $_POST['descripcion'] ?? ''
            ]);

            if ($result) {
                $_SESSION['success'] = 'Cliente API creado exitosamente';
                header('Location: ' . BASE_URL . '/client_api');
                exit;
            } else {
                $_SESSION['error'] = 'Error al crear el cliente API';
                header('Location: ' . BASE_URL . '/client_api/create');
                exit;
            }
        } else {
            header('Location: ' . BASE_URL . '/client_api/create');
            exit;
        }
    }

    // 🔹 CORREGIDO: Mostrar formulario de edición
    public function edit($id = null) {
        $this->checkAuth();
        
        try {
            // Validar ID
            if (empty($id) || !is_numeric($id)) {
                throw new Exception('ID inválido');
            }
            
            $id = (int)$id;
            $cliente = $this->clientApiModel->getById($id);
            
            // CORREGIDO: Ruta directa sin view_path()
            require_once __DIR__ . '/../views/client_api/edit.php';
            
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: ' . BASE_URL . '/client_api');
            exit;
        }
    }

    // 🔹 Actualizar cliente API
    public function update($id = null) {
        $this->checkAuth();
        
        try {
            // Validar ID
            if (empty($id) || !is_numeric($id)) {
                throw new Exception('ID inválido');
            }
            
            $id = (int)$id;
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $result = $this->clientApiModel->update($id, [
                    'nombre' => $_POST['nombre'],
                    'email' => $_POST['email'],
                    'empresa' => $_POST['empresa'] ?? '',
                    'telefono' => $_POST['telefono'] ?? '',
                    'descripcion' => $_POST['descripcion'] ?? ''
                ]);

                if ($result) {
                    $_SESSION['success'] = 'Cliente API actualizado exitosamente';
                } else {
                    $_SESSION['error'] = 'Error al actualizar el cliente API';
                }
                
            } else {
                throw new Exception('Método no permitido');
            }
            
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }
        
        header('Location: ' . BASE_URL . '/client_api');
        exit;
    }

    // 🔹 Eliminar cliente API
    public function delete($id) {
        $this->checkAuth();
        
        if ($this->clientApiModel->delete($id)) {
            $_SESSION['success'] = 'Cliente API eliminado exitosamente';
        } else {
            $_SESSION['error'] = 'Error al eliminar el cliente API';
        }
        
        header('Location: ' . BASE_URL . '/client_api');
        exit;
    }
}