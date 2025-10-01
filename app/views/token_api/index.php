<h1>Tokens API</h1>
<a href="index.php?controller=token_api&action=create">Nuevo token</a>
<table border="1">
    <tr>
        <th>ID</th><th>Cliente (RUC)</th><th>Token</th><th>Estado</th><th>Acciones</th>
    </tr>
    <?php foreach ($tokens as $t): ?>
    <tr>
        <td><?= htmlspecialchars($t['id']) ?></td>
        <td><?= htmlspecialchars($t['ruc']) . " / " . htmlspecialchars($t['razon_social']) ?></td>
        <td><?= htmlspecialchars($t['token']) ?></td>
        <td><?= $t['estado']==1 ? 'Activo' : 'Inactivo' ?></td>
        <td>
            <a href="index.php?controller=token_api&action=view&id=<?= $t['id'] ?>">Ver</a> |
            <a href="index.php?controller=token_api&action=edit&id=<?= $t['id'] ?>">Editar</a> |
            <a href="index.php?controller=token_api&action=delete&id=<?= $t['id'] ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
