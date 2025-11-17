<?php
// views/client_api/index.php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../controllers/ClientApiController.php';

$pageTitle = "Clientes API";



require_once view_path('views/layouts/header.php');
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="<?= BASE_URL ?>/hoteles" class="btn btn-secondary btn-sm me-2" title="Volver al inicio">
                <i class="fas fa-arrow-left me-1"></i> Volver
            </a>
            <h2 class="fw-bold text-primary d-inline-block">
                <i class="fas fa-users me-2"></i> Clientes API
            </h2>
        </div>
        <a href="<?= BASE_URL ?>/client_api/create" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Nuevo Cliente
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if ($clientes && count($clientes) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Empresa</th>
                                <th>Teléfono</th>
                                <th>API Key</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clientes as $index => $cliente): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($cliente['nombre']) ?></td>
                                <td><?= htmlspecialchars($cliente['email']) ?></td>
                                <td><?= htmlspecialchars($cliente['empresa'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($cliente['telefono'] ?? 'N/A') ?></td>
                                <td>
                                    <code class="small"><?= substr($cliente['api_key'] ?? '', 0, 10) ?>...</code>
                                </td>
                               <td>
     <!-- Verifica que estés pasando el ID correctamente -->
<a href="<?= BASE_URL ?>/client_api/edit/<?= $cliente['id'] ?>" class="btn btn-sm btn-warning" title="Editar">
    <i class="fas fa-edit"></i>
</a>
    
    <!-- Formulario de eliminar -->
    <form method="POST" action="<?= BASE_URL ?>/client_api/delete" class="d-inline">
        <input type="hidden" name="id" value="<?= $cliente['id'] ?>">
        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este cliente?')">
            <i class="fas fa-trash"></i> Eliminar
        </button>
    </form>
    
    <!-- Debug del enlace -->
    <small class="d-block text-muted mt-1">
        ID: <?= $cliente['id'] ?>
    </small>
</td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-4">
                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No hay clientes API registrados</p>
                    <a href="<?= BASE_URL ?>/client_api/create" class="btn btn-primary me-2">
                        <i class="fas fa-plus-circle"></i> Crear Primer Cliente
                    </a>
                    <a href="<?= BASE_URL ?>/hoteles" class="btn btn-secondary">
                        <i class="fas fa-home me-1"></i> Volver al Inicio
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>

<?php require_once view_path('views/layouts/footer.php'); ?>