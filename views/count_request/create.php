<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/ClientApi.php';

$pageTitle = "Crear Registro de Estadísticas";

// Obtener clientes directamente del modelo
$clientApiModel = new ClientApi();
$clientes = $clientApiModel->getAll();

require view_path('views/layouts/header.php');
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="<?= BASE_URL ?>/count_request" class="btn btn-secondary btn-sm me-2">
                <i class="fas fa-arrow-left me-1"></i> Volver a Estadísticas
            </a>
            <h2 class="fw-bold text-info d-inline-block">
                <i class="fas fa-plus-circle me-2"></i> Crear Nuevo Registro
            </h2>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-chart-bar me-2"></i> Estadísticas de Solicitudes
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="<?= BASE_URL ?>/count_request/store">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cliente_id" class="form-label">Cliente *</label>
                                <select class="form-control" id="cliente_id" name="cliente_id" required>
                                    <option value="">Seleccionar cliente...</option>
                                    <?php foreach ($clientes as $cliente): ?>
                                        <option value="<?= $cliente['id'] ?>">
                                            <?= htmlspecialchars($cliente['nombre']) ?> - <?= htmlspecialchars($cliente['email']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fecha" class="form-label">Fecha *</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" 
                                       value="<?= date('Y-m-d') ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="total_solicitudes" class="form-label">Total Solicitudes *</label>
                                <input type="number" class="form-control" id="total_solicitudes" name="total_solicitudes" 
                                       min="0" value="0" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="solicitudes_exitosas" class="form-label">Solicitudes Exitosas *</label>
                                <input type="number" class="form-control" id="solicitudes_exitosas" name="solicitudes_exitosas" 
                                       min="0" value="0" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="solicitudes_fallidas" class="form-label">Solicitudes Fallidas *</label>
                                <input type="number" class="form-control" id="solicitudes_fallidas" name="solicitudes_fallidas" 
                                       min="0" value="0" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="observaciones" class="form-label">Observaciones</label>
                            <textarea class="form-control" id="observaciones" name="observaciones" rows="3" placeholder="Observaciones adicionales..."></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-info">
                                <i class="fas fa-save me-2"></i> Guardar Registro
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