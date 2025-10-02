<?php
$title = "Detalles de Solicitud - Sistema de Hoteles";
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="main-card">
    <div class="card-header">
        <h2 class="card-title"><i class="fas fa-eye"></i> Detalles de Solicitud API</h2>
    </div>
    <div class="card-body">
        <div style="max-width: 600px;">
            <div class="detail-row">
                <label>ID:</label>
                <span><?= $request['Id'] ?></span>
            </div>
            <div class="detail-row">
                <label>Cliente:</label>
                <span><?= htmlspecialchars($request['razon_social']) ?></span>
            </div>
            <div class="detail-row">
                <label>Token:</label>
                <code style="background: #f1f5f9; padding: 8px 12px; border-radius: 4px; display: block; margin-top: 5px; font-size: 12px;">
                    <?= $request['Token'] ?>
                </code>
            </div>
            <div class="detail-row">
                <label>Tipo:</label>
                <span class="badge badge-info"><?= $request['Tipo'] ?></span>
            </div>
            <div class="detail-row">
                <label>Fecha y Hora:</label>
                <span><?= date('d/m/Y H:i:s', strtotime($request['fecha'])) ?></span>
            </div>
        </div>

        <div class="form-group" style="margin-top: 30px;">
            <a href="index.php?controller=countrequest&action=index" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver al Listado
            </a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>