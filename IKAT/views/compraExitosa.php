<?php include_once '..\config\conexion.php'; ?>

<!doctype php>
<php lang="es">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IKAT</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="../assets/css/styles.css">
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    </head>

    <style>
        body {
            background-color: #f5f5f5;
        }

        .summary-box {
            background-color: #92532e;
            border: 2px solid #555555;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }

        .summary-box h3 {
            font-size: 1.8rem;
            font-weight: 600;
            color: #fff;
        }

        .summary-box p {
            font-size: 1rem;
            color: #fff;
        }

        .table-responsive {
            max-width: 90%;
            margin: 20px auto;
        }

        .table-bordered {
            border: 1px solid #ddd;
            /* Bordes más suaves */
            font-size: 1rem;
            text-align: center;
        }

        .table th,
        .table td {
            padding: 15px;
            vertical-align: middle;
        }

        .table thead {
            background-color: #333333;
            color: #fff;
        }

        .table tfoot {
            background-color: #f8f8f8;
        }

        .btn-dark {
            background-color: #333333;
            border-color: #333333;
            padding: 10px 20px;
            border-radius: 6px;
        }

        .btn-dark:hover {
            background-color: #555555;
            border-color: #555555;
        }

        h1 {
            color: #333333;
            font-weight: 700;
            font-size: 2rem;
        }

        .product-img {
            width: 100px;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
        }

        .text-center {
            text-align: center;
        }

        .fw-bold {
            font-weight: bold;
        }

        .listado {
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 50px;
        }
    </style>


    <body>

        <div class="container-f">
            <!-- Header/Navbar -->
            <?php include '../templates/header.php'; ?>

            <!-- Main -->
            <div class="main">
                <div class="container my-5">
                    <?php
                    $id_usuario = $_SESSION['id_usuario']; // ID del usuario desde la sesión
                    $total_compra = 0; // Inicializamos la variable para evitar errores
                    
                    // Obtener el nombre del usuario
                    $query_usuario = "SELECT nombre_usuario FROM usuario WHERE id_usuario = ?";
                    $stmt_usuario = $conn->prepare($query_usuario);
                    $stmt_usuario->bind_param("i", $id_usuario);
                    $stmt_usuario->execute();
                    $result_usuario = $stmt_usuario->get_result();
                    $nombre_usuario = $result_usuario->fetch_assoc()['nombre_usuario'] ?? 'Cliente';

                    // Obtener el último id_compra del usuario
                    $query_compra = "SELECT id_compra 
                         FROM compra 
                         WHERE id_usuario = ? 
                         ORDER BY id_compra DESC LIMIT 1"; // Obtenemos el último id_compra
                    $stmt_compra = $conn->prepare($query_compra);
                    $stmt_compra->bind_param("i", $id_usuario);
                    $stmt_compra->execute();
                    $result_compra = $stmt_compra->get_result();

                    // Si encontramos el último id_compra
                    if ($result_compra->num_rows > 0) {
                        $row = $result_compra->fetch_assoc();
                        $id_compra = $row['id_compra'];
                    } else {
                        // Si no se encuentra ningún id_compra, puedes manejar el error o redirigir
                        echo "<p class='text-center text-danger'>No se encontró ninguna compra para este usuario.</p>";
                        exit();
                    }
                    ?>

                    <h1 class="text-center text-success mb-3 fw-bold">¡Gracias por tu compra,
                        <?= htmlspecialchars($nombre_usuario) ?>!</h1>

                    <div class="listado">
                        <div class="summary-box mb-4">
                            <?php
                            if ($id_compra) {
                                echo "<h3 class='text-center fw-bold'>¡Felicidades por tu compra!</h3>";
                                echo "<p class='text-center'>Estamos emocionados de que hayas elegido nuestros productos. ¡Esperamos que los disfrutes!</p>";
                                echo "<p class='text-center'>Número de orden: <strong>#{$id_compra}</strong></p>";
                            } else {
                                echo "<p class='text-center text-danger'>No se encontró información de la compra.</p>";
                            }
                            ?>
                        </div>

                        <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Producto</th>
                                    <th>Precio Unitario</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Inicializar el total de la compra
                                $total_compra = 0;
                                                
                                // Obtener los detalles de los productos de la compra con posibles descuentos
                                $query = "SELECT 
                                            p.nombre_producto, 
                                            p.precio_unitario, 
                                            p.foto_producto, 
                                            cp.cantidad, 
                                            o.porcentaje_descuento
                                          FROM compra_producto cp
                                          JOIN producto p ON cp.id_producto = p.id_producto
                                          LEFT JOIN oferta o ON p.id_producto = o.id_producto
                                          WHERE cp.id_compra = ?";
                        
                                $stmt = $conn->prepare($query);
                                $stmt->bind_param("i", $id_compra);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                                
                                while ($row = $result->fetch_assoc()) {
                                    // Calcular precio con descuento si aplica
                                    $precio_unitario = $row['precio_unitario'];
                                    if (!is_null($row['porcentaje_descuento'])) {
                                        $precio_unitario -= ($precio_unitario * $row['porcentaje_descuento'] / 100);
                                    }
                                
                                    // Calcular el total del producto
                                    $subtotal = $precio_unitario * $row['cantidad'];
                                    $total_compra += $subtotal;
                                
                                    // Usar imagen predeterminada si no hay foto
                                    $imagen = !empty($row['foto_producto']) ? $row['foto_producto'] : '../assets/images/default.png';
                                
                                    // Mostrar fila del producto
                                    echo "<tr>
                                        <td><img src='$imagen' alt='Imagen de {$row['nombre_producto']}' class='product-img'></td>
                                        <td>{$row['nombre_producto']}</td>
                                        <td>$" . number_format($precio_unitario, 0, ',', '.') . "</td>
                                        <td>{$row['cantidad']}</td>
                                        <td>$" . number_format($subtotal, 0, ',', '.') . "</td>
                                      </tr>";
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end"><strong>Total Pagado:</strong></td>
                                    <td><strong>$<?= number_format($total_compra, 0, ',', '.') ?></strong></td>
                                </tr>
                            </tfoot>
                        </table>

                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="compras.php" class="btn btn-dark">Ir a mis compras</a>
                    </div>
                </div>
            </div>


            <!-- Footer -->
            <?php include '../templates/footer.php'; ?>
        </div>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // Solicitar permiso para notificaciones si es necesario
                if (Notification.permission !== "granted") {
                    Notification.requestPermission().then(permission => {
                        if (permission === "granted") {
                            sendNotification();
                        }
                    });
                } else {
                    sendNotification(); // Enviar la notificación si ya hay permiso
                }
            });

            function sendNotification() {
                // Realizar la solicitud al servidor para obtener los datos de la notificación
                $.ajax({
                    url: "../assets/php/push_notificacion.php", // Cambiar por tu ruta al servidor
                    type: "POST",
                    success: function (data) {
                        if ($.trim(data)) {
                            const notificationData = jQuery.parseJSON(data);
                            console.log(notificationData);

                            // Crear la notificación
                            const notification = new Notification(notificationData.title, {
                                icon: notificationData.icon,
                                body: notificationData.body,
                            });

                            // Redirigir al hacer clic en la notificación
                            notification.onclick = function () {
                                window.open(notificationData.url);
                            };

                            // Cerrar la notificación automáticamente después de 5 segundos
                            setTimeout(() => {
                                notification.close();
                            }, 5000);
                        }
                    },
                    error: function () {
                        console.error("No se pudo obtener la notificación del servidor.");
                    }
                });
            }



        </script>


    </body>

</php>