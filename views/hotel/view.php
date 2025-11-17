<?php
$pageTitle = 'Ver Hotel';
require_once view_path('views/layouts/header.php');

if (!isset($hotel)) {
    header('Location: ' . BASE_URL . '/hoteles');
    exit;
}
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-eye"></i> Ver Hotel
                </h4>
                <a href="<?= BASE_URL ?>/hoteles" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Información General</h5>
                        <p><strong>Nombre:</strong> <?= htmlspecialchars($hotel['nombre']) ?></p>
                        <p><strong>Categoría:</strong> 
                            <span class="star-rating">
                                <?= str_repeat('★', $hotel['categoria']) . str_repeat('☆', 5 - $hotel['categoria']) ?>
                            </span>
                        </p>
                        <p><strong>Descripción:</strong> <?= htmlspecialchars($hotel['descripcion']) ?></p>
                    </div>
                    
                    <div class="col-md-6">
                        <h5>Ubicación</h5>
                        <p><strong>Dirección:</strong> <?= htmlspecialchars($hotel['direccion']) ?></p>
                        <p><strong>Distrito:</strong> <?= htmlspecialchars($hotel['distrito']) ?></p>
                        <p><strong>Provincia:</strong> <?= htmlspecialchars($hotel['provincia']) ?></p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-6">
                        <h5>Contacto</h5>
                        <p><strong>Teléfono:</strong> <?= htmlspecialchars($hotel['telefono']) ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($hotel['email']) ?></p>
                    </div>
                    
                    <div class="col-md-6">
                        <h5>Información del Sistema</h5>
                        <p><strong>ID:</strong> <?= $hotel['id'] ?></p>
                        <p><strong>Creado:</strong> <?= $hotel['created_at'] ?></p>
                        <p><strong>Actualizado:</strong> <?= $hotel['updated_at'] ?></p>
                    </div>
                </div>
                
                <div class="mt-4">
                    <a href="<?= BASE_URL ?>/hoteles/edit/<?= $hotel['id'] ?>" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <form method="POST" action="<?= BASE_URL ?>/hoteles/delete/<?= $hotel['id'] ?>" 
                          class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar este hotel?')">
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once view_path('views/layouts/footer.php'); ?>