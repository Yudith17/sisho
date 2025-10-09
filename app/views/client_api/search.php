<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar - <?= htmlspecialchars($client['razon_social'] ?? 'Cliente') ?> - SISHO</title>
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

        .btn-back {
            background: var(--surface);
            color: var(--text-primary);
            text-decoration: none;
            padding: 10px 20px;
            border-radius: var(--radius);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            border: 1px solid var(--border);
            transition: var(--transition);
        }

        .btn-back:hover {
            background: var(--primary-light);
            border-color: var(--primary);
            transform: translateX(-5px);
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

        .card-content {
            padding: 20px;
        }

        /* Info del Cliente */
        .client-info {
            background: var(--primary-light);
            padding: 15px 20px;
            border-radius: var(--radius);
            margin-bottom: 20px;
            border-left: 4px solid var(--primary);
        }

        .client-info strong {
            color: var(--primary);
        }

        /* Grid de Estadísticas */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }

        .stat-card {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 20px;
            border-radius: var(--radius);
            text-align: center;
            box-shadow: var(--shadow-lg);
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 0.85rem;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Lista de Tokens */
        .token-list {
            display: grid;
            gap: 15px;
            margin: 20px 0;
        }

        .token-item {
            background: var(--surface);
            padding: 20px;
            border-radius: var(--radius);
            border-left: 4px solid var(--success);
            box-shadow: var(--shadow);
            transition: var(--transition);
            border: 1px solid var(--border);
        }

        .token-item:hover {
            transform: translateX(5px);
            box-shadow: var(--shadow-lg);
        }

        .token-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .token-code {
            background: #f8fafc;
            padding: 12px 15px;
            border-radius: var(--radius);
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            border: 1px dashed var(--border);
            word-break: break-all;
            cursor: pointer;
            transition: var(--transition);
        }

        .token-code:hover {
            background: var(--primary-light);
            border-color: var(--primary);
        }

        .token-meta {
            font-size: 0.85rem;
            color: var(--text-secondary);
            margin-top: 10px;
        }

        /* Badges */
        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
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

        .badge-primary {
            background: #eff6ff;
            color: var(--primary);
            border: 1px solid #dbeafe;
        }

        .badge-info {
            background: #f8fafc;
            color: var(--secondary);
            border: 1px solid var(--border);
        }

        /* Historial */
        .history-list {
            display: grid;
            gap: 10px;
            margin: 20px 0;
        }

        .history-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 15px;
            background: var(--surface);
            border-radius: var(--radius);
            border: 1px solid var(--border);
            transition: var(--transition);
        }

        .history-item:hover {
            background: #f8fafc;
        }

        .history-type {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .history-date {
            color: var(--text-secondary);
            font-size: 0.85rem;
        }

        /* Estado vacío */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-secondary);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: var(--text-light);
        }

        .empty-state h3 {
            font-size: 1.25rem;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .empty-state p {
            font-size: 0.95rem;
            margin-bottom: 20px;
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

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .token-header {
                flex-direction: column;
                gap: 10px;
            }

            .history-item {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }

            .history-date {
                align-self: flex-end;
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
                <i>🔍</i>
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
            <a href="index.php?controller=tokenapi&action=index" class="nav-btn">
                <i>🔑</i>
                Tokens API
            </a>
            <a href="index.php?controller=countrequest&action=index" class="nav-btn">
                <i>📊</i>
                Estadísticas
            </a>
        </nav>

        <!-- Botón Volver -->
        <a href="index.php?controller=clientapi&action=index" class="btn-back">
            <i>←</i>
            Volver a Clientes
        </a>

        <!-- Card Principal -->
        <div class="main-card">
            <div class="card-header">
                <div class="card-title">
                    <i>🔍</i>
                    Buscar - <?= htmlspecialchars($client['razon_social'] ?? 'Cliente') ?>
                </div>
            </div>

            <div class="card-content">
                <!-- Información del Cliente -->
                <div class="client-info">
                    <strong>RUC:</strong> <?= htmlspecialchars($client['ruc'] ?? '') ?> | 
                    <strong>Email:</strong> <?= htmlspecialchars($client['correo'] ?? '') ?> | 
                    <strong>Teléfono:</strong> <?= htmlspecialchars($client['telefono'] ?? '') ?> | 
                    <strong>Estado:</strong> 
                    <span class="badge <?= ($client['estado'] ?? '') === 'activo' ? 'badge-success' : 'badge-danger' ?>">
                        <?= ucfirst($client['estado'] ?? 'desconocido') ?>
                    </span>
                </div>

                <!-- Estadísticas de Uso -->
                <div class="card-header">
                    <div class="card-title">
                        <i>📊</i>
                        Estadísticas de Uso
                    </div>
                </div>

                <?php if (!empty($stats) && ($stats['total_requests'] ?? 0) > 0): ?>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-number"><?= $stats['total_requests'] ?? 0 ?></div>
                            <div class="stat-label">Total Requests</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number"><?= $stats['search_requests'] ?? 0 ?></div>
                            <div class="stat-label">Búsquedas</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number"><?= $stats['view_requests'] ?? 0 ?></div>
                            <div class="stat-label">Vistas</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">
                                <?= !empty($stats['last_request']) ? '✅' : '⏳' ?>
                            </div>
                            <div class="stat-label">
                                <?= !empty($stats['last_request']) ? 
                                    date('d/m/Y H:i', strtotime($stats['last_request'])) : 
                                    'Sin actividad' ?>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <i>📭</i>
                        <h3>Sin actividad registrada</h3>
                        <p>Este cliente aún no ha realizado solicitudes a la API</p>
                    </div>
                <?php endif; ?>

                <!-- Tokens del Cliente -->
                <div class="card-header">
                    <div class="card-title">
                        <i>🔑</i>
                        Tokens del Cliente
                    </div>
                </div>

                <?php if (!empty($tokens)): ?>
                    <div class="token-list">
                        <?php foreach ($tokens as $token): ?>
                            <div class="token-item">
                                <div class="token-header">
                                    <div style="flex: 1;">
                                        <strong>Token API:</strong>
                                        <div class="token-code" onclick="alert('Token completo:\\n\\n<?= htmlspecialchars($token['token'] ?? '') ?>')">
                                            <?= htmlspecialchars($token['token'] ?? 'No disponible') ?>
                                        </div>
                                    </div>
                                    <span class="badge <?= ($token['estado'] ?? 0) == 1 ? 'badge-success' : 'badge-danger' ?>">
                                        <?= ($token['estado'] ?? 0) == 1 ? 'Activo' : 'Inactivo' ?>
                                    </span>
                                </div>
                                <?php if (!empty($token['fecha_registro'])): ?>
                                    <div class="token-meta">
                                        <strong>Registrado:</strong> 
                                        <?= date('d/m/Y H:i', strtotime($token['fecha_registro'])) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <i>🔐</i>
                        <h3>No hay tokens registrados</h3>
                        <p>Este cliente no tiene tokens de API generados</p>
                    </div>
                <?php endif; ?>

                <!-- Historial de Requests -->
                <?php if (!empty($requests)): ?>
                    <div class="card-header">
                        <div class="card-title">
                            <i>📝</i>
                            Historial Reciente
                        </div>
                    </div>
                    <div class="history-list">
                        <?php foreach (array_slice($requests, 0, 10) as $request): ?>
                            <div class="history-item">
                                <div class="history-type">
                                    <span class="badge <?= ($request['Tipo'] ?? '') === 'search' ? 'badge-primary' : 'badge-info' ?>">
                                        <?= ucfirst($request['Tipo'] ?? 'desconocido') ?>
                                    </span>
                                </div>
                                <div class="history-date">
                                    <?= !empty($request['fecha']) ? date('d/m/Y H:i', strtotime($request['fecha'])) : 'Fecha no disponible' ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>