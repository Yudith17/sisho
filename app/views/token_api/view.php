<h1>Detalle Token API</h1>
<p><strong>ID:</strong> <?= htmlspecialchars($token['id']) ?></p>
<p><strong>Cliente RUC:</strong> <?= htmlspecialchars($token['ruc']) ?></p>
<p><strong>Token:</strong> <?= htmlspecialchars($token['token']) ?></p>
<p><strong>Fecha Registro:</strong> <?= htmlspecialchars($token['fecha_registro']) ?></p>
<p><strong>Estado:</strong> <?= $token['estado']==1 ? 'Activo' : 'Inactivo' ?></p>
<a href="index.php?controller=token_api&action=index">Volver</a>
