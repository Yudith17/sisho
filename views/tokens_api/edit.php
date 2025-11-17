<?php
$pageTitle = 'Editar Token API';

if (!isset($token) || !isset($clientes)) {
    header('Location: ' . BASE_URL . '/tokens_api/list');
    exit;
}
?>

<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container-fluid">
    <div class="mb-3">
        <a href="<?= BASE_URL ?>/tokens_api/list" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Volver a Tokens
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-edit me-2"></i> Editar Token API
                        </h4>
                        <span class="badge bg-dark">ID: <?= $token['id'] ?></span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="<?= BASE_URL ?>/tokens_api/update/<?= $token['id'] ?>">
                        <div class="mb-3">
                            <label for="cliente_id" class="form-label">Cliente API *</label>
                            <select class="form-select" id="cliente_id" name="cliente_id" required>
                                <option value="">Seleccionar Cliente API</option>
                                <?php foreach($clientes as $cliente): ?>
                                    <option value="<?= $cliente['id'] ?>" 
                                        <?= $token['cliente_id'] == $cliente['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($cliente['nombre']) ?> 
                                        (<?= htmlspecialchars($cliente['email']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" 
                                      rows="3" placeholder="Descripción opcional del token..."><?= htmlspecialchars($token['descripcion'] ?? '') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="expiracion" class="form-label">Fecha de Expiración (Opcional)</label>
                            <input type="datetime-local" class="form-control" id="expiracion" name="expiracion" 
                                   value="<?= $token['expiracion'] ? date('Y-m-d\TH:i', strtotime($token['expiracion'])) : '' ?>">
                            <div class="form-text">Dejar vacío si no expira</div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="activo" name="activo" 
                                   value="1" <?= $token['activo'] ? 'checked' : '' ?>>
                            <label class="form-check-label" for="activo">Token Activo</label>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Token Actual</label>
                            <div class="input-group">
                                <input type="text" class="form-control" value="<?= htmlspecialchars($token['token']) ?>" readonly>
                                <button type="button" class="btn btn-outline-secondary" onclick="copyToClipboard(this)">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                            <small class="form-text text-muted">Este token no se puede modificar directamente</small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save me-2"></i> Actualizar Token
                            </button>
                            <a href="<?= BASE_URL ?>/tokens_api/list" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i> Cancelar
                            </a>
                            <?php if($token['activo']): ?>
                                <a href="<?= BASE_URL ?>/tokens_api/revoke/<?= $token['id'] ?>" class="btn btn-danger" 
                                   onclick="return confirm('¿Estás seguro de que quieres revocar este token?')">
                                    <i class="fas fa-ban me-2"></i> Revocar
                                </a>
                            <?php endif; ?>
                            <a href="<?= BASE_URL ?>/tokens_api/renew/<?= $token['id'] ?>" class="btn btn-info" 
                               onclick="return confirm('¿Estás seguro de que quieres renovar este token? Se generará uno nuevo.')">
                                <i class="fas fa-sync me-2"></i> Renovar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(button) {
    const input = button.parentElement.querySelector('input');
    input.select();
    document.execCommand('copy');
    
    const originalHtml = button.innerHTML;
    button.innerHTML = '<i class="fas fa-check"></i>';
    button.classList.remove('btn-outline-secondary');
    button.classList.add('btn-success');
    
    setTimeout(() => {
        button.innerHTML = originalHtml;
        button.classList.remove('btn-success');
        button.classList.add('btn-outline-secondary');
    }, 2000);
}
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>