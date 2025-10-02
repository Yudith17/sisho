<?php
$title = "Clientes API - Sistema de Hoteles";
require_once __DIR__ . '/../layouts/header.php';
?>

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
                                    <a href="index.php?controller=clientapi&action=edit&id=<?= $client['id'] ?>" class="action-btn action-edit">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <a href="index.php?controller=clientapi&action=delete&id=<?= $client['id'] ?>" class="action-btn action-delete" 
                                       onclick="return confirmDelete('¿Estás seguro de eliminar este cliente API?')">
                                        <i class="fas fa-trash"></i> Eliminar
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