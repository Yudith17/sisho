<?php
$pageTitle = 'Crear Hotel';
require view_path('views/layouts/header.php');
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-plus"></i> Crear Nuevo Hotel
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= BASE_URL ?>/hoteles/store">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre del Hotel *</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="categoria" class="form-label">Categoría (Estrellas) *</label>
                            <select class="form-select" id="categoria" name="categoria" required>
                                <option value="1">★☆☆☆☆ (1 Estrella)</option>
                                <option value="2">★★☆☆☆ (2 Estrellas)</option>
                                <option value="3" selected>★★★☆☆ (3 Estrellas)</option>
                                <option value="4">★★★★☆ (4 Estrellas)</option>
                                <option value="5">★★★★★ (5 Estrellas)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección *</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="distrito" class="form-label">Distrito *</label>
                            <input type="text" class="form-control" id="distrito" name="distrito" value="HUANTA" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="provincia" class="form-label">Provincia *</label>
                            <input type="text" class="form-control" id="provincia" name="provincia" value="HUANTA" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label">Teléfono *</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Guardar Hotel
                        </button>
                        <a href="<?= BASE_URL ?>/hoteles" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require view_path('views/layouts/footer.php'); ?>