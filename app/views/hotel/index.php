<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoteles en Huanta</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #a5b4fc;
            --secondary: #64748b;
            --accent: #06b6d4;
            --accent-dark: #0891b2;
            --background: #0f172a;
            --surface: #1e293b;
            --surface-light: #334155;
            --card-bg: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-light: #94a3b8;
            --success: #10b981;
            --success-light: #d1fae5;
            --danger: #ef4444;
            --danger-light: #fee2e2;
            --warning: #f59e0b;
            --warning-light: #fef3c7;
            --border: #e2e8f0;
            --border-light: #f1f5f9;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-accent: linear-gradient(135deg, #667eea 0%, #06b6d4 100%);
            --gradient-surface: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            --border-radius: 12px;
            --border-radius-lg: 16px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-fast: all 0.15s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 50%, #cbd5e1 100%);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.2) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 24px;
            position: relative;
        }
        
        header {
            background: var(--gradient-primary);
            background-size: 400% 400%;
            animation: gradientShift 8s ease infinite;
            color: white;
            padding: 32px 0;
            box-shadow: var(--shadow-xl);
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }
        
        header::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 200%;
            height: 100%;
            background: linear-gradient(90deg, 
                transparent 0%, 
                rgba(255, 255, 255, 0.1) 50%, 
                transparent 100%);
            animation: shimmer 3s ease-in-out infinite;
        }
        
        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 24px;
            position: relative;
            z-index: 1;
        }
        
        .app-title {
            font-family: 'Outfit', sans-serif;
            font-size: 32px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 16px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 0.8s ease-out;
        }
        
        .app-title i {
            font-size: 36px;
            animation: pulse 2s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        .user-actions {
            display: flex;
            gap: 16px;
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 24px;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: var(--transition);
        }
        
        .btn:hover::before {
            left: 100%;
        }
        
        .btn-primary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .btn-primary:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px) scale(1.05);
            box-shadow: var(--shadow-lg);
        }
        
        .btn-danger {
            background: rgba(239, 68, 68, 0.9);
            color: white;
        }
        
        .btn-danger:hover {
            background: rgba(220, 38, 38, 1);
            transform: translateY(-2px) scale(1.05);
            box-shadow: var(--shadow-lg);
        }
        
        .btn-success {
            background: rgba(16, 185, 129, 0.9);
            color: white;
        }
        
        .btn-success:hover {
            background: rgba(5, 150, 105, 1);
            transform: translateY(-2px) scale(1.05);
            box-shadow: var(--shadow-lg);
        }
        
        .card {
            background: var(--gradient-surface);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: var(--transition);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            animation: fadeInUp 0.8s ease-out 0.4s both;
            position: relative;
        }
        
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--gradient-accent);
        }
        
        .card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
            border-color: rgba(255, 255, 255, 0.4);
        }
        
        .card-header {
            padding: 32px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(248, 250, 252, 0.9) 100%);
            position: relative;
            overflow: hidden;
        }
        
        .card-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--primary-light), transparent);
        }
        
        .card-title {
            font-family: 'Outfit', sans-serif;
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .card-title i {
            color: var(--primary);
            animation: rotateIn 0.8s ease-out;
        }
        
        @keyframes rotateIn {
            0% { transform: rotate(-180deg) scale(0); opacity: 0; }
            100% { transform: rotate(0deg) scale(1); opacity: 1; }
        }
        
        .card-body {
            padding: 0;
        }
        
        .filters {
            display: flex;
            gap: 20px;
            margin-bottom: 32px;
            flex-wrap: wrap;
            animation: fadeInUp 0.8s ease-out 0.6s both;
        }
        
        .filter-group {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.8);
            padding: 16px 20px;
            border-radius: var(--border-radius);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: var(--transition);
        }
        
        .filter-group:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
            background: rgba(255, 255, 255, 0.9);
        }
        
        .filter-label {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .filter-select {
            padding: 10px 16px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: white;
            color: var(--text-primary);
            font-weight: 500;
            transition: var(--transition);
            min-width: 120px;
        }
        
        .filter-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        
        .search-box {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: var(--border-radius);
            padding: 16px 20px;
            flex: 1;
            max-width: 400px;
            backdrop-filter: blur(10px);
            transition: var(--transition);
            position: relative;
        }
        
        .search-box:focus-within {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary);
        }
        
        .search-box i {
            color: var(--primary);
            margin-right: 12px;
            font-size: 16px;
        }
        
        .search-input {
            padding: 0;
            border: none;
            outline: none;
            width: 100%;
            background: transparent;
            color: var(--text-primary);
            font-weight: 500;
            font-size: 14px;
        }
        
        .search-input::placeholder {
            color: var(--text-light);
        }
        
        .table-container {
            overflow-x: auto;
            position: relative;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 20px 24px;
            text-align: left;
            border-bottom: 1px solid var(--border-light);
            transition: var(--transition-fast);
        }
        
        th {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            font-weight: 700;
            color: var(--text-primary);
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 1px;
            position: relative;
        }
        
        th::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--gradient-accent);
        }
        
        tr {
            transition: var(--transition-fast);
            position: relative;
        }
        
        tr::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--primary);
            transform: scaleY(0);
            transition: var(--transition);
        }
        
        tr:hover::before {
            transform: scaleY(1);
        }
        
        tr:hover {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.03) 0%, rgba(6, 182, 212, 0.03) 100%);
            transform: translateX(8px);
        }
        
        tr:last-child td {
            border-bottom: none;
        }
        
        .hotel-name {
            font-weight: 700;
            color: var(--primary);
            font-size: 16px;
            margin-bottom: 4px;
        }
        
        .hotel-category {
            display: flex;
            gap: 2px;
            align-items: center;
        }
        
        .star {
            color: #fbbf24;
            font-size: 16px;
            transition: var(--transition-fast);
            filter: drop-shadow(0 1px 2px rgba(251, 191, 36, 0.3));
        }
        
        .star:hover {
            transform: scale(1.2);
        }
        
        .hotel-description {
            max-width: 280px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: var(--text-secondary);
            font-size: 14px;
            line-height: 1.5;
        }
        
        .hotel-contact {
            display: flex;
            flex-direction: column;
            gap: 8px;
            font-size: 14px;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-secondary);
            transition: var(--transition-fast);
        }
        
        .contact-item:hover {
            color: var(--primary);
            transform: translateX(4px);
        }
        
        .contact-item i {
            width: 16px;
            text-align: center;
            color: var(--primary);
        }
        
        .actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        
        .action-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }
        
        .action-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: var(--transition);
        }
        
        .action-btn:hover::before {
            left: 100%;
        }
        
        .action-edit {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            color: var(--primary);
            border: 1px solid rgba(99, 102, 241, 0.2);
        }
        
        .action-edit:hover {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            transform: translateY(-2px) scale(1.05);
            box-shadow: var(--shadow);
        }
        
        .action-delete {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            color: var(--danger);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }
        
        .action-delete:hover {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            transform: translateY(-2px) scale(1.05);
            box-shadow: var(--shadow);
        }
        
        .action-view {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            color: var(--success);
            border: 1px solid rgba(16, 185, 129, 0.2);
        }
        
        .action-view:hover {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            transform: translateY(-2px) scale(1.05);
            box-shadow: var(--shadow);
        }
        
        .empty-state {
            text-align: center;
            padding: 64px 32px;
            color: var(--text-secondary);
            animation: fadeInUp 1s ease-out;
        }
        
        .empty-state i {
            font-size: 64px;
            margin-bottom: 24px;
            color: var(--text-light);
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .empty-state p {
            font-size: 18px;
            margin-bottom: 32px;
            font-weight: 500;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Loading animation */
        @keyframes skeleton {
            0% { background-position: -200px 0; }
            100% { background-position: calc(200px + 100%) 0; }
        }
        
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200px 100%;
            animation: skeleton 1.5s ease-in-out infinite;
        }
        
        /* Responsive Design */
        @media (max-width: 1024px) {
            .container {
                padding: 20px;
            }
            
            .header-content {
                padding: 0 20px;
            }
        }
        
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }
            
            .app-title {
                font-size: 28px;
            }
            
            .user-actions {
                justify-content: center;
                flex-wrap: wrap;
            }
            
            .btn {
                padding: 12px 20px;
                font-size: 13px;
            }
            
            .filters {
                flex-direction: column;
                align-items: stretch;
                gap: 16px;
            }
            
            .search-box {
                max-width: 100%;
            }
            
            .filter-group {
                justify-content: space-between;
            }
            
            th, td {
                padding: 16px 12px;
                font-size: 14px;
            }
            
            .actions {
                flex-direction: column;
                gap: 8px;
            }
            
            .action-btn {
                justify-content: center;
                padding: 12px 16px;
            }
            
            .card-header {
                padding: 24px 20px;
                flex-direction: column;
                gap: 16px;
                align-items: flex-start;
                text-align: left;
            }
            
            .card-title {
                font-size: 20px;
            }
        }
        
        @media (max-width: 576px) {
            .container {
                padding: 16px;
            }
            
            header {
                padding: 24px 0;
            }
            
            .app-title {
                font-size: 24px;
                flex-direction: column;
                gap: 8px;
                text-align: center;
            }
            
            .app-title i {
                font-size: 32px;
            }
            
            .btn {
                padding: 10px 16px;
                font-size: 12px;
            }
            
            .card-header {
                padding: 20px 16px;
            }
            
            .hotel-description {
                max-width: 200px;
            }
            
            th, td {
                padding: 12px 8px;
                font-size: 13px;
            }
            
            .table-container {
                font-size: 12px;
            }
        }
        
        /* Dark mode media query */
        @media (prefers-color-scheme: dark) {
            :root {
                --card-bg: #1e293b;
                --text-primary: #f1f5f9;
                --text-secondary: #94a3b8;
                --border: rgba(236, 72, 153, 0.3);
                --border-light: rgba(249, 168, 212, 0.2);
            }
            
            body {
                background: linear-gradient(135deg, #0f172a 0%, #1e293b 25%, #334155 50%, #475569 75%, #64748b 100%);
            }
            
            .card {
                background: linear-gradient(135deg, rgba(30, 41, 59, 0.9) 0%, rgba(51, 65, 85, 0.9) 50%, rgba(71, 85, 105, 0.9) 100%);
                border-color: rgba(236, 72, 153, 0.3);
            }
            
            .card-header {
                background: linear-gradient(135deg, rgba(30, 41, 59, 0.95) 0%, rgba(51, 65, 85, 0.95) 100%);
            }
            
            th {
                background: linear-gradient(135deg, rgba(30, 41, 59, 0.9) 0%, rgba(51, 65, 85, 0.9) 100%);
                color: var(--text-primary);
            }
            
            .filter-group {
                background: linear-gradient(135deg, rgba(30, 41, 59, 0.9) 0%, rgba(51, 65, 85, 0.9) 100%);
                border-color: rgba(236, 72, 153, 0.3);
            }
            
            .search-box {
                background: linear-gradient(135deg, rgba(30, 41, 59, 0.95) 0%, rgba(51, 65, 85, 0.95) 100%);
                border-color: rgba(236, 72, 153, 0.4);
            }
            
            .table-container {
                background: linear-gradient(135deg, rgba(30, 41, 59, 0.8) 0%, rgba(51, 65, 85, 0.8) 100%);
            }
        }
        
        /* Scroll animations */
        @media (prefers-reduced-motion: no-preference) {
            .animate-on-scroll {
                opacity: 0;
                transform: translateY(20px);
                transition: var(--transition);
            }
            
            .animate-on-scroll.in-view {
                opacity: 1;
                transform: translateY(0);
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