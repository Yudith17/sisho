<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISHO - Buscar Hoteles</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        .header {
            background: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
        }
        
        .header h1 {
            font-size: 2em;
            margin-bottom: 5px;
        }
        
        /* Filtros de Búsqueda */
        .search-filters {
            background: #ecf0f1;
            padding: 20px;
            border-bottom: 1px solid #bdc3c7;
        }
        
        .filter-group {
            display: flex;
            gap: 15px;
            align-items: end;
            flex-wrap: wrap;
        }
        
        .filter-item {
            flex: 1;
            min-width: 200px;
        }
        
        .filter-item label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #2c3e50;
        }
        
        .search-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #bdc3c7;
            border-radius: 4px;
            font-size: 14px;
        }
        
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s;
        }
        
        .btn-primary {
            background: #3498db;
            color: white;
        }
        
        .btn-primary:hover {
            background: #2980b9;
        }
        
        .btn-secondary {
            background: #95a5a6;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #7f8c8d;
        }
        
        /* Resultados */
        .results-section {
            padding: 20px;
        }
        
        .results-header {
            margin-bottom: 15px;
            color: #2c3e50;
            font-size: 1.1em;
        }
        
        .table-container {
            overflow-x: auto;
        }
        
        .hotels-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }
        
        .hotels-table th {
            background: #34495e;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: bold;
        }
        
        .hotels-table td {
            padding: 12px;
            border-bottom: 1px solid #ecf0f1;
        }
        
        .hotels-table tr:hover {
            background: #f8f9fa;
        }
        
        .status-active {
            background: #27ae60;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            display: inline-block;
        }
        
        .status-inactive {
            background: #e74c3c;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            display: inline-block;
        }
        
        .action-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin: 0 2px;
        }
        
        .action-btn.view {
            color: #3498db;
        }
        
        .action-btn.edit {
            color: #f39c12;
        }
        
        .action-btn.delete {
            color: #e74c3c;
        }
        
        .loading {
            text-align: center;
            padding: 40px;
            color: #7f8c8d;
        }
        
        .error {
            background: #e74c3c;
            color: white;
            padding: 15px;
            border-radius: 4px;
            margin: 10px 0;
        }
        
        .no-results {
            text-align: center;
            padding: 40px;
            color: #7f8c8d;
            font-style: italic;
        }
        
        .pagination {
            margin-top: 20px;
            text-align: center;
        }
        
        @media (max-width: 768px) {
            .filter-group {
                flex-direction: column;
            }
            
            .filter-item {
                min-width: 100%;
            }
            
            .hotels-table {
                font-size: 14px;
            }
            
            .hotels-table th,
            .hotels-table td {
                padding: 8px 4px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔍 SISHO - Buscador de Hoteles</h1>
            <p>Encuentra los mejores hoteles y hospedajes</p>
        </div>
        
        <!-- Filtros de Búsqueda -->
        <div class="search-filters">
            <div class="filter-group">
                <div class="filter-item">
                    <label for="searchInput">Nombre del Hotel:</label>
                    <input type="text" 
                           id="searchInput" 
                           class="search-input" 
                           placeholder="Ingrese nombre del hotel...">
                </div>
                
                <div class="filter-item">
                    <label for="categoryFilter">Categoría:</label>
                    <select id="categoryFilter" class="search-input">
                        <option value="">Todas las categorías</option>
                        <option value="1★">1★</option>
                        <option value="2★">2★</option>
                        <option value="3★">3★</option>
                        <option value="4★">4★</option>
                        <option value="5★">5★</option>
                    </select>
                </div>
                
                <div class="filter-item">
                    <label for="locationFilter">Ubicación:</label>
                    <input type="text" 
                           id="locationFilter" 
                           class="search-input" 
                           placeholder="Distrito, provincia...">
                </div>
                
                <div class="filter-item">
                    <button type="button" id="searchBtn" class="btn btn-primary">
                        🔍 Buscar
                    </button>
                    <button type="button" id="resetBtn" class="btn btn-secondary">
                        🗑️ Limpiar
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Resultados de Búsqueda -->
        <div class="results-section">
            <div class="results-header" id="resultsHeader">
                Ingrese criterios de búsqueda para mostrar resultados
            </div>
            
            <div class="table-container">
                <table class="hotels-table" id="hotelsTable" style="display: none;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre del Hotel</th>
                            <th>Categoría</th>
                            <th>Ubicación</th>
                            <th>Contacto</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="hotelsTableBody">
                        <!-- Los resultados se cargan aquí dinámicamente -->
                    </tbody>
                </table>
                
                <div id="loadingMessage" class="loading" style="display: none;">
                    Buscando hoteles...
                </div>
                
                <div id="noResultsMessage" class="no-results" style="display: none;">
                    No se encontraron hoteles que coincidan con la búsqueda
                </div>
                
                <div id="errorMessage" class="error" style="display: none;">
                    Error al cargar los datos
                </div>
            </div>
            
            <div class="pagination" id="pagination" style="display: none;">
                <!-- Paginación se cargará aquí -->
            </div>
        </div>
    </div>

    <script src="../public/js/api-search.js"></script>
</body>
</html>