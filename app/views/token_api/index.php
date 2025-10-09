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
                                        <a href="index.php?controller=tokenapi&action=create" class="btn btn-success">
                                            <i>➕</i>
                                            Generar Primer Token
                                        </a>
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
                                    <div class="token-code" title="<?= htmlspecialchars($token['token'] ?? '') ?>">
                                        <?= htmlspecialchars(substr($token['token'] ?? '', 0, 20) . '...') ?>
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
        // Mostrar token completo al hacer click
        document.querySelectorAll('.token-code').forEach(element => {
            element.addEventListener('click', function() {
                const fullToken = this.getAttribute('title');
                if (fullToken && fullToken !== '') {
                    alert('Token completo:\n\n' + fullToken);
                }
            });
        });
    </script>
</body>
</html>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>