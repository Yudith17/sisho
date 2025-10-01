<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoteles en Huanta</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

            .btn {
                padding: 8px 16px;
                font-size: 13px;
            }

            .card-header {
                padding: 15px;
            }

            .card-title {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <h1 class="app-title"><i class="fas fa-hotel"></i> Hoteles en Huanta</h1>
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
        <div class="filters">
            <div class="search-box">
                <i class="fas fa-search"></i>
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
        
        <div class="card">
            <div class="card-header">
                <h2 class="card-title"><i class="fas fa-list"></i> Lista de Hoteles</h2>
                <span><?php echo count($hotels); ?> hoteles registrados</span>
            </div>
            <div class="card-body">
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
                                <tr class="animate-on-scroll">
                                    <td>
                                        <div class="hotel-name"><?= $h['name'] ?></div>
                                        <small>ID: <?= $h['id'] ?></small>
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
                                        <div class="hotel-description" title="<?= isset($h['description']) ? $h['description'] : '' ?>">
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
                                                <div class="contact-item">
                                                    <i class="fas fa-globe"></i> 
                                                    <a href="<?= $h['website'] ?>" target="_blank">Sitio web</a>
                                                </div>
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
    </div>

    <script>
        // Smooth animations on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                }
            });
        }, observerOptions);

        // Observe all animation elements
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });

        // Enhanced table row animations
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach((row, index) => {
            row.style.animationDelay = `${index * 0.1}s`;
            row.classList.add('animate-on-scroll');
        });

        // Efecto de confirmación mejorado para eliminación
        document.querySelectorAll('.action-delete').forEach(link => {
            link.addEventListener('click', function(e) {
                // Add shake animation
                this.style.animation = 'shake 0.5s ease-in-out';
                
                if (!confirm('¿Estás seguro de que deseas eliminar este hotel? Esta acción no se puede deshacer.')) {
                    e.preventDefault();
                    // Reset animation
                    setTimeout(() => {
                        this.style.animation = '';
                    }, 500);
                }
            });
        });
        
        // Búsqueda en tiempo real mejorada
        const searchInput = document.querySelector('.search-input');
        let searchTimeout;
        
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const searchBox = this.parentElement;
            
            // Add loading state
            searchBox.style.background = 'rgba(99, 102, 241, 0.1)';
            
            searchTimeout = setTimeout(() => {
                const searchText = this.value.toLowerCase();
                let visibleCount = 0;
                
                tableRows.forEach((row, index) => {
                    const text = row.textContent.toLowerCase();
                    const shouldShow = text.includes(searchText);
                    
                    if (shouldShow) {
                        row.style.display = '';
                        row.style.animationDelay = `${visibleCount * 0.05}s`;
                        row.classList.add('animate-on-scroll');
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                        row.classList.remove('animate-on-scroll');
                    }
                });
                
                // Reset search box style
                searchBox.style.background = '';
                
                // Update results counter
                const counter = document.querySelector('.card-header span');
                if (counter) {
                    counter.textContent = `${visibleCount} hoteles encontrados`;
                    counter.style.animation = 'pulse 0.5s ease-in-out';
                    setTimeout(() => {
                        counter.style.animation = '';
                    }, 500);
                }
            }, 300);
        });
        
        // Filtrado por categoría mejorado
        const categoryFilter = document.querySelector('.filter-select');
        categoryFilter.addEventListener('change', function() {
            const value = this.value;
            let visibleCount = 0;
            
            // Add transition effect
            this.style.transform = 'scale(1.05)';
            setTimeout(() => {
                this.style.transform = '';
            }, 200);
            
            tableRows.forEach((row, index) => {
                const starElements = row.querySelectorAll('.star');
                const filledStars = Array.from(starElements).filter(star => star.textContent === '★').length;
                
                const shouldShow = !value || value == filledStars;
                
                if (shouldShow) {
                    row.style.display = '';
                    row.style.animationDelay = `${visibleCount * 0.05}s`;
                    row.classList.add('animate-on-scroll');
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                    row.classList.remove('animate-on-scroll');
                }
            });
            
            // Update results counter
            const counter = document.querySelector('.card-header span');
            if (counter) {
                counter.textContent = `${visibleCount} hoteles encontrados`;
                counter.style.animation = 'pulse 0.5s ease-in-out';
                setTimeout(() => {
                    counter.style.animation = '';
                }, 500);
            }
        });

        // Enhanced button hover effects
        document.querySelectorAll('.btn, .action-btn').forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px) scale(1.05)';
            });
            
            btn.addEventListener('mouseleave', function() {
                this.style.transform = '';
            });
        });

        // Parallax effect for header
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const header = document.querySelector('header');
            if (header) {
                header.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
        });

        // Add shake animation keyframes
        const style = document.createElement('style');
        style.textContent = `
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                10%, 30%, 50%, 70%, 90% { transform: translateX(-2px); }
                20%, 40%, 60%, 80% { transform: translateX(2px); }
            }
            
            @keyframes pulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.05); }
            }
        `;
        document.head.appendChild(style);

        // Initialize animations after page load
        window.addEventListener('load', () => {
            // Trigger initial animations
            document.querySelectorAll('.animate-on-scroll').forEach((el, index) => {
                setTimeout(() => {
                    el.classList.add('in-view');
                }, index * 100);
            });
        });

        // Add ripple effect to buttons
        document.querySelectorAll('.btn, .action-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    background: rgba(255, 255, 255, 0.3);
                    border-radius: 50%;
                    transform: scale(0);
                    animation: ripple 0.6s ease-out;
                    pointer-events: none;
                `;
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add ripple animation
        const rippleStyle = document.createElement('style');
        rippleStyle.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(2);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(rippleStyle);
    </script>
</body>
</html>