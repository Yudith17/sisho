<?php
$title = "Estadísticas API - Sistema de Hoteles";
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="main-card">
    <div class="card-header">
        <h2 class="card-title"><i class="fas fa-chart-bar"></i> Estadísticas de Solicitudes API</h2>
        <div>
            <a href="index.php?controller=countrequest&action=create" class="btn btn-success">
                <i class="fas fa-plus"></i> Registrar Solicitud
            </a>
        </div>
    </div>
    <div class="card-body">
        <!-- Resumen Estadístico -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 30px;">
            <div style="background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; padding: 20px; border-radius: var(--radius); text-align: center;">
                <div style="font-size: 24px; font-weight: bold;"><?= $stats['total_requests'] ?? 0 ?></div>
                <div style="font-size: 14px;">Total Solicitudes</div>
            </div>
            <div style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 20px; border-radius: var(--radius); text-align: center;">
                <div style="font-size: 24px; font-weight: bold;"><?= $stats['unique_tokens'] ?? 0 ?></div>
                <div style="font-size: 14px;">Tokens Únicos</div>
            </div>
            <div style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; padding: 20px; border-radius: var(--radius); text-align: center;">
                <div style="font-size: 24px; font-weight: bold;"><?= $stats['today_requests'] ?? 0 ?></div>
                <div style="font-size: 14px;">Hoy</div>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Token</th>
                        <th>Cliente</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($requests)): ?>
                        <?php foreach ($requests as $request): ?>
                        <tr>
                            <td><?= $request['Id'] ?></td>
                            <td>
                                <code style="font-size: 11px; background: #f1f5f9; padding: 4px 8px; border-radius: 4px;">
                                    <?= substr($request['Token'], 0, 15) ?>...
                                </code>
                            </td>
                            <td><?= htmlspecialchars($request['razon_social']) ?></td>
                            <td>
                                <span class="badge <?= $request['Tipo'] == 'consulta' ? 'badge-success' : 'badge-info' ?>">
                                    <?= ucfirst($request['Tipo']) ?>
                                </span>
                            </td>
                            <td><?= date('d/m/Y H:i', strtotime($request['fecha'])) ?></td>
                            <td>
                                <div class="actions">
                                    <a href="index.php?controller=countrequest&action=view&id=<?= $request['Id'] ?>" class="action-btn action-view">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                    <a href="index.php?controller=countrequest&action=delete&id=<?= $request['Id'] ?>" class="action-btn action-delete" 
                                       onclick="return confirmDelete('¿Estás seguro de eliminar este registro?')">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="fas fa-chart-bar"></i>
                                    <p>No hay registros de solicitudes</p>
                                    <a href="index.php?controller=countrequest&action=create" class="btn btn-success">
                                        <i class="fas fa-plus"></i> Registrar primera solicitud
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>