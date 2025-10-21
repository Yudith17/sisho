class HotelSearch {
    constructor() {
        this.apiBaseUrl = '../api/public/index.php';
        this.currentPage = 1;
        this.itemsPerPage = 10;
        this.currentResults = [];
        this.init();
    }
    
    init() {
        // Event listeners
        document.getElementById('searchBtn').addEventListener('click', () => this.searchHotels());
        document.getElementById('resetBtn').addEventListener('click', () => this.resetSearch());
        document.getElementById('searchInput').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') this.searchHotels();
        });
        document.getElementById('locationFilter').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') this.searchHotels();
        });
        
        // Cargar hoteles al inicio
        this.loadInitialHotels();
    }
    
    async loadInitialHotels() {
        this.showLoading();
        
        try {
            const response = await fetch(`${this.apiBaseUrl}?action=search`);
            const data = await response.json();
            
            if (data.success && data.data.length > 0) {
                this.currentResults = data.data;
                this.displayResults(this.currentResults);
                this.updateResultsHeader(data.data.length);
            } else {
                this.showNoResults();
            }
        } catch (error) {
            this.showError('Error cargando hoteles: ' + error.message);
        }
    }
    
    async searchHotels() {
        const query = document.getElementById('searchInput').value.trim();
        const category = document.getElementById('categoryFilter').value;
        const location = document.getElementById('locationFilter').value.trim();
        
        this.showLoading();
        
        try {
            let url = `${this.apiBaseUrl}?action=search`;
            let params = [];
            
            if (query) params.push(`q=${encodeURIComponent(query)}`);
            if (category) params.push(`category=${encodeURIComponent(category)}`);
            if (location) params.push(`location=${encodeURIComponent(location)}`);
            
            if (params.length > 0) {
                url += '&' + params.join('&');
            }
                
            const response = await fetch(url);
            const data = await response.json();
            
            if (data.success) {
                this.currentResults = data.data;
                this.displayResults(this.currentResults);
                this.updateResultsHeader(data.data.length);
            } else {
                this.showError(data.error || 'Error en la búsqueda');
            }
        } catch (error) {
            this.showError('Error de conexión: ' + error.message);
        }
    }
    
    displayResults(hotels) {
        const tableBody = document.getElementById('hotelsTableBody');
        const table = document.getElementById('hotelsTable');
        const noResults = document.getElementById('noResultsMessage');
        const loading = document.getElementById('loadingMessage');
        const error = document.getElementById('errorMessage');
        
        // Ocultar todos los mensajes primero
        loading.style.display = 'none';
        error.style.display = 'none';
        noResults.style.display = 'none';
        
        if (!hotels || hotels.length === 0) {
            table.style.display = 'none';
            noResults.style.display = 'block';
            return;
        }
        
        // Mostrar tabla
        table.style.display = 'table';
        
        // Generar filas de la tabla
        tableBody.innerHTML = hotels.map((hotel, index) => `
            <tr>
                <td>${index + 1}</td>
                <td>
                    <strong>${this.escapeHtml(hotel.name)}</strong>
                    ${hotel.description ? `<br><small style="color: #666;">${this.truncateText(this.escapeHtml(hotel.description), 50)}</small>` : ''}
                </td>
                <td>${this.escapeHtml(hotel.category)}</td>
                <td>
                    ${this.escapeHtml(hotel.address)}<br>
                    <small style="color: #666;">
                        ${this.escapeHtml(hotel.district)} - ${this.escapeHtml(hotel.province)} - ${this.escapeHtml(hotel.department)}
                    </small>
                </td>
                <td>
                    ${hotel.phone ? `📞 ${this.escapeHtml(hotel.phone)}<br>` : ''}
                    ${hotel.email ? `📧 ${this.escapeHtml(hotel.email)}` : ''}
                </td>
                <td>
                    <span class="status-active">ACTIVO</span>
                </td>
                <td>
                    <button class="action-btn view" title="Ver detalles" onclick="hotelSearch.viewHotel(${hotel.id})">
                        👁️
                    </button>
                    <button class="action-btn edit" title="Ver en mapa" onclick="hotelSearch.viewOnMap(${hotel.id})">
                        📍
                    </button>
                </td>
            </tr>
        `).join('');
    }
    
    updateResultsHeader(count) {
        const header = document.getElementById('resultsHeader');
        if (count === 0) {
            header.textContent = 'No se encontraron resultados';
        } else {
            header.textContent = `Mostrando ${count} de un total de ${count} registros`;
        }
    }
    
    resetSearch() {
        document.getElementById('searchInput').value = '';
        document.getElementById('categoryFilter').value = '';
        document.getElementById('locationFilter').value = '';
        this.loadInitialHotels();
    }
    
    viewHotel(hotelId) {
        // Aquí puedes implementar la vista detallada del hotel
        alert(`Ver detalles del hotel ID: ${hotelId}`);
        // window.location.href = `view.php?id=${hotelId}`;
    }
    
    viewOnMap(hotelId) {
        // Aquí puedes implementar la vista en mapa
        alert(`Ver hotel en mapa ID: ${hotelId}`);
        // window.location.href = `map.php?id=${hotelId}`;
    }
    
    showLoading() {
        document.getElementById('hotelsTable').style.display = 'none';
        document.getElementById('noResultsMessage').style.display = 'none';
        document.getElementById('errorMessage').style.display = 'none';
        document.getElementById('loadingMessage').style.display = 'block';
    }
    
    showNoResults() {
        document.getElementById('hotelsTable').style.display = 'none';
        document.getElementById('loadingMessage').style.display = 'none';
        document.getElementById('errorMessage').style.display = 'none';
        document.getElementById('noResultsMessage').style.display = 'block';
        this.updateResultsHeader(0);
    }
    
    showError(message) {
        document.getElementById('hotelsTable').style.display = 'none';
        document.getElementById('loadingMessage').style.display = 'none';
        document.getElementById('noResultsMessage').style.display = 'none';
        document.getElementById('errorMessage').style.display = 'block';
        document.getElementById('errorMessage').textContent = message;
    }
    
    truncateText(text, maxLength) {
        if (text.length <= maxLength) return text;
        return text.substr(0, maxLength) + '...';
    }
    
    escapeHtml(unsafe) {
        if (!unsafe) return '';
        return unsafe
            .toString()
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
}

// Crear instancia global para que los botones puedan acceder a los métodos
const hotelSearch = new HotelSearch();