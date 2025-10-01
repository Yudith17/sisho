<h1>Nuevo Token API</h1>
<form method="post" action="">
    <label>Cliente:
        <select name="id_client_api" required>
            <option value="">-- Seleccione cliente --</option>
            <?php foreach ($clients as $c): ?>
                <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['ruc']) ?> - <?= htmlspecialchars($c['razon_social']) ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <label>Token: <input type="text" name="token" required></label><br>
    <button type="submit">Guardar</button>
</form>
<a href="index.php?controller=token_api&action=index">Volver</a>
