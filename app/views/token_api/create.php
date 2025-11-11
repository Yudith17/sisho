<?php
$title = "Generar Token - Sistema de Hoteles";
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="main-card">
    <div class="card-header">
        <h2 class="card-title"><i class="fas fa-key"></i> Generar Nuevo Token</h2>
    </div>
    <div class="card-body">
        <!-- Mostrar mensajes de éxito/error -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> 
                <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> 
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="index.php?controller=tokenapi&action=create">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="id_cliente_api">Cliente API *</label>
                    <select id="id_cliente_api" name="id_cliente_api" class="form-select" required>
                        <option value="">Seleccionar cliente</option>
                        <?php 
                        // Verificar si $clients está definido y no está vacío
                        if (isset($clients) && !empty($clients)): 
                            foreach ($clients as $client): 
                                // Verificar que el cliente tenga los campos necesarios
                                $estado = $client['estado'] ?? $client['Estado'] ?? '';
                                $esActivo = ($estado == 'activo' || $estado == 'Active' || ($client['Estado'] ?? 0) == 1);
                                
                                if ($esActivo): 
                        ?>
                                    <option value="<?= $client['id'] ?>">
                                        <?= htmlspecialchars($client['razon_social'] ?? $client['nombre'] ?? 'Cliente') ?> 
                                        (<?= $client['ruc'] ?? $client['codigo'] ?? 'N/A' ?>)
                                    </option>
                        <?php 
                                endif;
                            endforeach;
                        else: 
                        ?>
                            <option value="" disabled>No hay clientes disponibles</option>
                        <?php endif; ?>
                    </select>
                    <span class="form-help">Seleccione un cliente API activo</span>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="estado">Estado *</label>
                    <select id="estado" name="estado" class="form-select" required>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                    <span class="form-help">Estado del token</span>
                </div>
            </div>

            <!-- Información mejorada del token -->
            <div class="form-group">
                <div style="background: #f0f9ff; border: 1px solid #bae6fd; border-radius: var(--radius); padding: 20px; margin-bottom: 20px;">
                    <h4 style="color: #0369a1; margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-shield-alt"></i> Información del Token
                    </h4>
                    <div style="color: #075985;">
                        <p style="margin-bottom: 10px;"><strong>Formato del token:</strong></p>
                        <ul style="margin-left: 20px; margin-bottom: 15px;">
                            <li>Prefijo: <code>cli_[ID]_</code> (identificación del cliente)</li>
                            <li>Token seguro: 64 caracteres hexadecimales</li>
                            <li>Ejemplo: <code>cli_15_a1b2c3d4e5f6...</code></li>
                        </ul>
                        <p style="margin: 0; font-style: italic;">
                            El token se generará automáticamente al guardar y será único para cada cliente.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Vista previa del token (opcional) -->
            <div class="form-group" id="token-preview" style="display: none;">
                <label class="form-label">Vista previa del token:</label>
                <div style="background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: var(--radius); padding: 15px; font-family: 'Courier New', monospace; font-size: 14px; color: #475569;">
                    <span id="preview-text">Se generará al seleccionar un cliente...</span>
                </div>
                <span class="form-help">Esta es una vista previa. El token final puede variar.</span>
            </div>

            <div class="form-group" style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
                <button type="submit" class="btn btn-success" style="display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-key"></i> Generar Token
                </button>
                <a href="index.php?controller=tokenapi&action=index" class="btn btn-secondary" style="display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-arrow-left"></i> Volver al Listado
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    // Validación mejorada del formulario
    document.querySelector('form').addEventListener('submit', function(e) {
        const clienteSelect = document.getElementById('id_cliente_api');
        const clienteValue = clienteSelect.value;
        
        if (!clienteValue) {
            e.preventDefault();
            alert('❌ Por favor seleccione un cliente API');
            clienteSelect.focus();
            return;
        }

        // Confirmación antes de generar
        const confirmacion = confirm('¿Está seguro de generar un nuevo token para este cliente?');
        if (!confirmacion) {
            e.preventDefault();
        }
    });

    // Vista previa del token (opcional)
    document.getElementById('id_cliente_api').addEventListener('change', function() {
        const clienteId = this.value;
        const previewDiv = document.getElementById('token-preview');
        const previewText = document.getElementById('preview-text');
        
        if (clienteId) {
            // Mostrar formato esperado del token
            previewText.textContent = `cli_${clienteId}_[token_secreto_generado]`;
            previewDiv.style.display = 'block';
        } else {
            previewDiv.style.display = 'none';
        }
    });

    // Mostrar/ocultar información adicional
    document.addEventListener('DOMContentLoaded', function() {
        const helpButtons = document.querySelectorAll('.help-trigger');
        helpButtons.forEach(button => {
            button.addEventListener('click', function() {
                const helpText = this.nextElementSibling;
                helpText.style.display = helpText.style.display === 'none' ? 'block' : 'none';
            });
        });
    });
</script>

<style>
    .alert {
        padding: 12px 16px;
        border-radius: var(--radius);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert-success {
        background: #f0fdf4;
        color: #065f46;
        border: 1px solid #bbf7d0;
    }

    .alert-error {
        background: #fef2f2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    .form-help {
        display: block;
        font-size: 12px;
        color: #6b7280;
        margin-top: 5px;
    }

    code {
        background: #f3f4f6;
        padding: 2px 6px;
        border-radius: 4px;
        font-family: 'Courier New', monospace;
        color: #dc2626;
    }
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>