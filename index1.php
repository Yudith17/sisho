<?php
require_once "Database.php";
require_once "Cliente_Api.php";

// Instancia del modelo
$clienteApi = new ClienteApi();
$clientes = $clienteApi->getAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD Cliente API</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        a {
            text-decoration: none;
            padding: 6px 12px;
            background: #28a745;
            color: #fff;
            border-radius: 4px;
        }
        a:hover {
            background: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
            background: #007bff;
            color: white;
        }
        .btn-edit {
            background: #ffc107;
        }
        .btn-delete {
            background: #dc3545;
        }
    </style>
</head>
<body>

    <h1>Gestión de Cliente API</h1>

    <a href="create.php">➕ Nuevo Cliente</a>

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
            <?php if ($clientes): ?>
                <?php foreach ($clientes as $c): ?>
                    <tr>
                        <td><?= $c['id'] ?></td>
                        <td><?= $c['ruc'] ?></td>
                        <td><?= $c['razon_social'] ?></td>
                        <td><?= $c['telefono'] ?></td>
                        <td><?= $c['correo'] ?></td>
                        <td><?= $c['fecha_registro'] ?></td>
                        <td><?= $c['estado'] ?></td>
                        <td>
                            <a class="btn-edit" href="edit.php?id=<?= $c['id'] ?>">✏️ Editar</a>
                            <a class="btn-delete" href="delete.php?id=<?= $c['id'] ?>" onclick="return confirm('¿Seguro de eliminar este cliente?');">🗑️ Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No hay clientes registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
