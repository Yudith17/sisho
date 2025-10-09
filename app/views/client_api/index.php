<?php
$title = "Clientes API - Sistema de Hoteles";
require_once __DIR__ . '/../layouts/header.php';
?>

<style>
.action-btn.action-view {
    background-color: #17a2b8;
    color: white;
}

.action-btn.action-view:hover {
    background-color: #138496;
}

.action-btn.action-search {
    background-color: #28a745;
    color: white;
}

.action-btn.action-search:hover {
    background-color: #218838;
}

.actions {
    display: flex;
    gap: 5px;
    flex-wrap: wrap;
}

.action-btn {
    padding: 6px 12px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 12px;
    transition: background-color 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    border: none;
    cursor: pointer;
}

.action-btn i {
    font-size: 11px;
}
</style>

<div class="main-card">
    <div class="card-header">
        <h2 class="card-title"><i class="fas fa-users"></i> Lista de Clientes API</h2>
        <div>
            <a href="index.php?controller=clientapi&action=create" class="btn btn-success">
                <i class="fas fa-plus"></i> Nuevo Cliente API
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>RUC</th>
                        <th>Razón Social</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Fecha Registro</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($clients)): ?>
                        <?php foreach ($clients as $client): ?>
                        <tr>
                            <td><?= $client['id'] ?></td>
                            <td><?= htmlspecialchars($client['ruc']) ?></td>
                            <td><?= htmlspecialchars($client['razon_social']) ?></td>
                            <td><?= htmlspecialchars($client['telefono'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($client['correo']) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($client['fecha_registro'])) ?></td>
                            <td>
                                <span class="badge <?= $client['estado'] == 'activo' ? 'badge-success' : 'badge-secondary' ?>">
                                    <?= ucfirst($client['estado']) ?>
                                </span>
                            </td>
                            <td>
                                <div class="actions">
                                    <!-- SOLO VER Y BUSCAR -->
                                    <a href="index.php?controller=clientapi&action=view&id=<?= $client['id'] ?>" 
                                       class="action-btn action-view">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                    <a href="index.php?controller=clientapi&action=search&id=<?= $client['id'] ?>" 
                                       class="action-btn action-search">
                                        <i class="fas fa-search"></i> Buscar
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <i class="fas fa-users"></i>
                                    <p>No hay clientes API registrados</p>
                                    <a href="index.php?controller=clientapi&action=create" class="btn btn-success">
                                        <i class="fas fa-plus"></i> Agregar primer cliente
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