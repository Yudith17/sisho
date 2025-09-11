<?php
require_once __DIR__ . '/../models/Hotel.php';

class HotelController {
    private $hotelModel;

    public function __construct() {
        $this->hotelModel = new Hotel(Database::getInstance()); // ya obtiene PDO internamente
    }

    public function index() {
        $hotels = $this->hotelModel->getAll();
        require __DIR__ . '/../views/hotel/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->hotelModel->create(
                $_POST['name'],
                $_POST['category'],
                $_POST['description'],
                $_POST['address'],
                $_POST['district'],
                $_POST['province'],
                $_POST['department'],
                $_POST['phone'],
                $_POST['email'],
                $_POST['website']
            );
            header("Location: index.php?controller=hotel&action=index");
            exit;
        }
        require __DIR__ . '/../views/hotel/create.php';
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) die("ID no especificado.");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->hotelModel->update(
                $id,
                $_POST['name'],
                $_POST['category'],
                $_POST['description'],
                $_POST['address'],
                $_POST['district'],
                $_POST['province'],
                $_POST['department'],
                $_POST['phone'],
                $_POST['email'],
                $_POST['website']
            );
            header("Location: index.php?controller=hotel&action=index");
            exit;
        } else {
            $hotel = $this->hotelModel->find($id);
            require __DIR__ . '/../views/hotel/edit.php';
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->hotelModel->delete($id);
            header("Location: index.php?controller=hotel&action=index");
            exit;
        }
    }

    public function view() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $hotel = $this->hotelModel->find($id);
            require __DIR__ . '/../views/hotel/view.php';
        }
    }
}
