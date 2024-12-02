<?php
session_start();
require_once '../assets/php/ver_resenias.php';
require_once '../config/conexion.php'; // Archivo de conexión a la base de datos

$id_usuario = $_SESSION['id_usuario'] ?? null;

if ($id_usuario) {
    $pendientes = obtenerReseniasPendientes($conn, $id_usuario);
    $realizadas = obtenerReseniasRealizadas($conn, $id_usuario);
}
?>

<!doctype php>
<php lang="es">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IKAT - Mis opiniones</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="../assets/css/styles.css">
        <link rel="stylesheet" href="../assets/css/opiniones.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body>
        <div class="container-f">
            <?php include '../templates/header.php'; ?>

            <div class="main">
                <div class="container mt-4 mb-4">
                    <h1 class="text-center mb-3">Mis Opiniones</h1>
                    <hr><br>
                
                    <ul class="nav nav-tabs justify-content-center" id="opinionesTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active text-dark border border-2" id="pendientes-tab" data-bs-toggle="tab" 
                                data-bs-target="#pendientes" type="button" role="tab" aria-controls="pendientes" 
                                aria-selected="true">Pendientes</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-dark border border-2" id="realizadas-tab" data-bs-toggle="tab" 
                                data-bs-target="#realizadas" type="button" role="tab" aria-controls="realizadas" 
                                aria-selected="false">Realizadas</button>
                        </li>
                    </ul>
                
                    <div class="tab-content">
                        <!-- Reseñas Pendientes -->
                        <div class="tab-pane fade show active" id="pendientes" role="tabpanel" aria-labelledby="pendientes-tab">
                            <?php if (!empty($pendientes)): ?>
                                <?php foreach ($pendientes as $producto): ?>
                                    <div class="d-flex flex-column flex-md-row border rounded p-3 mb-3 bg-light">
                                        <div class="row align-items-center w-100">
                                            <div class="col-12 col-md-3 d-flex align-items-center mb-3 mb-md-0">
                                                <?php
                                                $ruta_original = $producto['foto_producto'];
                                                $ruta_ajustada = str_replace("../../", "../", $ruta_original);
                                                ?>
                                                <img src="<?= $ruta_ajustada ?>" alt="Producto" width="50" height="50" class="rounded me-3">
                                                <div>
                                                    <p class="mb-1 fw-bold"><?= $producto['nombre_producto'] ?></p>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3 d-flex justify-content-center mb-3 mb-md-0">
                                                <div class="star-rating pendientes" onclick="abrirModalResena(<?= $producto['id_producto'] ?>)">
                                                    <i class="bi bi-star" data-value="1"></i>
                                                    <i class="bi bi-star" data-value="2"></i>
                                                    <i class="bi bi-star" data-value="3"></i>
                                                    <i class="bi bi-star" data-value="4"></i>
                                                    <i class="bi bi-star" data-value="5"></i>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3 d-flex justify-content-center mb-3 mb-md-0">
                                                <small class="text-muted">Comprado el <?= $producto['fecha_compra'] ?></small>
                                            </div>
                                            <div class="col-12 col-md-3 d-flex justify-content-center">
                                                <button type="button" class="btn btn-cafe-opinar btn-sm" data-bs-toggle="modal" 
                                                    data-bs-target="#modalResena" onclick="abrirModalResena(<?= $producto['id_producto'] ?>)">
                                                    Escribir mi reseña
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-muted">No tienes reseñas pendientes.</p>
                            <?php endif; ?>
                        </div>
                            
                        <!-- Reseñas Realizadas -->
                        <div class="tab-pane fade" id="realizadas" role="tabpanel" aria-labelledby="realizadas-tab">
                            <?php if (!empty($realizadas)): ?>
                                <?php foreach ($realizadas as $resenia): ?>
                                    <div class="d-flex flex-column flex-md-row border rounded p-3 mb-2 bg-light">
                                        <div class="row align-items-center w-100">
                                            <div class="col-12 col-md-3 d-flex align-items-center mb-3 mb-md-0">
                                                <?php
                                                $ruta_original = $resenia['foto_producto'];
                                                $ruta_ajustada = str_replace("../../", "../", $ruta_original);
                                                ?>
                                                <img src="<?= $ruta_ajustada ?>" alt="Producto" width="50" height="50" class="rounded me-3">
                                                <div>
                                                    <p class="mb-1 fw-bold"><?= $resenia['nombre_producto'] ?></p>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3 d-flex justify-content-center mb-3 mb-md-0">
                                                <div class="star-rating no-click">
                                                    <?php for ($i = 5; $i >= 1; $i--): ?>
                                                        <?php if ($i <= $resenia['calificacion']): ?>
                                                            <i class="bi bi-star-fill" data-value="<?= $i ?>"></i>
                                                        <?php else: ?>
                                                            <i class="bi bi-star" data-value="<?= $i ?>"></i>
                                                        <?php endif; ?>
                                                    <?php endfor; ?>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3 d-flex justify-content-center mb-3 mb-md-0">
                                                <small class="text-muted">Realizada el <?= $resenia['fecha_resenia'] ?></small>
                                            </div>
                                            <div class="col-12 col-md-3 d-flex justify-content-center">
                                                <?php
                                                $calificacion = htmlspecialchars($resenia['calificacion'] ?? '', ENT_QUOTES, 'UTF-8');
                                                $comentario = htmlspecialchars($resenia['comentario'] ?? '', ENT_QUOTES, 'UTF-8');
                                                $idResenia = htmlspecialchars($resenia['id_resenia'] ?? '', ENT_QUOTES, 'UTF-8');
                                                ?>
                
                                                <button type="button" class="btn btn-cafe-opinar btn-sm editar-resena" 
                                                    data-id="<?= $idResenia ?>" data-calificacion="<?= $calificacion ?>" 
                                                    data-comentario="<?= $comentario ?>">
                                                    Editar mi reseña
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-muted">No tienes reseñas realizadas.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>

            <?php include '../templates/footer.php'; ?>
        </div>
        <!-- Agregar reseña Modal -->
        <div class="modal fade" id="modalResena" tabindex="-1" aria-labelledby="modalResenaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalResenaLabel">Escribir mi reseña</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formResena">
                            <!-- Calificación -->
                            <div class="mb-3">
                                <label class="form-label">Calificación</label>
                                <div class="star-rating">
                                    <i class="bi bi-star" data-value="1"></i>
                                    <i class="bi bi-star" data-value="2"></i>
                                    <i class="bi bi-star" data-value="3"></i>
                                    <i class="bi bi-star" data-value="4"></i>
                                    <i class="bi bi-star" data-value="5"></i>
                                </div>
                                <input type="hidden" name="calificacion" id="calificacion">
                            </div>
                            <!-- Comentario -->
                            <div class="mb-3">
                                <label for="comentario" class="form-label">Comentario</label>
                                <textarea class="form-control" id="comentario" name="comentario" rows="4"
                                    placeholder="Escribe tu reseña aquí..."></textarea>
                            </div>
                            <input type="hidden" id="productoId" name="producto_id">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-cafe-opinar" id="guardarResena">Guardar Reseña</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Editar reseña Modal -->
        <div class="modal fade" id="modalEditarResena" tabindex="-1" aria-labelledby="modalEditarResenaLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditarResenaLabel">Editar mi reseña</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formEditarResena">
                            <!-- Calificación -->
                            <div class="mb-3">
                                <label class="form-label">Calificación</label>
                                <div class="star-rating">
                                    <i class="bi bi-star" data-value="1"></i>
                                    <i class="bi bi-star" data-value="2"></i>
                                    <i class="bi bi-star" data-value="3"></i>
                                    <i class="bi bi-star" data-value="4"></i>
                                    <i class="bi bi-star" data-value="5"></i>
                                </div>
                                <input type="hidden" name="calificacion" id="editarCalificacion">
                            </div>
                            <!-- Comentario -->
                            <div class="mb-3">
                                <label for="editarComentario" class="form-label">Comentario</label>
                                <textarea class="form-control" id="editarComentario" name="comentario" rows="4"
                                    placeholder="Edita tu reseña aquí..."></textarea>
                            </div>
                            <input type="hidden" id="idResena" name="id_resenia">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-cafe-opinar" id="guardarCambiosResena">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/modalResena.js"></script>

    </body>

</php>