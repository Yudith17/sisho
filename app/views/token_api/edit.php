<?php
$title = "Editar Token - Sistema de Hoteles";
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="main-card">
    <div class="card-header">
        <h2 class="card-title"><i class="fas fa-edit"></i> Editar Token</h2>
    </div>
    <div class="card-body">
        <form method="POST" action="index.php?controller=tokenapi&action=edit&id=<?= $token['id'] ?>">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="id_cliente_api">Cliente API *</label>
                    <select id="id_cliente_api" name="id_cliente_api" class="form-select" required>
                        <option value="">Seleccionar cliente</option>
                        <?php foreach ($clients as $client): ?>
                            <?php if ($client['estado'] == 'activo'): ?>
                                <option value="<?= $client['id'] ?>" 
                                    <?= $client['id'] == $token['Id_cliente_Api'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($client['razon_social']) ?> (<?= $client['ruc'] ?>)
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="token">Token *</label>
                    <input type="text" id="token" name="token" class="form-control" 
                           value="<?= htmlspecialchars($token['Token'] ?? '') ?>" 
                           required readonly
                           style="font-family: monospace; background-color: #f8f9fa;">
                    <span class="form-help">El token es de solo lectura. Para generar uno nuevo, elimine este token y cree uno nuevo.</span>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="estado">Estado *</label>
                    <select id="estado" name="estado" class="form-select" required>
                        <option value="1" <?= ($token['Estado'] == 1) ? 'selected' : '' ?>>Activo</option>
                        <option value="0" <?= ($token['Estado'] == 0) ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Actualizar Token
                </button>
                <a href="index.php?controller=tokenapi&action=index" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        const token = document.getElementById('token').value;
        const cliente = document.getElementById('id_cliente_api').value;
        
        if (!token.trim()) {
            e.preventDefault();
            alert('El token no puede estar vacío');
            return;
        }
        
        if (!cliente) {
            e.preventDefault();
            alert('Por favor seleccione un cliente API');
            return;
        }
    });
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>