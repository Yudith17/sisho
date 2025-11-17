<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/CountRequest.php';
require_once __DIR__ . '/../../models/ClientApi.php';

$pageTitle = "Editar Registro de Estadísticas";

// Usar modelos directamente
$countRequestModel = new CountRequest();
$clientApiModel = new ClientApi();

$id = $_GET['id'] ?? 0;
$registro = $countRequestModel->getById($id);
$clientes = $clientApiModel->getAll();

if (!$registro) {
    header('Location: ' . BASE_URL . '/count_request');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $countRequestModel->update($id, [
        'cliente_id' => $_POST['cliente_id'],
        'fecha' => $_POST['fecha'],
        'total_solicitudes' => $_POST['total_solicitudes'],
        'solicitudes_exitosas' => $_POST['solicitudes_exitosas'],
        'solicitudes_fallidas' => $_POST['solicitudes_fallidas'],
        'observaciones' => $_POST['observaciones'] ?? ''
    ]);

    if ($result) {
        $_SESSION['success'] = 'Registro actualizado exitosamente';
        header('Location: ' . BASE_URL . '/count_request');
        exit;
    } else {
        $_SESSION['error'] = 'Error al actualizar el registro';
    }
}

require view_path('views/layouts/header.php');
?>

<!-- Tu HTML del formulario de edición aquí -->
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="<?= BASE_URL ?>/count_request" class="btn btn-secondary btn-sm me-2">
                <i class="fas fa-arrow-left me-1"></i> Volver a Estadísticas
            </a>
            <h2 class="fw-bold text-warning d-inline-block">
                <i class="fas fa-edit me-2"></i> Editar Registro
            </h2>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i> Editar Registro de Estadísticas
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cliente_id" class="form-label">Cliente *</label>
                                <select class="form-control" id="cliente_id" name="cliente_id" required>
                                    <option value="">Seleccionar cliente...</option>
                                    <?php foreach ($clientes as $cliente): ?>
                                        <option value="<?= $cliente['id'] ?>" <?= $cliente['id'] == $registro['cliente_id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($cliente['nombre']) ?> - <?= htmlspecialchars($cliente['email']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fecha" class="form-label">Fecha *</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" 
                                       value="<?= date('Y-m-d', strtotime($registro['fecha'])) ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="total_solicitudes" class="form-label">Total Solicitudes *</label>
                                <input type="number" class="form-control" id="total_solicitudes" name="total_solicitudes" 
                                       min="0" value="<?= $registro['total_solicitudes'] ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="solicitudes_exitosas" class="form-label">Solicitudes Exitosas *</label>
                                <input type="number" class="form-control" id="solicitudes_exitosas" name="solicitudes_exitosas" 
                                       min="0" value="<?= $registro['solicitudes_exitosas'] ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="solicitudes_fallidas" class="form-label">Solicitudes Fallidas *</label>
                                <input type="number" class="form-control" id="solicitudes_fallidas" name="solicitudes_fallidas" 
                                       min="0" value="<?= $registro['solicitudes_fallidas'] ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="observaciones" class="form-label">Observaciones</label>
                            <textarea class="form-control" id="observaciones" name="observaciones" rows="3"><?= htmlspecialchars($registro['observaciones'] ?? '') ?></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save me-2"></i> Actualizar Registro
                            </button>
                            <a href="<?= BASE_URL ?>/count_request" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require view_path('views/layouts/footer.php'); ?>