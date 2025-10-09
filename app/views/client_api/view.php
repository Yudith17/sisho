<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Cliente API - Sistema de Hoteles</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3498db;
            --primary-dark: #2980b9;
            --secondary: #6c757d;
            --success: #27ae60;
            --light: #f8f9fa;
            --dark: #343a40;
            --white: #ffffff;
            --gray: #6c757d;
            --gray-light: #e9ecef;
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 20px;
            color: #333;
        }

        .main-card {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            max-width: 900px;
            margin: 0 auto;
            transition: var(--transition);
        }

        .main-card:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--white);
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-title i {
            font-size: 1.3rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            font-size: 0.95rem;
        }

        .btn-secondary {
            background-color: var(--secondary);
            color: var(--white);
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 30px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            padding: 15px;
            background-color: var(--light);
            border-radius: var(--border-radius);
            transition: var(--transition);
            border-left: 4px solid var(--primary);
        }

        .info-item:hover {
            background-color: #e9ecef;
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .info-item label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        .info-item span {
            color: var(--gray);
            font-size: 1rem;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-success {
            background-color: rgba(39, 174, 96, 0.15);
            color: var(--success);
            border: 1px solid rgba(39, 174, 96, 0.3);
        }

        .badge-secondary {
            background-color: rgba(108, 117, 125, 0.15);
            color: var(--secondary);
            border: 1px solid rgba(108, 117, 125, 0.3);
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--gray-light);
        }

        .btn-primary {
            background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
            color: var(--white);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(155, 89, 182, 0.3);
        }

        .mt-4 {
            margin-top: 1.5rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .actions {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .card-body {
                padding: 20px;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="main-card">
        <div class="card-header">
            <h2 class="card-title"><i class="fas fa-eye"></i> Detalles del Cliente API</h2>
            <div>
                <a href="index.php?controller=clientapi&action=index" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="info-grid">
                <div class="info-item">
                    <label>ID:</label>
                    <span>8</span>
                </div>
                <div class="info-item">
                    <label>RUC:</label>
                    <span>26353678923</span>
                </div>
                <div class="info-item">
                    <label>Razón Social:</label>
                    <span>Imperio EIRL</span>
                </div>
                <div class="info-item">
                    <label>Teléfono:</label>
                    <span>987878754</span>
                </div>
                <div class="info-item">
                    <label>Correo:</label>
                    <span>imperio17@gmail.com</span>
                </div>
                <div class="info-item">
                    <label>Fecha Registro:</label>
                    <span>03/10/2025 09:28</span>
                </div>
                <div class="info-item">
                    <label>Estado:</label>
                    <span class="badge badge-success">Activo</span>
                </div>
            </div>

            <div class="actions mt-4">
                <a href="index.php?controller=clientapi&action=search&id=8" class="btn btn-primary">
                    <i class="fas fa-search"></i> Ver Búsquedas
                </a>
            </div>
        </div>
    </div>
</body>
</html>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>