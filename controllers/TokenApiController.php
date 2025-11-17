<?php
// controllers/TokenApiController.php
require_once __DIR__ . '/../models/TokenApi.php';
require_once __DIR__ . '/../models/ClientApi.php';

class TokenApiController {
    private $tokenApiModel;
    private $clientApiModel;

    public function __construct() {
        $this->tokenApiModel = new TokenApi();
        $this->clientApiModel = new ClientApi();
    }

    // 🔹 Verificar autenticación
    private function checkAuth() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    // 🔹 Listar tokens API - PARA API (retorna datos)
    public function index() {
        $this->checkAuth();
        return $this->tokenApiModel->getAllWithClient();
    }

    // 🔹 Mostrar vista de listado - PARA WEB (muestra vista)
    public function list() {
        $this->checkAuth();
        $tokens = $this->tokenApiModel->getAllWithClient();
        $clientes = $this->clientApiModel->getAll();
        require_once __DIR__ . '/../views/tokens_api/index.php';
    }

    // 🔹 Mostrar formulario de creación
    public function create() {
        $this->checkAuth();
        $clientes = $this->clientApiModel->getAll();
        require_once __DIR__ . '/../views/tokens_api/create.php';
    }

    // 🔹 Guardar nuevo token API
    public function store() {
        $this->checkAuth();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $result = $this->tokenApiModel->create([
                    'cliente_id' => $_POST['cliente_id'],
                    'expiracion' => $_POST['expiracion'] ?? null,
                    'descripcion' => $_POST['descripcion'] ?? '',
                    'activo' => isset($_POST['activo']) ? 1 : 0
                ]);

                if ($result) {
                    $_SESSION['success'] = 'Token API creado exitosamente';
                } else {
                    $_SESSION['error'] = 'Error al crear el token API';
                }
                
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
            }
        } else {
            $_SESSION['error'] = 'Método no permitido';
        }
        
        header('Location: ' . BASE_URL . '/tokens_api/list');
        exit;
    }

    // 🔹 Mostrar token API para edición
    public function edit($id = null) {
        $this->checkAuth();
        
        try {
            if (empty($id) || !is_numeric($id)) {
                throw new Exception('ID inválido');
            }
            
            $id = (int)$id;
            $token = $this->tokenApiModel->getById($id);
            $clientes = $this->clientApiModel->getAll();
            
            require_once __DIR__ . '/../views/tokens_api/edit.php';
            
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: ' . BASE_URL . '/tokens_api/list');
            exit;
        }
    }

    // 🔹 Actualizar token API
    public function update($id = null) {
        $this->checkAuth();
        
        try {
            if (empty($id) || !is_numeric($id)) {
                throw new Exception('ID inválido');
            }
            
            $id = (int)$id;
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $result = $this->tokenApiModel->update($id, [
                    'cliente_id' => $_POST['cliente_id'],
                    'expiracion' => $_POST['expiracion'] ?? null,
                    'descripcion' => $_POST['descripcion'] ?? '',
                    'activo' => isset($_POST['activo']) ? 1 : 0
                ]);

                if ($result) {
                    $_SESSION['success'] = 'Token API actualizado exitosamente';
                } else {
                    $_SESSION['error'] = 'Error al actualizar el token API';
                }
                
            } else {
                throw new Exception('Método no permitido');
            }
            
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }
        
        header('Location: ' . BASE_URL . '/tokens_api/list');
        exit;
    }

    // 🔹 Eliminar token API
    public function delete($id) {
        $this->checkAuth();
        
        try {
            if ($this->tokenApiModel->delete($id)) {
                $_SESSION['success'] = 'Token API eliminado exitosamente';
            } else {
                $_SESSION['error'] = 'Error al eliminar el token API';
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }
        
        header('Location: ' . BASE_URL . '/tokens_api/list');
        exit;
    }

    // 🔹 Revocar token
    public function revoke($id) {
        $this->checkAuth();
        
        try {
            if ($this->tokenApiModel->revoke($id)) {
                $_SESSION['success'] = 'Token revocado exitosamente';
            } else {
                $_SESSION['error'] = 'Error al revocar el token';
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }
        
        header('Location: ' . BASE_URL . '/tokens_api/list');
        exit;
    }

    // 🔹 Renovar token
    public function renew($id) {
        $this->checkAuth();
        
        try {
            $newToken = $this->tokenApiModel->renew($id);
            if ($newToken) {
                $_SESSION['success'] = 'Token renovado exitosamente';
                $_SESSION['new_token'] = $newToken;
            } else {
                $_SESSION['error'] = 'Error al renovar el token';
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }
        
        header('Location: ' . BASE_URL . '/tokens_api/list');
        exit;
    }
    // 🔹 Obtener token por ID (para uso interno/API)
public function show($id = null) {
    $this->checkAuth();
    
    try {
        if (empty($id) || !is_numeric($id)) {
            throw new Exception('ID inválido');
        }
        
        $id = (int)$id;
        return $this->tokenApiModel->getById($id);
        
    } catch (Exception $e) {
        // Si es llamado internamente, lanzar la excepción
        throw new Exception('Error al obtener token: ' . $e->getMessage());
    }
}
}
?>