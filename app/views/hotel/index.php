<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoteles en Huanta</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        .btn-danger {
            background: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-1px);
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

        .btn-warning {
            background: var(--warning);
            color: white;
        }

        .btn-warning:hover {
            background: #d97706;
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

        /* Filtros */
        .filters {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .search-box {
            flex: 1;
            min-width: 300px;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 12px 16px 12px 40px;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            font-size: 14px;
            transition: var(--transition);
            background: var(--surface);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filter-label {
            font-weight: 500;
            color: var(--text-secondary);
            font-size: 14px;
        }

        .filter-select {
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            background: var(--surface);
            color: var(--text-primary);
            font-weight: 500;
            min-width: 120px;
            cursor: pointer;
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
        }

        td {
            padding: 15px;
            border-bottom: 1px solid var(--border);
            transition: var(--transition);
        }

        tr:hover td {
            background: #f8fafc;
        }

        .hotel-name {
            font-weight: 600;
            color: var(--primary);
            font-size: 15px;
            margin-bottom: 4px;
        }

        .hotel-id {
            font-size: 12px;
            color: var(--text-light);
        }

        .hotel-category {
            display: flex;
            gap: 2px;
            margin-bottom: 8px;
        }

        .star {
            color: #fbbf24;
            font-size: 14px;
        }

        .hotel-description {
            color: var(--text-secondary);
            font-size: 14px;
            line-height: 1.4;
        }

        .hotel-contact {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: var(--text-secondary);
        }

        .contact-item i {
            width: 14px;
            color: var(--primary);
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
            padding: 6px 10px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 11px;
            font-weight: 500;
            transition: var(--transition);
        }

        .action-view {
            background: #f0fdf4;
            color: var(--success);
            border: 1px solid #dcfce7;
        }

        .action-view:hover {
            background: #dcfce7;
        }

        .action-edit {
            background: #eff6ff;
            color: var(--primary);
            border: 1px solid #dbeafe;
        }

        .action-edit:hover {
            background: #dbeafe;
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

            .filters {
                flex-direction: column;
            }

            .search-box {
                min-width: 100%;
            }

            .filter-group {
                justify-content: space-between;
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
    <header>
        <div class="header-content">
            <h1 class="app-title"><i class="fas fa-hotel"></i> Sistema de Hoteles Huanta</h1>
            <div class="user-actions">
                <a href="index.php?controller=hotel&action=create" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Agregar Hotel
                </a>
                <a href="index.php?controller=auth&action=login" class="btn btn-danger">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>
            </div>
        </div>
    </header>
    
    <div class="container">
        <!-- Menú de Navegación -->
        <div class="nav-menu">
            <a href="index.php?controller=hotel&action=index" class="nav-btn active">
                <i class="fas fa-hotel"></i> Hoteles
            </a>
            <a href="index.php?controller=clientapi&action=index" class="nav-btn">
                <i class="fas fa-users"></i> Clientes API
            </a>
            <a href="index.php?controller=tokenapi&action=index" class="nav-btn">
                <i class="fas fa-key"></i> Tokens API
            </a>
            <a href="index.php?controller=countrequest&action=index" class="nav-btn">
                <i class="fas fa-chart-bar"></i> Estadísticas API
            </a>
        </div>

        <div class="filters">
            <div class="search-box">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Buscar hoteles...">
            </div>
            
            <div class="filter-group">
                <span class="filter-label">Categoría:</span>
                <select class="filter-select">
                    <option value="">Todas</option>
                    <option value="1">1 Estrella</option>
                    <option value="2">2 Estrellas</option>
                    <option value="3">3 Estrellas</option>
                    <option value="4">4 Estrellas</option>
                    <option value="5">5 Estrellas</option>
                </select>
            </div>
            
            <div class="filter-group">
                <span class="filter-label">Ordenar por:</span>
                <select class="filter-select">
                    <option value="name">Nombre</option>
                    <option value="category">Categoría</option>
                    <option value="district">Distrito</option>
                </select>
            </div>
        </div>
        
        <div class="main-card">
            <div class="card-header">
                <h2 class="card-title"><i class="fas fa-list"></i> Lista de Hoteles</h2>
                <span><?php echo count($hotels); ?> hoteles registrados</span>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Descripción</th>
                            <th>Ubicación</th>
                            <th>Contacto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($hotels)): ?>
                            <?php foreach ($hotels as $h): ?>
                            <tr>
                                <td>
                                    <div class="hotel-name"><?= $h['name'] ?></div>
                                    <div class="hotel-id">ID: <?= $h['id'] ?></div>
                                </td>
                                <td>
                                    <div class="hotel-category">
                                        <?php 
                                        $stars = isset($h['category']) ? $h['category'] : 0;
                                        for ($i = 0; $i < 5; $i++): 
                                        ?>
                                            <span class="star"><?= $i < $stars ? '★' : '☆' ?></span>
                                        <?php endfor; ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="hotel-description">
                                        <?= isset($h['description']) ? (strlen($h['description']) > 50 ? substr($h['description'], 0, 50) . '...' : $h['description']) : 'Sin descripción' ?>
                                    </div>
                                </td>
                                <td>
                                    <div><strong>Dirección:</strong> <?= $h['address'] ?></div>
                                    <div><strong>Distrito:</strong> <?= isset($h['district']) ? $h['district'] : 'N/A' ?></div>
                                    <div><strong>Provincia:</strong> <?= isset($h['province']) ? $h['province'] : 'N/A' ?></div>
                                </td>
                                <td>
                                    <div class="hotel-contact">
                                        <?php if (isset($h['phone'])): ?>
                                            <div class="contact-item">
                                                <i class="fas fa-phone"></i> <?= $h['phone'] ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (isset($h['email'])): ?>
                                            <div class="contact-item">
                                                <i class="fas fa-envelope"></i> <?= $h['email'] ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (isset($h['website'])): ?>
                                           
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="index.php?controller=hotel&action=view&id=<?= $h['id'] ?>" class="action-btn action-view">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        <a href="index.php?controller=hotel&action=edit&id=<?= $h['id'] ?>" class="action-btn action-edit">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <a href="index.php?controller=hotel&action=delete&id=<?= $h['id'] ?>" class="action-btn action-delete" onclick="return confirm('¿Estás seguro de que deseas eliminar este hotel?')">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="fas fa-hotel"></i>
                                        <p>No hay hoteles registrados</p>
                                        <a href="index.php?controller=hotel&action=create" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Agregar primer hotel
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Búsqueda en tiempo real
        const searchInput = document.querySelector('.search-input');
        const tableRows = document.querySelectorAll('tbody tr');
        
        searchInput.addEventListener('input', function() {
            const searchText = this.value.toLowerCase();
            
            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchText)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Filtrado por categoría
        const categoryFilter = document.querySelectorAll('.filter-select')[0];
        categoryFilter.addEventListener('change', function() {
            const value = this.value;
            
            tableRows.forEach(row => {
                if (!value) {
                    row.style.display = '';
                    return;
                }
                
                const starElements = row.querySelectorAll('.star');
                const filledStars = Array.from(starElements).filter(star => star.textContent === '★').length;
                
                if (value == filledStars) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Efectos hover
        document.querySelectorAll('.btn, .action-btn, .nav-btn').forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-1px)';
            });
            
            btn.addEventListener('mouseleave', function() {
                this.style.transform = '';
            });
        });

        // Navegación activa
        const currentPage = window.location.href;
        document.querySelectorAll('.nav-btn').forEach(btn => {
            if (btn.href === currentPage) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });

        // Confirmación para eliminar
        document.querySelectorAll('.action-delete').forEach(link => {
            link.addEventListener('click', function(e) {
                if (!confirm('¿Estás seguro de que deseas eliminar este hotel? Esta acción no se puede deshacer.')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>