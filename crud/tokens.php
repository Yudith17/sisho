<?php
require_once "../config/database.php";
require_once "../models/Token.php";
require_once "../models/ClienteApi.php";

$pdo = Database::getInstance();
$token = new Token($pdo);
$clienteApi = new ClienteApi($pdo);

// Procesar acciones
if ($_POST['action'] ?? '' == 'create') {
    $tokenValue = bin2hex(random_bytes(32));
    $diasValidez = $_POST['dias_validez'];
    
    $token->cliente_api_id = $_POST['cliente_api_id'];
    $token->token = $tokenValue;
    $token->fecha_creacion = date('Y-m-d H:i:s');
    $token->fecha_expiracion = date('Y-m-d H:i:s', strtotime("+$diasValidez days"));
    $token->estado = $_POST['estado'];
    $token->create();
    header("Location: tokens.php?success=1");
    exit;
}

if ($_POST['action'] ?? '' == 'update') {
    $token->id = $_POST['id'];
    $token->cliente_api_id = $_POST['cliente_api_id'];
    $token->fecha_creacion = $_POST['fecha_creacion'];
    $token->fecha_expiracion = $_POST['fecha_expiracion'];
    $token->estado = $_POST['estado'];
    $token->update();
    header("Location: tokens.php?success=1");
    exit;
}

if ($_GET['delete'] ?? '') {
    $token->id = $_GET['delete'];
    $token->delete();
    header("Location: tokens.php?success=1");
    exit;
}

// Obtener datos
$tokens = $token->readAll();
$clientes = $clienteApi->readAll();
$editData = null;
if ($_GET['edit'] ?? '') {
    $token->id = $_GET['edit'];
    $editData = $token->readOne();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tokens</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f5f5f5; color: #333; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .card { background: white; border-radius: 10px; padding: 25px; margin-bottom: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .btn { padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-primary { background: #2563eb; color: white; }
        .btn-success { background: #10b981; color: white; }
        .btn-danger { background: #ef4444; color: white; }
        .btn-warning { background: #f59e0b; color: white; }
        .form-group { margin-bottom: 15px; }
        .form-label { display: block; margin-bottom: 5px; font-weight: 600; }
        .form-input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8fafc; font-weight: 600; }
        .badge { padding: 4px 8px; border-radius: 12px; font-size: 12px; }
        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-secondary { background: #e5e7eb; color: #374151; }
        .token-preview { font-family: monospace; background: #f1f5f9; padding: 5px 10px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestión de Tokens API</h1>
        
        <!-- Formulario -->
        <div class="card">
            <h2><?= $editData ? 'Editar' : 'Nuevo' ?> Token</h2>
            <form method="POST">
                <input type="hidden" name="action" value="<?= $editData ? 'update' : 'create' ?>">
                <?php if ($editData): ?>
                    <input type="hidden" name="id" value="<?= $editData['id'] ?>">
                <?php endif; ?>
                
                <div class="form-group">
                    <label class="form-label">Cliente API</label>
                    <select name="cliente_api_id" class="form-input" required>
                        <option value="">Seleccionar cliente</option>
                        <?php foreach ($clientes as $cliente): ?>
                            <option value="<?= $cliente['id'] ?>" <?= ($editData['cliente_api_id'] ?? '') == $cliente['id'] ? 'selected' : '' ?>>
                                <?= $cliente['razon_social'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <?php if ($editData): ?>
                    <div class="form-group">
                        <label class="form-label">Token</label>
                        <div class="token-preview"><?= substr($editData['token'], 0, 20) ?>...</div>
                        <small>El token no se puede modificar por seguridad</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Fecha Creación</label>
                        <input type="datetime-local" name="fecha_creacion" class="form-input" 
                               value="<?= str_replace(' ', 'T', $editData['fecha_creacion']) ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Fecha Expiración</label>
                        <input type="datetime-local" name="fecha_expiracion" class="form-input" 
                               value="<?= str_replace(' ', 'T', $editData['fecha_expiracion']) ?>" required>
                    </div>
                <?php else: ?>
                    <div class="form-group">
                        <label class="form-label">Días de Validez</label>
                        <input type="number" name="dias_validez" class="form-input" value="30" min="1" required>
                    </div>
                <?php endif; ?>
                
                <div class="form-group">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-input" required>
                        <option value="activo" <?= ($editData['estado'] ?? '') == 'activo' ? 'selected' : '' ?>>Activo</option>
                        <option value="inactivo" <?= ($editData['estado'] ?? '') == 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary"><?= $editData ? 'Actualizar' : 'Generar Token' ?></button>
                <?php if ($editData): ?>
                    <a href="tokens.php" class="btn btn-secondary">Cancelar</a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Lista -->
        <div class="card">
            <h2>Lista de Tokens</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Token</th>
                        <th>Creación</th>
                        <th>Expiración</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tokens as $t): ?>
                    <tr>
                        <td><?= $t['id'] ?></td>
                        <td><?= $t['razon_social'] ?></td>
                        <td><span class="token-preview"><?= substr($t['token'], 0, 15) ?>...</span></td>
                        <td><?= $t['fecha_creacion'] ?></td>
                        <td><?= $t['fecha_expiracion'] ?></td>
                        <td>
                            <span class="badge <?= $t['estado'] == 'activo' ? 'badge-success' : 'badge-secondary' ?>">
                                <?= $t['estado'] ?>
                            </span>
                        </td>
                        <td>
                            <a href="tokens.php?edit=<?= $t['id'] ?>" class="btn btn-warning">Editar</a>
                            <a href="tokens.php?delete=<?= $t['id'] ?>" class="btn btn-danger" 
                               onclick="return confirm('¿Eliminar token?')">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>