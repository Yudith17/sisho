<h1>Editar Cliente API</h1>
<form method="post" action="">
    <label>RUC: <input type="text" name="ruc" value="<?= htmlspecialchars($client['ruc']) ?>" required></label><br>
    <label>Razón Social: <input type="text" name="razon_social" value="<?= htmlspecialchars($client['razon_social']) ?>" required></label><br>
    <label>Teléfono: <input type="text" name="telefono" value="<?= htmlspecialchars($client['telefono']) ?>"></label><br>
    <label>Correo: <input type="email" name="correo" value="<?= htmlspecialchars($client['correo']) ?>"></label><br>
    <label>Estado: 
        <select name="estado">
            <option value="1" <?= $client['estado']==1 ? 'selected' : '' ?>>Activo</option>
            <option value="0" <?= $client['estado']==0 ? 'selected' : '' ?>>Inactivo</option>
        </select>
    </label><br>
    <button type="submit">Actualizar</button>
</form>
<a href="index.php?controller=client_api&action=index">Volver</a>
