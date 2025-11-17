<?php
$pageTitle = 'Lista de Hoteles';
require view_path('views/layouts/header.php');
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>
        <i class="fas fa-hotel"></i> Sistema de Hoteles Huanta
    </h1>
    <a href="<?= BASE_URL ?>/hoteles/create" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nuevo Hotel
    </a>
</div>

<!-- Botones de navegación a las nuevas secciones -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card bg-primary text-white">
            <div class="card-body text-center">
                <i class="fas fa-users fa-3x mb-3"></i>
                <h5>Clientes API</h5>
                <p>Gestionar clientes de API</p>
                <a href="<?= BASE_URL ?>/client_api" class="btn btn-light">Acceder</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card bg-success text-white">
            <div class="card-body text-center">
                <i class="fas fa-key fa-3x mb-3"></i>
                <h5>Tokens API</h5>
                <p>Administrar tokens de acceso</p>
                <a href="<?= BASE_URL ?>/tokens_api" class="btn btn-light">Acceder</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card bg-info text-white">
            <div class="card-body text-center">
                <i class="fas fa-chart-bar fa-3x mb-3"></i>
                <h5>Count Request</h5>
                <p>Estadísticas de solicitudes</p>
                <a href="<?= BASE_URL ?>/count_request" class="btn btn-light">Acceder</a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="mb-0">Lista de Hoteles</h5>
                <small class="text-muted"><?= $total ?> hoteles registrados</small>
            </div>
            <div class="col-md-6">
                <form method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Buscar hoteles..." 
                           value="<?= htmlspecialchars($search) ?>">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="card-body">
        <!-- ... resto del código de la tabla de hoteles ... -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
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
                    <?php foreach ($hoteles as $hotel): ?>
                    <tr>
                        <td>
                            <strong><?= htmlspecialchars($hotel['nombre']) ?></strong><br>
                            <small class="text-muted">ID: <?= $hotel['id'] ?></small>
                        </td>
                        <td>
                            <span class="star-rating">
                                <?= str_repeat('★', $hotel['categoria']) . str_repeat('☆', 5 - $hotel['categoria']) ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars(substr($hotel['descripcion'], 0, 50)) ?>...</td>
                        <td>
                            <small>
                                <strong>Dirección:</strong> <?= htmlspecialchars($hotel['direccion']) ?><br>
                                <strong>Distrito:</strong> <?= htmlspecialchars($hotel['distrito']) ?><br>
                                <strong>Provincia:</strong> <?= htmlspecialchars($hotel['provincia']) ?>
                            </small>
                        </td>
                        <td>
                            <small>
                                <i class="fas fa-phone"></i> <?= htmlspecialchars($hotel['telefono']) ?><br>
                                <i class="fas fa-envelope"></i> <?= htmlspecialchars($hotel['email']) ?>
                            </small>
                        </td>
                        <td class="table-actions">
                            <a href="<?= BASE_URL ?>/hoteles/view/<?= $hotel['id'] ?>" class="btn btn-sm btn-info" title="Ver">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="<?= BASE_URL ?>/hoteles/edit/<?= $hotel['id'] ?>" class="btn btn-sm btn-warning" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="<?= BASE_URL ?>/hoteles/delete/<?= $hotel['id'] ?>" 
                                  class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar este hotel?')">
                                <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require view_path('views/layouts/footer.php'); ?>