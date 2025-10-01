<?php
require_once "../config/database.php";
require_once "../models/ClienteApi.php";

$pdo = Database::getInstance();
$cliente = new ClienteApi($pdo);

// Procesar acciones
if ($_POST['action'] ?? '' == 'create') {
    $cliente->ruc = $_POST['ruc'];
    $cliente->razon_social = $_POST['razon_social'];
    $cliente->telefono = $_POST['telefono'];
    $cliente->correo = $_POST['correo'];
    $cliente->estado = $_POST['estado'];
    $cliente->create();
    header("Location: clientes.php?success=1");
    exit;
}

if ($_POST['action'] ?? '' == 'update') {
    $cliente->id = $_POST['id'];
    $cliente->ruc = $_POST['ruc'];
    $cliente->razon_social = $_POST['razon_social'];
    $cliente->telefono = $_POST['telefono'];
    $cliente->correo = $_POST['correo'];
    $cliente->estado = $_POST['estado'];
    $cliente->update();
    header("Location: clientes.php?success=1");
    exit;
}

if ($_GET['delete'] ?? '') {
    $cliente->id = $_GET['delete'];
    $cliente->delete();
    header("Location: clientes.php?success=1");
    exit;
}

// Obtener datos
$clientes = $cliente->readAll();
$editData = null;
if ($_GET['edit'] ?? '') {
    $cliente->id = $_GET['edit'];
    $editData = $cliente->readOne();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes API</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestión de Clientes API</h1>
        
        <!-- Formulario -->
        <div class="card">
            <h2><?= $editData ? 'Editar' : 'Nuevo' ?> Cliente</h2>
            <form method="POST">
                <input type="hidden" name="action" value="<?= $editData ? 'update' : 'create' ?>">
                <?php if ($editData): ?>
                    <input type="hidden" name="id" value="<?= $editData['id'] ?>">
                <?php endif; ?>
                
                <div class="form-group">
                    <label class="form-label">RUC</label>
                    <input type="text" name="ruc" class="form-input" value="<?= $editData['ruc'] ?? '' ?>" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Razón Social</label>
                    <input type="text" name="razon_social" class="form-input" value="<?= $editData['razon_social'] ?? '' ?>" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Teléfono</label>
                    <input type="text" name="telefono" class="form-input" value="<?= $editData['telefono'] ?? '' ?>">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Correo</label>
                    <input type="email" name="correo" class="form-input" value="<?= $editData['correo'] ?? '' ?>" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-input" required>
                        <option value="activo" <?= ($editData['estado'] ?? '') == 'activo' ? 'selected' : '' ?>>Activo</option>
                        <option value="inactivo" <?= ($editData['estado'] ?? '') == 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary"><?= $editData ? 'Actualizar' : 'Guardar' ?></button>
                <?php if ($editData): ?>
                    <a href="clientes.php" class="btn btn-secondary">Cancelar</a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Lista -->
        <div class="card">
            <h2>Lista de Clientes</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>RUC</th>
                        <th>Razón Social</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $c): ?>
                    <tr>
                        <td><?= $c['id'] ?></td>
                        <td><?= $c['ruc'] ?></td>
                        <td><?= $c['razon_social'] ?></td>
                        <td><?= $c['telefono'] ?></td>
                        <td><?= $c['correo'] ?></td>
                        <td>
                            <span class="badge <?= $c['estado'] == 'activo' ? 'badge-success' : 'badge-secondary' ?>">
                                <?= $c['estado'] ?>
                            </span>
                        </td>
                        <td>
                            <a href="clientes.php?edit=<?= $c['id'] ?>" class="btn btn-warning">Editar</a>
                            <a href="clientes.php?delete=<?= $c['id'] ?>" class="btn btn-danger" 
                               onclick="return confirm('¿Eliminar cliente?')">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>