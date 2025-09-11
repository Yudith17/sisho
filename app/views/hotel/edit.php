<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Hotel - Sistema de Hoteles</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #64748b;
            --light: #f8fafc;
            --dark: #1e293b;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --border: #e2e8f0;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --hover-shadow: 0 10px 15px rgba(0, 0, 0, 0.15);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            color: var(--dark);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            flex: 1;
        }
        
        header {
            background: linear-gradient(120deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 20px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .app-title {
            font-size: 28px;
            font-weight: 700;
        }
        
        .user-actions {
            display: flex;
            gap: 15px;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--card-shadow);
        }
        
        .btn-secondary {
            background-color: var(--secondary);
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #475569;
            transform: translateY(-2px);
            box-shadow: var(--card-shadow);
        }
        
        .btn-danger {
            background-color: var(--danger);
            color: white;
        }
        
        .btn-danger:hover {
            background-color: #dc2626;
            transform: translateY(-2px);
            box-shadow: var(--card-shadow);
        }
        
        .card {
            background-color: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 30px;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }
        
        .card-header {
            padding: 20px;
            border-bottom: 1px solid var(--border);
            background: linear-gradient(120deg, #f8fafc 0%, #e2e8f0 100%);
        }
        
        .card-title {
            font-size: 22px;
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .card-body {
            padding: 30px;
        }
        
        .form-section {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px dashed var(--border);
        }
        
        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-group {
            flex: 1;
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .required::after {
            content: "*";
            color: var(--danger);
            margin-left: 4px;
        }
        
        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }
        
        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        
        .form-help {
            display: block;
            margin-top: 5px;
            font-size: 13px;
            color: var(--secondary);
        }
        
        .star-rating {
            display: flex;
            gap: 10px;
            margin-top: 5px;
        }
        
        .star {
            font-size: 24px;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s;
        }
        
        .star:hover,
        .star.active {
            color: #ffc107;
        }
        
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            padding-top: 20px;
            justify-content: center;
        }
        
        footer {
            background-color: var(--dark);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: auto;
        }
        
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .user-actions {
                justify-content: center;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }
            
            .form-actions {
                flex-direction: column;
            }
        }
        
        @media (max-width: 576px) {
            .btn {
                padding: 8px 15px;
                font-size: 13px;
            }
            
            .card-body {
                padding: 20px;
            }
            
            .app-title {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <h1 class="app-title"><i class="fas fa-hotel"></i> Hoteles en Huanta</h1>
            <div class="user-actions">
                <a href="index.php?controller=hotel&action=index" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver al Listado
                </a>
                <a href="index.php?controller=auth&action=logout" class="btn btn-danger">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>
            </div>
        </div>
    </header>
    
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title"><i class="fas fa-edit"></i> Editar Hotel</h2>
            </div>
            <div class="card-body">
                <form method="POST" id="hotelForm">
                    <!-- Información Básica -->
                    <div class="form-section">
                        <h3 class="section-title"><i class="fas fa-info-circle"></i> Información Básica</h3>
                        
                        <div class="form-group">
                            <label class="form-label required" for="name">
                                <i class="fas fa-signature"></i> Nombre del Hotel
                            </label>
                            <input type="text" id="name" name="name" class="form-input" placeholder="Ingrese el nombre del hotel" value="<?= htmlspecialchars($hotel['name']) ?>" required>
                            <span class="form-help">Ej: Grand Hotel Huanta</span>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label required" for="category">
                                <i class="fas fa-star"></i> Categoría / Estrellas
                            </label>
                            <div class="star-rating" id="starRating">
                                <span class="star" data-value="1">★</span>
                                <span class="star" data-value="2">★</span>
                                <span class="star" data-value="3">★</span>
                                <span class="star" data-value="4">★</span>
                                <span class="star" data-value="5">★</span>
                            </div>
                            <input type="hidden" id="category" name="category" value="<?= htmlspecialchars($hotel['category']) ?>" required>
                            <span class="form-help">Seleccione la categoría del hotel (1 a 5 estrellas)</span>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label required" for="description">
                                <i class="fas fa-align-left"></i> Descripción breve
                            </label>
                            <textarea id="description" name="description" class="form-textarea" placeholder="Describa brevemente el hotel y sus servicios" required><?= htmlspecialchars($hotel['description']) ?></textarea>
                            <span class="form-help">Máximo 250 caracteres</span>
                        </div>
                    </div>
                    
                    <!-- Ubicación -->
                    <div class="form-section">
                        <h3 class="section-title"><i class="fas fa-map-marker-alt"></i> Ubicación</h3>
                        
                        <div class="form-group">
                            <label class="form-label required" for="address">
                                <i class="fas fa-location-dot"></i> Dirección completa
                            </label>
                            <input type="text" id="address" name="address" class="form-input" placeholder="Ingrese la dirección completa" value="<?= htmlspecialchars($hotel['address']) ?>" required>
                            <span class="form-help">Ej: Av. Libertad 123, Huanta</span>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label required" for="district">
                                    <i class="fas fa-map"></i> Distrito
                                </label>
                                <input type="text" id="district" name="district" class="form-input" placeholder="Ej: Huanta" value="<?= htmlspecialchars($hotel['district']) ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label required" for="province">
                                    <i class="fas fa-map"></i> Provincia
                                </label>
                                <input type="text" id="province" name="province" class="form-input" placeholder="Ej: Huanta" value="<?= htmlspecialchars($hotel['province']) ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label required" for="department">
                                    <i class="fas fa-map"></i> Departamento
                                </label>
                                <input type="text" id="department" name="department" class="form-input" placeholder="Ej: Ayacucho" value="<?= htmlspecialchars($hotel['department']) ?>" required>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contacto -->
                    <div class="form-section">
                        <h3 class="section-title"><i class="fas fa-address-book"></i> Información de Contacto</h3>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label required" for="phone">
                                    <i class="fas fa-phone"></i> Teléfono principal
                                </label>
                                <input type="tel" id="phone" name="phone" class="form-input" placeholder="Ej: (066) 123456" value="<?= htmlspecialchars($hotel['phone']) ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label" for="email">
                                    <i class="fas fa-envelope"></i> Correo electrónico
                                </label>
                                <input type="email" id="email" name="email" class="form-input" placeholder="Ej: info@hotel.com" value="<?= htmlspecialchars($hotel['email']) ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="website">
                                <i class="fas fa-globe"></i> Página web
                            </label>
                            <input type="url" id="website" name="website" class="form-input" placeholder="Ej: https://www.mihotel.com" value="<?= htmlspecialchars($hotel['website']) ?>">
                            <span class="form-help">Incluya https:// en la dirección</span>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Actualizar Hotel
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            <i class="fas fa-undo"></i> Restablecer
                        </button>
                        <a href="index.php?controller=hotel&action=index" class="btn btn-danger">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <p>Sistema de Gestión de Hoteles en Huanta &copy; 2023</p>
    </footer>

    <script>
        // Sistema de calificación por estrellas
        const stars = document.querySelectorAll('.star');
        const categoryInput = document.getElementById('category');
        const initialCategory = <?= htmlspecialchars($hotel['category']) ?>;
        
        // Establecer estrellas iniciales
        stars.forEach(star => {
            const starValue = parseInt(star.getAttribute('data-value'));
            if (starValue <= initialCategory) {
                star.classList.add('active');
            }
        });
        
        stars.forEach(star => {
            star.addEventListener('click', () => {
                const value = parseInt(star.getAttribute('data-value'));
                categoryInput.value = value;
                
                stars.forEach(s => {
                    const starValue = parseInt(s.getAttribute('data-value'));
                    if (starValue <= value) {
                        s.classList.add('active');
                    } else {
                        s.classList.remove('active');
                    }
                });
            });
        });
        
        // Validación del formulario
        document.getElementById('hotelForm').addEventListener('submit', function(e) {
            let isValid = true;
            const requiredFields = document.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = 'var(--danger)';
                } else {
                    field.style.borderColor = '';
                }
            });
            
            // Validar email si está completado
            const emailField = document.getElementById('email');
            if (emailField.value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailField.value)) {
                isValid = false;
                emailField.style.borderColor = 'var(--danger)';
                alert('Por favor, ingrese un correo electrónico válido.');
            }
            
            // Validar URL del sitio web si está completado
            const websiteField = document.getElementById('website');
            if (websiteField.value && !/^https?:\/\/.+/.test(websiteField.value)) {
                isValid = false;
                websiteField.style.borderColor = 'var(--danger)';
                alert('La página web debe comenzar con http:// o https://');
            }
            
            if (!isValid) {
                e.preventDefault();
                alert('Por favor, complete todos los campos obligatorios correctamente.');
            } else {
                // Si todo está bien, el formulario se enviará
                alert('¡Hotel actualizado correctamente!');
            }
        });
        
        // Limpiar estilos de error al enfocar un campo
        document.querySelectorAll('input, textarea').forEach(field => {
            field.addEventListener('focus', () => {
                field.style.borderColor = '';
            });
        });
        
        // Contador de caracteres para la descripción
        const descriptionField = document.getElementById('description');
        const charCount = document.createElement('div');
        charCount.className = 'form-help';
        charCount.style.marginTop = '5px';
        descriptionField.parentNode.appendChild(charCount);
        
        function updateCharCount() {
            const length = descriptionField.value.length;
            charCount.textContent = `${length}/250 caracteres`;
            
            if (length > 250) {
                charCount.style.color = 'var(--danger)';
            } else {
                charCount.style.color = 'var(--secondary)';
            }
        }
        
        descriptionField.addEventListener('input', updateCharCount);
        updateCharCount(); // Inicializar contador
    </script>
</body>
</html>