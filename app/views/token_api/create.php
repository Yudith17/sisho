<?php
$title = "Generar Token - Sistema de Hoteles";
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="main-card">
    <div class="card-header">
        <h2 class="card-title"><i class="fas fa-key"></i> Generar Nuevo Token</h2>
    </div>
    <div class="card-body">
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
                                if (isset($client['estado']) && $client['estado'] == 'activo'): 
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

            <div class="form-group">
                <div style="background: #f0fdf4; border: 1px solid #dcfce7; border-radius: var(--radius); padding: 15px; margin-bottom: 20px;">
                    <h4 style="color: #065f46; margin-bottom: 10px;"><i class="fas fa-info-circle"></i> Información del Token</h4>
                    <p style="color: #047857; margin: 0;">
                        Al guardar, se generará automáticamente un token seguro de 64 caracteres.
                        El token será único y se utilizará para autenticar las solicitudes API.
                    </p>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-key"></i> Generar Token
                </button>
                <a href="index.php?controller=tokenapi&action=index" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    // Validación del formulario
    document.querySelector('form').addEventListener('submit', function(e) {
        const cliente = document.getElementById('id_cliente_api').value;
        
        if (!cliente) {
            e.preventDefault();
            alert('Por favor seleccione un cliente API');
            return;
        }
    });
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>