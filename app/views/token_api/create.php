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

        <!-- Alerta especial cuando se genera un token -->
        <?php if (isset($_SESSION['token_generado']) && isset($_SESSION['token_cliente_nombre'])): ?>
            <div class="token-alert-success">
                <div class="token-alert-header">
                    <h3><i class="fas fa-shield-check"></i> ¡Token Generado Exitosamente!</h3>
                    <button type="button" class="alert-close" onclick="closeTokenAlert()">✕</button>
                </div>
                <div class="token-alert-body">
                    <div class="token-info">
                        <p><strong>Cliente:</strong> <?= htmlspecialchars($_SESSION['token_cliente_nombre']) ?></p>
                        <p><strong>Token Generado:</strong></p>
                        <div class="token-value-container">
                            <code class="token-value" id="tokenValue"><?= htmlspecialchars($_SESSION['token_generado']) ?></code>
                            <button type="button" class="btn-copy-token" onclick="copyToken()" title="Copiar token">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                    <div class="token-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>¡Importante!</strong> Este token solo se mostrará una vez. Guárdelo en un lugar seguro.
                    </div>
                </div>
                <div class="token-alert-actions">
                    <button type="button" class="btn btn-outline" onclick="closeTokenAlert()">Continuar</button>
                    <a href="index.php?controller=tokenapi&action=index" class="btn btn-primary">
                        <i class="fas fa-list"></i> Ver Todos los Tokens
                    </a>
                </div>
            </div>
            <?php 
            // Limpiar la sesión después de mostrar
            unset($_SESSION['token_generado']);
            unset($_SESSION['token_cliente_nombre']);
            ?>
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

            <!-- Información de seguridad mejorada -->
            <div class="form-group">
                <div class="security-info-card">
                    <h4><i class="fas fa-lock"></i> Seguridad del Token</h4>
                    <div class="security-features">
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <div>
                                <strong>Token Único</strong>
                                <span>Generado automáticamente para cada cliente</span>
                            </div>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <div>
                                <strong>Encriptación Segura</strong>
                                <span>Almacenado de forma encriptada en la base de datos</span>
                            </div>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <div>
                                <strong>Visualización Única</strong>
                                <span>El token completo solo se muestra una vez</span>
                            </div>
                        </div>
                    </div>
                    <div class="token-format-info">
                        <p><strong>Formato del token:</strong> <code>cli_[ID]_[token_aleatorio_64_caracteres]</code></p>
                    </div>
                </div>
            </div>

            <!-- Información del proceso -->
            <div class="form-group">
                <div class="process-info">
                    <h5><i class="fas fa-info-circle"></i> Proceso de Generación</h5>
                    <ol>
                        <li>Seleccione un cliente API activo</li>
                        <li>Se generará un token único y seguro</li>
                        <li>El token se almacenará encriptado en la base de datos</li>
                        <li>Se mostrará el token completo una sola vez para que lo guarde</li>
                    </ol>
                </div>
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
            showAlert('❌ Por favor seleccione un cliente API', 'error');
            clienteSelect.focus();
            return;
        }

        // Confirmación antes de generar
        const confirmacion = confirm('¿Está seguro de generar un nuevo token para este cliente?\n\n⚠️ El token se mostrará una sola vez. Asegúrese de guardarlo en un lugar seguro.');
        if (!confirmacion) {
            e.preventDefault();
        }
    });

    // Cerrar alerta de token generado
    function closeTokenAlert() {
        const tokenAlert = document.querySelector('.token-alert-success');
        if (tokenAlert) {
            tokenAlert.style.display = 'none';
        }
    }

    // Copiar token al portapapeles
    function copyToken() {
        const tokenText = document.getElementById('tokenValue').textContent;
        navigator.clipboard.writeText(tokenText).then(function() {
            showAlert('✅ Token copiado al portapapeles', 'success');
        }).catch(function() {
            // Fallback para navegadores antiguos
            const textArea = document.createElement('textarea');
            textArea.value = tokenText;
            document.body.appendChild(textArea);
            textArea.select();
            try {
                document.execCommand('copy');
                showAlert('✅ Token copiado al portapapeles', 'success');
            } catch (err) {
                showAlert('❌ Error al copiar el token', 'error');
            }
            document.body.removeChild(textArea);
        });
    }

    // Función para mostrar alertas temporales
    function showAlert(message, type) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-temporary`;
        alertDiv.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
            ${message}
        `;
        
        document.querySelector('.card-body').insertBefore(alertDiv, document.querySelector('form'));
        
        setTimeout(() => {
            alertDiv.remove();
        }, 3000);
    }

    // Auto-cerrar alerta del token después de 2 minutos por seguridad
    setTimeout(function() {
        closeTokenAlert();
    }, 120000);
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

    .alert-temporary {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
        max-width: 300px;
        box-shadow: var(--shadow-lg);
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

    /* Estilos para la alerta de token generado */
    .token-alert-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border-radius: var(--radius);
        margin-bottom: 25px;
        box-shadow: var(--shadow-lg);
        border-left: 4px solid #047857;
    }

    .token-alert-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 20px 0 20px;
    }

    .token-alert-header h3 {
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert-close {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        transition: var(--transition);
    }

    .alert-close:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    .token-alert-body {
        padding: 20px;
    }

    .token-info {
        background: rgba(255, 255, 255, 0.15);
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 15px;
    }

    .token-value-container {
        position: relative;
        margin: 10px 0;
    }

    .token-value {
        background: rgba(0, 0, 0, 0.2);
        padding: 12px;
        border-radius: 4px;
        font-family: 'Courier New', monospace;
        font-size: 14px;
        word-break: break-all;
        color: white;
        display: block;
        border: 1px dashed rgba(255, 255, 255, 0.3);
    }

    .btn-copy-token {
        position: absolute;
        top: 8px;
        right: 8px;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: none;
        padding: 6px 10px;
        border-radius: 4px;
        cursor: pointer;
        transition: var(--transition);
    }

    .btn-copy-token:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    .token-warning {
        background: rgba(255, 255, 255, 0.1);
        padding: 12px 15px;
        border-radius: 4px;
        border-left: 3px solid #fbbf24;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
    }

    .token-alert-actions {
        padding: 0 20px 20px 20px;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-outline {
        background: transparent;
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.5);
        padding: 8px 16px;
        border-radius: 4px;
        text-decoration: none;
        cursor: pointer;
        transition: var(--transition);
    }

    .btn-outline:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    /* Estilos para la información de seguridad */
    .security-info-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: var(--radius);
        padding: 20px;
    }

    .security-info-card h4 {
        color: #1e293b;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .security-features {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-bottom: 15px;
    }

    .feature-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .feature-item i {
        color: #10b981;
        margin-top: 2px;
        flex-shrink: 0;
    }

    .feature-item div {
        display: flex;
        flex-direction: column;
    }

    .feature-item strong {
        color: #1e293b;
        font-size: 14px;
    }

    .feature-item span {
        color: #64748b;
        font-size: 12px;
    }

    .token-format-info {
        background: #f1f5f9;
        padding: 12px;
        border-radius: 4px;
        border-left: 3px solid #3b82f6;
    }

    .token-format-info p {
        margin: 0;
        color: #475569;
    }

    /* Estilos para la información del proceso */
    .process-info {
        background: #fffbeb;
        border: 1px solid #fef3c7;
        border-radius: var(--radius);
        padding: 20px;
    }

    .process-info h5 {
        color: #92400e;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .process-info ol {
        color: #92400e;
        margin-left: 20px;
    }

    .process-info li {
        margin-bottom: 8px;
        line-height: 1.4;
    }

    @media (max-width: 768px) {
        .token-alert-header {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .token-alert-actions {
            flex-direction: column;
        }

        .token-alert-actions .btn {
            width: 100%;
            justify-content: center;
        }

        .security-features {
            gap: 15px;
        }

        .feature-item {
            align-items: flex-start;
        }
    }
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>