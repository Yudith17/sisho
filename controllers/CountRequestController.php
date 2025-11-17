<?php
// controllers/CountRequestController.php
require_once __DIR__ . '/../models/CountRequest.php';
require_once __DIR__ . '/../models/ClientApi.php';

class CountRequestController {
    private $countRequestModel;
    private $clientApiModel;

    public function __construct() {
        $this->countRequestModel = new CountRequest();
        $this->clientApiModel = new ClientApi();
    }

    // 🔹 Verificar autenticación
    private function checkAuth() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    // 🔹 Listar estadísticas
    public function index() {
        $this->checkAuth();
        $registros = $this->countRequestModel->getAllWithClient();
        $estadisticas = $this->countRequestModel->getEstadisticas();
        require_once view_path('views/count_request/index.php');
    }

    // 🔹 Mostrar formulario de creación
    public function create() {
        $this->checkAuth();
        $clientes = $this->clientApiModel->getAll();
        require_once view_path('views/count_request/create.php');
    }

    // 🔹 Guardar nuevo registro
    public function store($data) {
        $this->checkAuth();
        
        $result = $this->countRequestModel->create([
            'cliente_id' => $data['cliente_id'],
            'fecha' => $data['fecha'],
            'total_solicitudes' => $data['total_solicitudes'],
            'solicitudes_exitosas' => $data['solicitudes_exitosas'],
            'solicitudes_fallidas' => $data['solicitudes_fallidas'],
            'observaciones' => $data['observaciones'] ?? ''
        ]);

        if ($result) {
            $_SESSION['success'] = 'Registro creado exitosamente';
            header('Location: ' . BASE_URL . '/count_request');
            exit;
        } else {
            $_SESSION['error'] = 'Error al crear el registro';
            header('Location: ' . BASE_URL . '/count_request/create');
            exit;
        }
    }
    // 🔹 MÉTODO VIEW() - VER DETALLE DEL REGISTRO
public function view($id) {
    $this->checkAuth();
    
    $registro = $this->countRequestModel->getByIdWithClient($id);
    if (!$registro) {
        $_SESSION['error'] = 'Registro no encontrado';
        header('Location: ' . BASE_URL . '/count_request');
        exit;
    }
    
    // Pasar los datos a la vista
    $pageTitle = "Detalle de Estadísticas";
    require_once view_path('views/count_request/view.php');
}
// 🔹 MÉTODO EDIT() - MOSTRAR FORMULARIO DE EDICIÓN
public function edit($id) {
    $this->checkAuth();
    
    $registro = $this->countRequestModel->getById($id);
    if (!$registro) {
        $_SESSION['error'] = 'Registro no encontrado';
        header('Location: ' . BASE_URL . '/count_request');
        exit;
    }
    
    $clientes = $this->clientApiModel->getAll();
    require_once view_path('views/count_request/edit.php');
}
// 🔹 MÉTODO UPDATE() - ACTUALIZAR REGISTRO
public function update($id, $data) {
    $this->checkAuth();
    
    $result = $this->countRequestModel->update($id, [
        'cliente_id' => $data['cliente_id'],
        'fecha' => $data['fecha'],
        'total_solicitudes' => $data['total_solicitudes'],
        'solicitudes_exitosas' => $data['solicitudes_exitosas'],
        'solicitudes_fallidas' => $data['solicitudes_fallidas'],
        'observaciones' => $data['observaciones'] ?? ''
    ]);

    if ($result) {
        $_SESSION['success'] = 'Registro actualizado exitosamente';
        header('Location: ' . BASE_URL . '/count_request');
        exit;
    } else {
        $_SESSION['error'] = 'Error al actualizar el registro';
        header('Location: ' . BASE_URL . '/count_request/edit/' . $id);
        exit;
    }
}
}