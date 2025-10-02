<?php
$title = "Tokens API - Sistema de Hoteles";
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="main-card">
    <div class="card-header">
        <h2 class="card-title"><i class="fas fa-key"></i> Lista de Tokens API</h2>
        <div>
            <a href="index.php?controller=tokenapi&action=create" class="btn btn-success">
                <i class="fas fa-plus"></i> Generar Token
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Token</th>
                        <th>Fecha Registro</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($tokens)): ?>
                        <?php foreach ($tokens as $token): ?>
                        <tr>
                            <td><?= $token['id'] ?></td>
                            <td><?= htmlspecialchars($token['razon_social']) ?></td>
                            <td>
                                <code style="font-size: 11px; background: #f1f5f9; padding: 4px 8px; border-radius: 4px;">
                                    <?= substr($token['Token'], 0, 20) ?>...
                                </code>
                            </td>
                            <td><?= date('d/m/Y H:i', strtotime($token['Fecha_registro'])) ?></td>
                            <td>
                                <span class="badge <?= $token['Estado'] == 1 ? 'badge-success' : 'badge-secondary' ?>">
                                    <?= $token['Estado'] == 1 ? 'Activo' : 'Inactivo' ?>
                                </span>
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="index.php?controller=tokenapi&action=edit&id=<?= $token['id'] ?>" class="action-btn action-edit">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <a href="index.php?controller=tokenapi&action=delete&id=<?= $token['id'] ?>" class="action-btn action-delete" 
                                       onclick="return confirmDelete('¿Estás seguro de eliminar este token?')">
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
                                    <i class="fas fa-key"></i>
                                    <p>No hay tokens generados</p>
                                    <a href="index.php?controller=tokenapi&action=create" class="btn btn-success">
                                        <i class="fas fa-plus"></i> Generar primer token
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