<?php
$title = "Editar Cliente API - Sistema de Hoteles";
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="main-card">
    <div class="card-header">
        <h2 class="card-title"><i class="fas fa-edit"></i> Editar Cliente API</h2>
    </div>
    <div class="card-body">
        <form method="POST" action="index.php?controller=clientapi&action=edit&id=<?= $client['id'] ?>">
            <input type="hidden" name="id" value="<?= $client['id'] ?>">
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="ruc">RUC *</label>
                    <input type="text" id="ruc" name="ruc" class="form-input" 
                           value="<?= htmlspecialchars($client['ruc']) ?>" 
                           placeholder="Ingrese el RUC (11 dígitos)" required maxlength="11"
                           pattern="[0-9]{11}" title="El RUC debe tener 11 dígitos">
                    <span class="form-help">11 dígitos numéricos</span>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="correo">Correo Electrónico *</label>
                    <input type="email" id="correo" name="correo" class="form-input" 
                           value="<?= htmlspecialchars($client['correo']) ?>"
                           placeholder="correo@empresa.com" required>
                    <span class="form-help">Correo electrónico válido</span>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="razon_social">Razón Social *</label>
                <input type="text" id="razon_social" name="razon_social" class="form-input" 
                       value="<?= htmlspecialchars($client['razon_social']) ?>"
                       placeholder="Ingrese la razón social completa" required>
                <span class="form-help">Nombre legal de la empresa</span>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="telefono">Teléfono</label>
                    <input type="text" id="telefono" name="telefono" class="form-input" 
                           value="<?= htmlspecialchars($client['telefono'] ?? '') ?>"
                           placeholder="Ej: +51 123 456 789">
                    <span class="form-help">Opcional</span>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="estado">Estado *</label>
                    <select id="estado" name="estado" class="form-select" required>
                        <option value="activo" <?= $client['estado'] == 'activo' ? 'selected' : '' ?>>Activo</option>
                        <option value="inactivo" <?= $client['estado'] == 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                    <span class="form-help">Estado del cliente API</span>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Actualizar Cliente
                </button>
                <a href="index.php?controller=clientapi&action=index" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    // Validación del RUC
    document.getElementById('ruc').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // Validación del formulario
    document.querySelector('form').addEventListener('submit', function(e) {
        const ruc = document.getElementById('ruc').value;
        const correo = document.getElementById('correo').value;
        
        if (ruc.length !== 11) {
            e.preventDefault();
            alert('El RUC debe tener exactamente 11 dígitos');
            return;
        }
        
        if (!correo.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
            e.preventDefault();
            alert('Por favor ingrese un correo electrónico válido');
            return;
        }
    });
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>