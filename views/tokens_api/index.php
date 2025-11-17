<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/TokenApi.php'; // Incluir modelo directamente

$pageTitle = "Tokens API";

// Obtener datos directamente del modelo
$tokenApiModel = new TokenApi();
$tokens = $tokenApiModel->getAllWithClient();

require view_path('views/layouts/header.php');
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="<?= BASE_URL ?>/hoteles" class="btn btn-secondary btn-sm me-2" title="Volver al inicio">
                <i class="fas fa-arrow-left me-1"></i> Volver
            </a>
            <h2 class="fw-bold text-success d-inline-block">
                <i class="fas fa-key me-2"></i> Tokens API
            </h2>
        </div>
        <a href="<?= BASE_URL ?>/tokens_api/create" class="btn btn-success">
            <i class="fas fa-plus-circle"></i> Nuevo Token
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if ($tokens && count($tokens) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cliente</th>
                                <th>Token</th>
                                <th>Expiración</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tokens as $index => $token): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($token['cliente_nombre']) ?></td>
                                <td>
                                    <code class="small"><?= substr($token['token'], 0, 20) ?>...</code>
                                </td>
                                <td><?= date('d/m/Y H:i', strtotime($token['expiracion'])) ?></td>
                                <td>
                                    <span class="badge <?= $token['activo'] ? 'bg-success' : 'bg-secondary' ?>">
                                        <?= $token['activo'] ? 'Activo' : 'Inactivo' ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?= BASE_URL ?>/tokens_api/edit/<?= $token['id'] ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form method="POST" action="<?= BASE_URL ?>/tokens_api/delete" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $token['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este token?')">
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
                    <i class="fas fa-key fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No hay tokens API registrados</p>
                    <a href="<?= BASE_URL ?>/tokens_api/create" class="btn btn-success me-2">
                        <i class="fas fa-plus-circle"></i> Crear Primer Token
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