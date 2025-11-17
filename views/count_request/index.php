<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/CountRequest.php';

$pageTitle = "Estadísticas de Solicitudes";

// Obtener datos directamente del modelo
$countRequestModel = new CountRequest();
$registros = $countRequestModel->getAllWithClient();
$estadisticas = $countRequestModel->getEstadisticas();

require view_path('views/layouts/header.php');
?>

<div class="container-fluid">
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="<?= BASE_URL ?>/hoteles" class="btn btn-secondary btn-sm me-2">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
        <h2 class="fw-bold text-info d-inline-block">
            <i class="fas fa-chart-bar me-2"></i> Estadísticas de Solicitudes
        </h2>
    </div>
    <!-- BOTÓN CORREGIDO: Cambiado de /count_request/create a /count_request/create -->
    <a href="<?= BASE_URL ?>/count_request/create" class="btn btn-info">
        <i class="fas fa-plus-circle"></i> Nuevo Registro
    </a>
</div>

    <!-- Tarjetas de resumen -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Solicitudes</h5>
                    <h2 class="mb-0"><?= $estadisticas['total_solicitudes'] ?? 0 ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <h5 class="card-title">Éxitos</h5>
                    <h2 class="mb-0"><?= $estadisticas['solicitudes_exitosas'] ?? 0 ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-warning text-dark">
                <div class="card-body text-center">
                    <h5 class="card-title">Fallidas</h5>
                    <h2 class="mb-0"><?= $estadisticas['solicitudes_fallidas'] ?? 0 ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-info text-white">
                <div class="card-body text-center">
                    <h5 class="card-title">Promedio/Día</h5>
                    <h2 class="mb-0"><?= round($estadisticas['promedio_dia'] ?? 0, 2) ?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if ($registros && count($registros) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fecha</th>
                                <th>Cliente ID</th>
                                <th>Total</th>
                                <th>Éxitos</th>
                                <th>Fallos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($registros as $index => $registro): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= date('d/m/Y', strtotime($registro['fecha'])) ?></td>
                                <td>
                                    <?= $registro['cliente_id'] ?>
                                    <?php if (isset($registro['cliente_nombre'])): ?>
                                        <br><small class="text-muted"><?= htmlspecialchars($registro['cliente_nombre']) ?></small>
                                    <?php endif; ?>
                                </td>
                                <td><span class="badge bg-primary"><?= $registro['total_solicitudes'] ?></span></td>
                                <td><span class="badge bg-success"><?= $registro['solicitudes_exitosas'] ?></span></td>
                                <td><span class="badge bg-danger"><?= $registro['solicitudes_fallidas'] ?></span></td>
                                <td>
                                    <a href="<?= BASE_URL ?>/count_request/view/<?= $registro['id'] ?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                    <a href="<?= BASE_URL ?>/count_request/edit/<?= $registro['id'] ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form method="POST" action="<?= BASE_URL ?>/count_request/delete" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $registro['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este registro?')">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-4">
    <i class="fas fa-chart-bar fa-3x text-muted mb-3"></i>
    <p class="text-muted">No hay registros de solicitudes</p>
    <!-- BOTÓN CORREGIDO -->
    <a href="<?= BASE_URL ?>/count_request/create" class="btn btn-info me-2">
        <i class="fas fa-plus-circle"></i> Crear Primer Registro
    </a>
    <a href="<?= BASE_URL ?>/hoteles" class="btn btn-secondary">
        <i class="fas fa-home me-1"></i> Volver al Inicio
    </a>
</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require view_path('views/layouts/footer.php'); ?>