<?php
$pageTitle = 'Editar Hotel';
require_once view_path('views/layouts/header.php');

if (!isset($hotel)) {
    header('Location: ' . BASE_URL . '/hoteles');
    exit;
}
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-edit"></i> Editar Hotel: <?= htmlspecialchars($hotel['nombre']) ?>
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= BASE_URL ?>/hoteles/update/<?= $hotel['id'] ?>">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre del Hotel *</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" 
                                   value="<?= htmlspecialchars($hotel['nombre']) ?>" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="categoria" class="form-label">Categoría (Estrellas) *</label>
                            <select class="form-select" id="categoria" name="categoria" required>
                                <option value="1" <?= $hotel['categoria'] == 1 ? 'selected' : '' ?>>★☆☆☆☆ (1 Estrella)</option>
                                <option value="2" <?= $hotel['categoria'] == 2 ? 'selected' : '' ?>>★★☆☆☆ (2 Estrellas)</option>
                                <option value="3" <?= $hotel['categoria'] == 3 ? 'selected' : '' ?>>★★★☆☆ (3 Estrellas)</option>
                                <option value="4" <?= $hotel['categoria'] == 4 ? 'selected' : '' ?>>★★★★☆ (4 Estrellas)</option>
                                <option value="5" <?= $hotel['categoria'] == 5 ? 'selected' : '' ?>>★★★★★ (5 Estrellas)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?= htmlspecialchars($hotel['descripcion']) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección *</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" 
                               value="<?= htmlspecialchars($hotel['direccion']) ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="distrito" class="form-label">Distrito *</label>
                            <input type="text" class="form-control" id="distrito" name="distrito" 
                                   value="<?= htmlspecialchars($hotel['distrito']) ?>" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="provincia" class="form-label">Provincia *</label>
                            <input type="text" class="form-control" id="provincia" name="provincia" 
                                   value="<?= htmlspecialchars($hotel['provincia']) ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label">Teléfono *</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" 
                                   value="<?= htmlspecialchars($hotel['telefono']) ?>" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?= htmlspecialchars($hotel['email']) ?>">
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Actualizar Hotel
                        </button>
                        <a href="<?= BASE_URL ?>/hoteles" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Cancelar
                        </a>
                        <a href="<?= BASE_URL ?>/hoteles/view/<?= $hotel['id'] ?>" class="btn btn-info">
                            <i class="fas fa-eye"></i> Ver
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once view_path('views/layouts/footer.php'); ?>