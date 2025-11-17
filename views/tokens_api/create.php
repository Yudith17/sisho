<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/ClientApi.php';

$pageTitle = "Crear Token API";

// Obtener clientes directamente del modelo
$clientApiModel = new ClientApi();
$clientes = $clientApiModel->getAll();

require view_path('views/layouts/header.php');
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="<?= BASE_URL ?>/tokens_api" class="btn btn-secondary btn-sm me-2">
                <i class="fas fa-arrow-left me-1"></i> Volver a Tokens
            </a>
            <h2 class="fw-bold text-success d-inline-block">
                <i class="fas fa-plus-circle me-2"></i> Crear Nuevo Token API
            </h2>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-key me-2"></i> Información del Token
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="<?= BASE_URL ?>/tokens_api/store">
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
                                <label for="expiracion" class="form-label">Fecha Expiración *</label>
                                <input type="datetime-local" class="form-control" id="expiracion" name="expiracion" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Descripción del uso del token..."></textarea>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="activo" name="activo" value="1" checked>
                            <label class="form-check-label" for="activo">Token activo</label>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-2"></i> Generar Token
                            </button>
                            <a href="<?= BASE_URL ?>/tokens_api" class="btn btn-secondary">
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