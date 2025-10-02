<?php
$title = "Detalles Token - Sistema de Hoteles";
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="main-card">
    <div class="card-header">
        <h2 class="card-title"><i class="fas fa-eye"></i> Detalles del Token</h2>
    </div>
    <div class="card-body">
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">ID</label>
                <div class="form-input" style="background: #f8fafc;"><?= $token['id'] ?></div>
            </div>
            <div class="form-group">
                <label class="form-label">Cliente API</label>
                <div class="form-input" style="background: #f8fafc;"><?= htmlspecialchars($token['razon_social']) ?></div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Token</label>
            <div class="form-input" style="background: #f8fafc; font-family: monospace; font-size: 12px; word-break: break-all;">
                <?= htmlspecialchars($token['Token']) ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Estado</label>
                <div class="form-input" style="background: #f8fafc;">
                    <span class="badge <?= $token['Estado'] == 1 ? 'badge-success' : 'badge-secondary' ?>">
                        <?= $token['Estado'] == 1 ? 'Activo' : 'Inactivo' ?>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Fecha de Registro</label>
                <div class="form-input" style="background: #f8fafc;">
                    <?= date('d/m/Y H:i', strtotime($token['Fecha_registro'])) ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <a href="index.php?controller=tokenapi&action=edit&id=<?= $token['id'] ?>" class="btn btn-primary">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="index.php?controller=tokenapi&action=index" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver a la lista
            </a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>