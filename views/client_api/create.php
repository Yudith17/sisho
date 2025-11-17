<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../controllers/ClientApiController.php';

$pageTitle = "Crear Cliente API";

$controller = new ClientApiController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $controller->store($_POST);
    if ($result) {
        header('Location: ' . BASE_URL . '/client_api');
        exit;
    }
}

require view_path('views/layouts/header.php');
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i> Crear Nuevo Cliente API
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label">Nombre *</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="empresa" class="form-label">Empresa</label>
                                <input type="text" class="form-control" id="empresa" name="empresa">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i> Guardar Cliente
                            </button>
                            <a href="<?= BASE_URL ?>/client_api" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="<?= BASE_URL ?>/client_api" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i> Volver a Clientes
    </a>
</div>

<?php require view_path('views/layouts/footer.php'); ?>