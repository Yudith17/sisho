<?php
$title = "Búsquedas del Cliente API - Sistema de Hoteles";
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="main-card">
    <div class="card-header">
        <h2 class="card-title"><i class="fas fa-search"></i> Búsquedas del Cliente API</h2>
        <div>
            <a href="index.php?controller=clientapi&action=index" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver a Clientes
            </a>
            <a href="index.php?controller=clientapi&action=view&id=<?= $client['id'] ?>" class="btn btn-info">
                <i class="fas fa-eye"></i> Ver Detalles
            </a>
        </div>
    </div>
    <div class="card-body">
        <!-- Información del Cliente -->
        <div class="info-grid">
            <div class="info-item">
                <label>Cliente:</label>
                <span><?= htmlspecialchars($client['razon_social']) ?></span>
            </div>
            <div class="info-item">
                <label>RUC:</label>
                <span><?= htmlspecialchars($client['ruc']) ?></span>
            </div>
            <div class="info-item">
                <label>Estado:</label>
                <span class="badge <?= $client['estado'] == 'activo' ? 'badge-success' : 'badge-secondary' ?>">
                    <?= ucfirst($client['estado']) ?>
                </span>
            </div>
        </div>

        <!-- Estadísticas de Uso -->
        <h3 class="section-title"><i class="fas fa-chart-bar"></i> Estadísticas de Uso</h3>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-exchange-alt"></i></div>
                <div class="stat-value"><?= $stats['total_requests'] ?? 0 ?></div>
                <div class="stat-label">Total de Requests</div>
            </div>
            <div class="stat-card success">
                <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                <div class="stat-value"><?= $stats['successful_requests'] ?? 0 ?></div>
                <div class="stat-label">Requests Exitosos</div>
            </div>
            <div class="stat-card warning">
                <div class="stat-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <div class="stat-value"><?= $stats['error_requests'] ?? 0 ?></div>
                <div class="stat-label">Requests con Errores</div>
            </div>
            <div class="stat-card info">
                <div class="stat-icon"><i class="fas fa-clock"></i></div>
                <div class="stat-value"><?= number_format($stats['avg_response_time'] ?? 0, 2) ?>s</div>
                <div class="stat-label">Tiempo Promedio</div>
            </div>
        </div>

        <!-- Historial de Requests -->
        <h3 class="section-title"><i class="fas fa-history"></i> Historial de Requests</h3>
        
        <?php if (!empty($requests)): ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Fecha y Hora</th>
                            <th>Tipo de Request</th>
                            <th>Token</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($requests as $request): ?>
                            <tr>
                                <td><?= date('d/m/Y H:i', strtotime($request['fecha'])) ?></td>
                                <td><?= htmlspecialchars($request['Tipo']) ?></td>
                                <td>
                                    <span class="token-value" title="<?= htmlspecialchars($request['Token']) ?>">
                                        <?= substr($request['Token'], 0, 20) ?>...
                                    </span>
                                </td>
                                <td>
                                    <?php
                                    $isError = stripos($request['Tipo'], 'error') !== false;
                                    $badgeClass = $isError ? 'badge-danger' : 'badge-success';
                                    $statusText = $isError ? 'Error' : 'Éxito';
                                    ?>
                                    <span class="badge <?= $badgeClass ?>"><?= $statusText ?></span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <button class="btn btn-primary btn-sm" onclick="showRequestDetails(<?= $request['Id'] ?>)">
                                            <i class="fas fa-eye"></i> Detalles
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-search"></i>
                <h3>No se encontraron requests</h3>
                <p>Este cliente aún no ha realizado ninguna consulta a la API.</p>
            </div>
        <?php endif; ?>

        <!-- Tokens del Cliente -->
        <h3 class="section-title"><i class="fas fa-key"></i> Tokens del Cliente</h3>
        
        <?php if (!empty($tokens)): ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Token</th>
                            <th>Fecha de Registro</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tokens as $token): ?>
                            <tr>
                                <td>
                                    <span class="token-value" title="<?= htmlspecialchars($token['Token']) ?>">
                                        <?= substr($token['Token'], 0, 30) ?>...
                                    </span>
                                </td>
                                <td><?= date('d/m/Y H:i', strtotime($token['Fecha_registro'])) ?></td>
                                <td>
                                    <span class="badge <?= $token['Estado'] ? 'badge-success' : 'badge-secondary' ?>">
                                        <?= $token['Estado'] ? 'Activo' : 'Inactivo' ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <?php if ($token['Estado']): ?>
                                            <button class="btn btn-warning btn-sm" onclick="regenerateToken(<?= $token['id'] ?>)">
                                                <i class="fas fa-sync-alt"></i> Regenerar
                                            </button>
                                            <button class="btn btn-danger btn-sm" onclick="deactivateToken(<?= $token['id'] ?>)">
                                                <i class="fas fa-ban"></i> Desactivar
                                            </button>
                                        <?php else: ?>
                                            <button class="btn btn-success btn-sm" onclick="activateToken(<?= $token['id'] ?>)">
                                                <i class="fas fa-check"></i> Activar
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-key"></i>
                <h3>No se encontraron tokens</h3>
                <p>Este cliente no tiene tokens registrados.</p>
            </div>
        <?php endif; ?>

        <!-- Acciones -->
        <div class="actions mt-4">
            <a href="index.php?controller=tokenapi&action=create&client_id=<?= $client['id'] ?>" class="btn btn-success">
                <i class="fas fa-plus"></i> Generar Nuevo Token
            </a>
            <button class="btn btn-primary" onclick="exportReport()">
                <i class="fas fa-file-export"></i> Exportar Reporte
            </button>
        </div>
    </div>
</div>

<!-- Modal para detalles del request -->
<div id="requestModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Detalles del Request</h3>
        <div id="requestDetails"></div>
    </div>
</div>

<style>
/* Estilos CSS del código anterior */
:root {
    --primary: #3498db;
    --primary-dark: #2980b9;
    --secondary: #6c757d;
    --success: #27ae60;
    --warning: #f39c12;
    --danger: #e74c3c;
    --info: #17a2b8;
    --light: #f8f9fa;
    --dark: #343a40;
    --white: #ffffff;
    --gray: #6c757d;
    --gray-light: #e9ecef;
    --border-radius: 8px;
    --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    --transition: all 0.3s ease;
}

/* ... (todos los estilos CSS del código anterior) ... */

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    background-color: var(--white);
    margin: 5% auto;
    padding: 20px;
    border-radius: var(--border-radius);
    width: 80%;
    max-width: 600px;
    box-shadow: var(--box-shadow);
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover {
    color: var(--dark);
}
</style>

<script>
// Funcionalidad JavaScript
function showRequestDetails(requestId) {
    // Simular obtención de detalles (en una implementación real, harías una petición AJAX)
    const details = `
        <div class="info-grid">
            <div class="info-item">
                <label>ID del Request:</label>
                <span>${requestId}</span>
            </div>
            <div class="info-item">
                <label>Fecha Exacta:</label>
                <span>${new Date().toLocaleString()}</span>
            </div>
            <div class="info-item">
                <label>Tipo:</label>
                <span>GET /hotels</span>
            </div>
            <div class="info-item">
                <label>Estado:</label>
                <span class="badge badge-success">Éxito</span>
            </div>
        </div>
        <div class="mt-4">
            <h4>Respuesta:</h4>
            <pre style="background: var(--light); padding: 15px; border-radius: var(--border-radius); overflow: auto;">
{
    "status": "success",
    "data": [...]
}
            </pre>
        </div>
    `;
    
    document.getElementById('requestDetails').innerHTML = details;
    document.getElementById('requestModal').style.display = 'block';
}

function regenerateToken(tokenId) {
    if (confirm('¿Está seguro de que desea regenerar este token? El token actual dejará de funcionar.')) {
        window.location.href = `index.php?controller=tokenapi&action=regenerate&id=${tokenId}&client_id=<?= $client['id'] ?>`;
    }
}

function deactivateToken(tokenId) {
    if (confirm('¿Está seguro de que desea desactivar este token?')) {
        window.location.href = `index.php?controller=tokenapi&action=deactivate&id=${tokenId}&client_id=<?= $client['id'] ?>`;
    }
}

function activateToken(tokenId) {
    if (confirm('¿Está seguro de que desea activar este token?')) {
        window.location.href = `index.php?controller=tokenapi&action=activate&id=${tokenId}&client_id=<?= $client['id'] ?>`;
    }
}

function exportReport() {
    // En una implementación real, esto generaría un PDF o Excel
    alert('Exportando reporte en formato PDF...');
    // window.location.href = `index.php?controller=clientapi&action=export&id=<?= $client['id'] ?>`;
}

// Cerrar modal
document.querySelector('.close').addEventListener('click', function() {
    document.getElementById('requestModal').style.display = 'none';
});

// Cerrar modal al hacer clic fuera
window.addEventListener('click', function(event) {
    const modal = document.getElementById('requestModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>