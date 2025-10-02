<?php
$title = "Registrar Solicitud API - Sistema de Hoteles";
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="main-card">
    <div class="card-header">
        <h2 class="card-title"><i class="fas fa-plus"></i> Registrar Nueva Solicitud API</h2>
    </div>
    <div class="card-body">
        <form method="POST" action="index.php?controller=countrequest&action=create">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="Id_Token">Token *</label>
                    <select id="Id_Token" name="Id_Token" class="form-select" required>
                        <option value="">Seleccionar token</option>
                        <?php foreach ($tokens as $token): ?>
                            <option value="<?= $token['id'] ?>">
                                <?= htmlspecialchars($token['razon_social']) ?> - 
                                <?= substr($token['Token'], 0, 20) ?>...
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="form-help">Seleccione el token que realizó la solicitud</span>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="Tipo">Tipo de Solicitud *</label>
                    <select id="Tipo" name="Tipo" class="form-select" required>
                        <option value="">Seleccionar tipo</option>
                        <option value="GET /hotels">GET /hotels - Listar hoteles</option>
                        <option value="GET /hotels/{id}">GET /hotels/{id} - Ver hotel</option>
                        <option value="POST /reservations">POST /reservations - Crear reserva</option>
                        <option value="PUT /reservations/{id}">PUT /reservations/{id} - Actualizar reserva</option>
                        <option value="DELETE /reservations/{id}">DELETE /reservations/{id} - Eliminar reserva</option>
                        <option value="GET /availability">GET /availability - Disponibilidad</option>
                        <option value="POST /auth">POST /auth - Autenticación</option>
                        <option value="GET /stats">GET /stats - Estadísticas</option>
                    </select>
                    <span class="form-help">Tipo de endpoint solicitado</span>
                </div>
            </div>

            <div class="form-group">
                <div style="background: #f0fdf4; border: 1px solid #dcfce7; border-radius: var(--radius); padding: 15px; margin-bottom: 20px;">
                    <h4 style="color: #065f46; margin-bottom: 10px;"><i class="fas fa-info-circle"></i> Información</h4>
                    <p style="color: #047857; margin: 0;">
                        La fecha y hora se registrarán automáticamente al momento de guardar.
                    </p>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Registrar Solicitud
                </button>
                <a href="index.php?controller=countrequest&action=index" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        const token = document.getElementById('Id_Token').value;
        const tipo = document.getElementById('Tipo').value;
        
        if (!token) {
            e.preventDefault();
            alert('Por favor seleccione un token');
            return;
        }
        
        if (!tipo) {
            e.preventDefault();
            alert('Por favor seleccione el tipo de solicitud');
            return;
        }
    });
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>