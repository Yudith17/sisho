<?php
// controllers/HotelController.php
require_once __DIR__ . '/../models/Hotel.php';

class HotelController {
    private $hotelModel;

    public function __construct() {
        $this->hotelModel = new Hotel();
    }

    // 🔹 Verificar autenticación
    private function checkAuth() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    // 🔹 Listar hoteles
    public function index() {
        $this->checkAuth();
        
        $limit = $_GET['limit'] ?? 20;
        $offset = $_GET['offset'] ?? 0;
        $search = $_GET['search'] ?? '';
        
        $hoteles = $this->hotelModel->getAll($limit, $offset, $search);
        $total = $this->hotelModel->count($search);
        
        require_once view_path('views/hotel/index.php');
    }

    // 🔹 Mostrar formulario de creación
    public function create() {
        $this->checkAuth();
        require_once view_path('views/hotel/create.php');
    }

    // 🔹 Guardar nuevo hotel
    public function store() {
        $this->checkAuth();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'] ?? '',
                'categoria' => $_POST['categoria'] ?? 3,
                'descripcion' => $_POST['descripcion'] ?? '',
                'direccion' => $_POST['direccion'] ?? '',
                'distrito' => $_POST['distrito'] ?? 'HUANTA',
                'provincia' => $_POST['provincia'] ?? 'HUANTA',
                'telefono' => $_POST['telefono'] ?? '',
                'email' => $_POST['email'] ?? ''
            ];

            if ($this->hotelModel->create($data)) {
                $_SESSION['success'] = 'Hotel creado exitosamente';
                header('Location: ' . BASE_URL . '/hoteles');
                exit;
            } else {
                $_SESSION['error'] = 'Error al crear el hotel';
                header('Location: ' . BASE_URL . '/hoteles/create');
                exit;
            }
        } else {
            header('Location: ' . BASE_URL . '/hoteles');
            exit;
        }
    }

    // 🔹 Mostrar hotel
    public function show($id) {
        $this->checkAuth();
        
        $hotel = $this->hotelModel->getById($id);
        if (!$hotel) {
            $_SESSION['error'] = 'Hotel no encontrado';
            header('Location: ' . BASE_URL . '/hoteles');
            exit;
        }
        
        require_once view_path('views/hotel/view.php');
    }

    // 🔹 Mostrar formulario de edición
    public function edit($id) {
        $this->checkAuth();
        
        $hotel = $this->hotelModel->getById($id);
        if (!$hotel) {
            $_SESSION['error'] = 'Hotel no encontrado';
            header('Location: ' . BASE_URL . '/hoteles');
            exit;
        }
        
        require_once view_path('views/hotel/edit.php');
    }

    // 🔹 Actualizar hotel
    public function update($id) {
        $this->checkAuth();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'] ?? '',
                'categoria' => $_POST['categoria'] ?? 3,
                'descripcion' => $_POST['descripcion'] ?? '',
                'direccion' => $_POST['direccion'] ?? '',
                'distrito' => $_POST['distrito'] ?? 'HUANTA',
                'provincia' => $_POST['provincia'] ?? 'HUANTA',
                'telefono' => $_POST['telefono'] ?? '',
                'email' => $_POST['email'] ?? ''
            ];

            if ($this->hotelModel->update($id, $data)) {
                $_SESSION['success'] = 'Hotel actualizado exitosamente';
                header('Location: ' . BASE_URL . '/hoteles');
                exit;
            } else {
                $_SESSION['error'] = 'Error al actualizar el hotel';
                header('Location: ' . BASE_URL . '/hoteles/edit/' . $id);
                exit;
            }
        } else {
            header('Location: ' . BASE_URL . '/hoteles');
            exit;
        }
    }

    // 🔹 Eliminar hotel
    public function delete($id) {
        $this->checkAuth();
        
        if ($this->hotelModel->delete($id)) {
            $_SESSION['success'] = 'Hotel eliminado exitosamente';
        } else {
            $_SESSION['error'] = 'Error al eliminar el hotel';
        }
        
        header('Location: ' . BASE_URL . '/hoteles');
        exit;
    }
}