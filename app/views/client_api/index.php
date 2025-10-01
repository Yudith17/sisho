<h1>Clientes API</h1>
<a href="index.php?controller=client_api&action=create">Nuevo cliente</a>
<table border="1">
    <tr>
        <th>ID</th><th>RUC</th><th>Razón Social</th><th>Teléfono</th><th>Correo</th><th>Estado</th><th>Acciones</th>
    </tr>
    <?php foreach ($clients as $c): ?>
    <tr>
        <td><?= htmlspecialchars($c['id']) ?></td>
        <td><?= htmlspecialchars($c['ruc']) ?></td>
        <td><?= htmlspecialchars($c['razon_social']) ?></td>
        <td><?= htmlspecialchars($c['telefono']) ?></td>
        <td><?= htmlspecialchars($c['correo']) ?></td>
        <td><?= $c['estado'] == 1 ? 'Activo' : 'Inactivo' ?></td>
        <td>
            <a href="index.php?controller=client_api&action=view&id=<?= $c['id'] ?>">Ver</a> |
            <a href="index.php?controller=client_api&action=edit&id=<?= $c['id'] ?>">Editar</a> |
            <a href="index.php?controller=client_api&action=delete&id=<?= $c['id'] ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
