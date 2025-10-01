<h1>Editar Token API</h1>
<form method="post" action="">
    <label>Cliente:
        <select name="id_client_api" required>
            <?php foreach ($clients as $c): ?>
                <option value="<?= $c['id'] ?>" <?= $c['id'] == $token['id_client_api'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($c['ruc']) ?> - <?= htmlspecialchars($c['razon_social']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <label>Token: <input type="text" name="token" value="<?= htmlspecialchars($token['token']) ?>" required></label><br>
    <label>Estado:
        <select name="estado">
            <option value="1" <?= $token['estado']==1 ? 'selected' : '' ?>>Activo</option>
            <option value="0" <?= $token['estado']==0 ? 'selected' : '' ?>>Inactivo</option>
        </select>
    </label><br>
    <button type="submit">Actualizar</button>
</form>
<a href="index.php?controller=token_api&action=index">Volver</a>
