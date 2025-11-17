<?php
$pageTitle = 'Editar Cliente API';

if (!isset($cliente)) {
    header('Location: ' . BASE_URL . '/client_api');
    exit;
}
?>

<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid">
    <div class="mb-3">
        <a href="<?= BASE_URL ?>/client_api" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i> Editar Cliente API: <?= htmlspecialchars($cliente['nombre']) ?>
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= BASE_URL ?>/client_api/update/<?= $cliente['id'] ?>">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre *</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" 
                                   value="<?= htmlspecialchars($cliente['nombre']) ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?= htmlspecialchars($cliente['email']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="empresa" class="form-label">Empresa</label>
                            <input type="text" class="form-control" id="empresa" name="empresa" 
                                   value="<?= htmlspecialchars($cliente['empresa'] ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" 
                                   value="<?= htmlspecialchars($cliente['telefono'] ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?= htmlspecialchars($cliente['descripcion'] ?? '') ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save me-2"></i> Actualizar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>