<h1>Detalle Cliente API</h1>
<p><strong>ID:</strong> <?= htmlspecialchars($client['id']) ?></p>
<p><strong>RUC:</strong> <?= htmlspecialchars($client['ruc']) ?></p>
<p><strong>Razón Social:</strong> <?= htmlspecialchars($client['razon_social']) ?></p>
<p><strong>Teléfono:</strong> <?= htmlspecialchars($client['telefono']) ?></p>
<p><strong>Correo:</strong> <?= htmlspecialchars($client['correo']) ?></p>
<p><strong>Fecha Registro:</strong> <?= htmlspecialchars($client['fecha_registro']) ?></p>
<p><strong>Estado:</strong> <?= $client['estado']==1 ? 'Activo' : 'Inactivo' ?></p>
<a href="index.php?controller=client_api&action=index">Volver</a>
