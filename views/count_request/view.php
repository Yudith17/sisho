<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle = "Detalle de Estadísticas";
require view_path('views/layouts/header.php');
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="<?= BASE_URL ?>/count_request" class="btn btn-secondary btn-sm me-2">
                <i class="fas fa-arrow-left me-1"></i> Volver a Estadísticas
            </a>
            <h2 class="fw-bold text-info d-inline-block">
                <i class="fas fa-chart-bar me-2"></i> Detalle de Estadísticas
            </h2>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Información del Registro</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>ID del Registro:</strong> <?= $registro['id'] ?></p>
                    <p><strong>Cliente:</strong> <?= htmlspecialchars($registro['cliente_nombre'] ?? 'Cliente no encontrado') ?></p>
                    <p><strong>Fecha:</strong> <?= date('d/m/Y', strtotime($registro['fecha'])) ?></p>
                    <p><strong>Total Solicitudes:</strong> <span class="badge bg-primary"><?= $registro['total_solicitudes'] ?></span></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Solicitudes Exitosas:</strong> <span class="badge bg-success"><?= $registro['solicitudes_exitosas'] ?></span></p>
                    <p><strong>Solicitudes Fallidas:</strong> <span class="badge bg-danger"><?= $registro['solicitudes_fallidas'] ?></span></p>
                    <?php
                    $porcentajeExito = ($registro['solicitudes_exitosas'] / max(1, $registro['total_solicitudes']) * 100);
                    $badgeClass = $porcentajeExito >= 80 ? 'bg-success' : ($porcentajeExito >= 60 ? 'bg-warning' : 'bg-danger');
                    ?>
                    <p><strong>Porcentaje de Éxito:</strong> 
                        <span class="badge <?= $badgeClass ?>">
                            <?= number_format($porcentajeExito, 2) ?>%
                        </span>
                    </p>
                    <p><strong>Creado:</strong> <?= date('d/m/Y H:i', strtotime($registro['created_at'])) ?></p>
                </div>
            </div>
            
            <?php if (!empty($registro['observaciones'])): ?>
            <div class="mt-4">
                <strong>Observaciones:</strong>
                <div class="mt-2 p-3 bg-light rounded">
                    <?= nl2br(htmlspecialchars($registro['observaciones'])) ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="mt-4 d-flex gap-2">
                <a href="<?= BASE_URL ?>/count_request/edit/<?= $registro['id'] ?>" class="btn btn-warning">
                    <i class="fas fa-edit me-2"></i> Editar Registro
                </a>
                <a href="<?= BASE_URL ?>/count_request" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Volver a la lista
                </a>
            </div>
        </div>
    </div>
</div>

<?php require view_path('views/layouts/footer.php'); ?>