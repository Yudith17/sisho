<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tokens API - SISHO</title>
    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --primary-light: #dbeafe;
            --secondary: #64748b;
            --accent: #06b6d4;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #8b5cf6;
            --background: #f8fafc;
            --surface: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #475569;
            --text-light: #94a3b8;
            --border: #e2e8f0;
            --shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 4px 6px rgba(0, 0, 0, 0.1);
            --radius: 8px;
            --transition: all 0.2s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--background);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header */
        header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 20px 0;
            margin-bottom: 30px;
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .app-title {
            font-size: 24px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .app-title i {
            font-size: 28px;
        }

        .user-actions {
            display: flex;
            gap: 12px;
        }

        /* Botones */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: var(--radius);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: var(--transition);
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: white;
            color: var(--primary);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-lg);
        }

        .btn-success {
            background: var(--success);
            color: white;
        }

        .btn-success:hover {
            background: #059669;
            transform: translateY(-1px);
        }

        .btn-info {
            background: var(--info);
            color: white;
        }

        .btn-info:hover {
            background: #7c3aed;
            transform: translateY(-1px);
        }

        /* Menu de Navegación */
        .nav-menu {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .nav-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: var(--radius);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: var(--transition);
            border: 1px solid var(--border);
            background: var(--surface);
            color: var(--text-primary);
        }

        .nav-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary);
        }

        .nav-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Card Principal */
        .main-card {
            background: var(--surface);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 30px;
            border: 1px solid var(--border);
        }

        .card-header {
            padding: 20px;
            border-bottom: 1px solid var(--border);
            background: var(--surface);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-title i {
            color: var(--primary);
        }

        .card-counter {
            background: var(--primary-light);
            color: var(--primary);
            padding: 8px 16px;
            border-radius: var(--radius);
            font-weight: 600;
            font-size: 14px;
        }

        /* Formulario Generar Token */
        .generate-form {
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 25px;
            margin-bottom: 30px;
            display: none;
        }

        .generate-form.active {
            display: block;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .form-select, .form-input {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            font-size: 14px;
            transition: var(--transition);
            background: white;
        }

        .form-select:focus, .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        .form-help {
            display: block;
            font-size: 12px;
            color: var(--text-light);
            margin-top: 5px;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }

        .btn-secondary {
            background: var(--secondary);
            color: white;
        }

        .btn-secondary:hover {
            background: #475569;
        }

        /* Tabla */
        .table-container {
            overflow-x: auto;
            border-radius: var(--radius);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: var(--surface);
        }

        th {
            background: #f8fafc;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: var(--text-secondary);
            border-bottom: 2px solid var(--border);
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid var(--border);
            transition: var(--transition);
        }

        tr:hover td {
            background: #f8fafc;
        }

        /* Badges de Estado */
        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-success {
            background: #f0fdf4;
            color: var(--success);
            border: 1px solid #dcfce7;
        }

        .badge-danger {
            background: #fef2f2;
            color: var(--danger);
            border: 1px solid #fee2e2;
        }

        /* Token Styles */
        .token-code {
            background: #f8fafc;
            padding: 8px 12px;
            border-radius: 6px;
            font-family: 'Courier New', monospace;
            font-size: 12px;
            border: 1px dashed var(--border);
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
            transition: var(--transition);
        }

        .token-code:hover {
            background: var(--primary-light);
            border-color: var(--primary);
        }

        /* Acciones */
        .actions {
            display: flex;
            gap: 6px;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 11px;
            font-weight: 500;
            transition: var(--transition);
        }

        .action-edit {
            background: #fffbeb;
            color: var(--warning);
            border: 1px solid #fef3c7;
        }

        .action-edit:hover {
            background: #fef3c7;
        }

        .action-delete {
            background: #fef2f2;
            color: var(--danger);
            border: 1px solid #fee2e2;
        }

        .action-delete:hover {
            background: #fee2e2;
        }

        .action-view {
            background: #f0f9ff;
            color: var(--primary);
            border: 1px solid #bae6fd;
        }

        .action-view:hover {
            background: #e0f2fe;
        }

        /* Estado vacío */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: var(--text-secondary);
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 15px;
            color: var(--text-light);
        }

        .empty-state p {
            font-size: 16px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        /* Alerta de Token Generado */
        .token-alert {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 20px;
            border-radius: var(--radius);
            margin-bottom: 25px;
            box-shadow: var(--shadow-lg);
            border-left: 4px solid #047857;
        }

        .token-alert h5 {
            font-size: 18px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .token-alert .token-display {
            background: rgba(255, 255, 255, 0.15);
            padding: 15px;
            border-radius: 6px;
            margin: 15px 0;
            border: 1px dashed rgba(255, 255, 255, 0.3);
        }

        .token-alert .token-value {
            font-family: 'Courier New', monospace;
            font-size: 14px;
            word-break: break-all;
            background: rgba(0, 0, 0, 0.2);
            padding: 10px;
            border-radius: 4px;
            margin: 10px 0;
            color: white;
        }

        .token-alert .alert-close {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            float: right;
            transition: var(--transition);
        }

        .token-alert .alert-close:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Estilos para mostrar tokens encriptados en la tabla */
        .token-code-full {
            background: #f8fafc;
            padding: 8px 12px;
            border-radius: 6px;
            font-family: 'Courier New', monospace;
            font-size: 11px;
            border: 1px dashed #cbd5e1;
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
            transition: var(--transition);
            color: #475569;
        }

        .token-code-full:hover {
            background: #e2e8f0;
            border-color: #94a3b8;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .user-actions {
                justify-content: center;
                flex-wrap: wrap;
            }

            .nav-menu {
                justify-content: center;
            }

            .card-header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            th, td {
                padding: 12px 8px;
                font-size: 14px;
            }

            .actions {
                flex-direction: column;
                gap: 5px;
            }

            .action-btn {
                justify-content: center;
                padding: 8px;
            }

            .token-alert {
                padding: 15px;
            }

            .token-alert .token-value {
                font-size: 12px;
                padding: 8px;
            }
        }

        @media (max-width: 480px) {
            .app-title {
                font-size: 20px;
            }

            .app-title i {
                font-size: 24px;
            }

            .btn, .nav-btn {
                padding: 8px 16px;
                font-size: 13px;
            }

            .card-header {
                padding: 15px;
            }

            .card-title {
                font-size: 18px;
            }

            .nav-menu {
                flex-direction: column;
            }

            .form-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .form-actions .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-content">
            <div class="app-title">
                <i>🔑</i>
                SISHO - Sistema de Hoteles
            </div>
            <div class="user-actions">
                <a href="#" class="btn btn-primary">
                    <i>👤</i>
                    Mi Cuenta
                </a>
                <a href="index.php?controller=auth&action=logout" class="btn" style="background: rgba(255,255,255,0.2); color: white;">
                    <i>🚪</i>
                    Salir
                </a>
            </div>
        </div>
    </header>

    <div class="container">
        <!-- Mostrar alerta con token generado (si existe) -->
        <?php if (isset($_SESSION['token_generado']) && isset($_SESSION['token_cliente_nombre'])): ?>
            <div class="token-alert" id="tokenAlert">
                <button type="button" class="alert-close" onclick="closeTokenAlert()">✕ Cerrar</button>
                <h5>🎉 ¡Token Generado Exitosamente!</h5>
                <div class="token-display">
                    <p><strong>Cliente:</strong> <?= htmlspecialchars($_SESSION['token_cliente_nombre']) ?></p>
                    <p><strong>Token Generado:</strong></p>
                    <div class="token-value" id="tokenValue">
                        <?= htmlspecialchars($_SESSION['token_generado']) ?>
                    </div>
                    <small>⚠️ ¡Guarda este token en un lugar seguro! Solo se mostrará esta vez.</small>
                </div>
                <div style="margin-top: 15px;">
                    <button type="button" class="btn" style="background: rgba(255,255,255,0.3); color: white; border: 1px solid rgba(255,255,255,0.5);" onclick="copyToken()">
                        📋 Copiar Token
                    </button>
                </div>
            </div>
        <?php 
            // Limpiar la sesión después de mostrar
            unset($_SESSION['token_generado']);
            unset($_SESSION['token_cliente_nombre']);
        endif; 
        ?>

        <!-- Menú de Navegación -->
        <nav class="nav-menu">
            <a href="index.php?controller=hotel&action=index" class="nav-btn">
                <i>🏨</i>
                Hoteles
            </a>
            <a href="index.php?controller=clientapi&action=index" class="nav-btn">
                <i>👥</i>
                Clientes API
            </a>
            <a href="index.php?controller=tokenapi&action=index" class="nav-btn active">
                <i>🔑</i>
                Tokens API
            </a>
            <a href="index.php?controller=countrequest&action=index" class="nav-btn">
                <i>📊</i>
                Estadísticas
            </a>
        </nav>

        <!-- Botón para mostrar formulario -->
        <div style="margin-bottom: 20px;">
            <button type="button" id="showGenerateForm" class="btn btn-info">
                <i>➕</i>
                Generar Nuevo Token
            </button>
        </div>

        <!-- Formulario para Generar Token -->
        <div class="generate-form" id="generateForm">
            <h3 class="form-title">
                <i>🔑</i>
                Nuevo Token API
            </h3>
            
            <form method="POST" action="index.php?controller=tokenapi&action=create">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="id_cliente_api">Cliente API *</label>
                        <select id="id_cliente_api" name="id_cliente_api" class="form-select" required>
                            <option value="">Seleccionar cliente</option>
                            <?php 
                            // Obtener clientes activos desde la base de datos
                            if (isset($clients) && !empty($clients)): 
                                foreach ($clients as $client): 
                                    $estado = $client['estado'] ?? $client['Estado'] ?? '';
                                    $esActivo = ($estado == 'activo' || $estado == 'Active' || ($client['Estado'] ?? 0) == 1);
                                    
                                    if ($esActivo): 
                            ?>
                                        <option value="<?= $client['id'] ?>">
                                            <?= htmlspecialchars($client['razon_social'] ?? $client['nombre'] ?? 'Cliente') ?> 
                                            - <?= $client['ruc'] ?? $client['codigo'] ?? 'N/A' ?>
                                        </option>
                            <?php 
                                    endif;
                                endforeach;
                            else: 
                            ?>
                                <option value="" disabled>No hay clientes disponibles</option>
                            <?php endif; ?>
                        </select>
                        <span class="form-help">Seleccione un cliente API activo</span>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="estado">Estado *</label>
                        <select id="estado" name="estado" class="form-select" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                        <span class="form-help">Estado del token</span>
                    </div>
                </div>

                <div class="form-group">
                    <div style="background: #f0f9ff; border: 1px solid #bae6fd; border-radius: var(--radius); padding: 15px; margin-bottom: 15px;">
                        <p style="color: #0369a1; margin: 0; font-size: 14px;">
                            <strong>🔒 Seguridad:</strong> El token se generará automáticamente y se mostrará una sola vez. Se almacenará encriptado en la base de datos.
                        </p>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-success">
                        <i>🔑</i>
                        Generar Token
                    </button>
                    <button type="button" id="cancelGenerate" class="btn btn-secondary">
                        <i>✕</i>
                        Cancelar
                    </button>
                </div>
            </form>
        </div>

        <!-- Card Principal -->
        <div class="main-card">
            <div class="card-header">
                <div class="card-title">
                    <i>🔑</i>
                    Tokens API Generados
                </div>
                <div class="card-counter">
                    <?= count($tokens) ?> tokens
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Token</th>
                            <th>Fecha Registro</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($tokens)): ?>
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i>🔐</i>
                                        <p>No hay tokens API generados</p>
                                        <button type="button" id="showGenerateFormEmpty" class="btn btn-success">
                                            <i>➕</i>
                                            Generar Primer Token
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($tokens as $token): ?>
                            <tr>
                                <td>
                                    <strong>#<?= htmlspecialchars($token['id'] ?? '') ?></strong>
                                </td>
                                <td>
                                    <div style="font-weight: 600; color: var(--text-primary);">
                                        <?= htmlspecialchars($token['razon_social'] ?? $token['cliente_nombre'] ?? 'N/A') ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="token-code-full" title="Token encriptado - Haga clic para ver detalles">
                                        🔒 <?= htmlspecialchars(substr($token['token'] ?? '', 0, 35)) ?>...
                                    </div>
                                </td>
                                <td>
                                    <?= !empty($token['fecha_registro']) ? 
                                        date('d/m/Y H:i', strtotime($token['fecha_registro'])) : 
                                        'N/A' ?>
                                </td>
                                <td>
                                    <?php 
                                    $estado = $token['estado'] ?? '';
                                    $badgeClass = ($estado === 'activo' || $estado === 'Active' || ($token['Estado'] ?? 0) == 1) ? 'badge-success' : 'badge-danger';
                                    $estadoTexto = ($estado === 'activo' || $estado === 'Active' || ($token['Estado'] ?? 0) == 1) ? 'Active' : 'Inactive';
                                    ?>
                                    <span class="badge <?= $badgeClass ?>">
                                        <?= $estadoTexto ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="index.php?controller=tokenapi&action=view&id=<?= $token['id'] ?>" 
                                           class="action-btn action-view">
                                            <i>👁️</i>
                                            Ver
                                        </a>
                                        <a href="index.php?controller=tokenapi&action=edit&id=<?= $token['id'] ?>" 
                                           class="action-btn action-edit">
                                            <i>✏️</i>
                                            Editar
                                        </a>
                                        <a href="index.php?controller=tokenapi&action=delete&id=<?= $token['id'] ?>" 
                                           class="action-btn action-delete"
                                           onclick="return confirm('¿Estás seguro de eliminar este token?')">
                                            <i>🗑️</i>
                                            Eliminar
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Mostrar/ocultar formulario de generación
        document.getElementById('showGenerateForm').addEventListener('click', function() {
            document.getElementById('generateForm').classList.add('active');
        });

        document.getElementById('showGenerateFormEmpty').addEventListener('click', function() {
            document.getElementById('generateForm').classList.add('active');
        });

        document.getElementById('cancelGenerate').addEventListener('click', function() {
            document.getElementById('generateForm').classList.remove('active');
        });

        // Mostrar información del token encriptado
        document.querySelectorAll('.token-code-full').forEach(element => {
            element.addEventListener('click', function() {
                alert('Token Encriptado\n\nEste token está almacenado de forma segura en la base de datos. Para ver los detalles completos del token encriptado, haga clic en "Ver".');
            });
        });

        // Cerrar alerta de token generado
        function closeTokenAlert() {
            document.getElementById('tokenAlert').style.display = 'none';
        }

        // Copiar token al portapapeles
        function copyToken() {
            const tokenText = document.getElementById('tokenValue').textContent;
            navigator.clipboard.writeText(tokenText).then(function() {
                alert('Token copiado al portapapeles');
            }, function() {
                alert(' Error al copiar el token');
            });
        }

        // Validación del formulario
        document.querySelector('#generateForm form').addEventListener('submit', function(e) {
            const cliente = document.getElementById('id_cliente_api').value;
            
            if (!cliente) {
                e.preventDefault();
                alert('Por favor seleccione un cliente API');
                return;
            }

            const confirmacion = confirm('¿Está seguro de generar un nuevo token para este cliente?');
            if (!confirmacion) {
                e.preventDefault();
            }
        });

        // Auto-cerrar alerta después de 30 segundos
        setTimeout(function() {
            const tokenAlert = document.getElementById('tokenAlert');
            if (tokenAlert) {
                tokenAlert.style.display = 'none';
            }
        }, 30000);
    </script>
</body>
</html>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>