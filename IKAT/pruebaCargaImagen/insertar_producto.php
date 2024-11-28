<?php
session_start();
include '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recuperar datos del formulario
    $nombre = $_POST['nombre_producto'];
    $precio = $_POST['precio_unitario'];
    $descripcion = $_POST['descripcion_producto'];
    
    // Manejar la carga de la imagen
    if (isset($_FILES['foto_producto']) && $_FILES['foto_producto']['error'] == 0) {
        // Obtener la información del archivo
        $foto = $_FILES['foto_producto'];
        $nombre_foto = $foto['name'];
        $tipo_foto = $foto['type'];
        $tmp_foto = $foto['tmp_name'];
        $tamano_foto = $foto['size'];

        //Definir el directorio donde se guardará la imagen
        $directorio = '../assets/images/productos/';
        
        // Verificar que la carpeta de destino exista
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true); //Crear directorio si no existe
        }

        // Crear un nombre único para el archivo de imagen
        $nombre_foto_final = time() . '-' . basename($nombre_foto);
        $ruta_foto_final = $directorio . $nombre_foto_final;

        // Verificar el tipo de archivo (por ejemplo, solo permitir imágenes)
        $ext = pathinfo($nombre_foto, PATHINFO_EXTENSION);
        $ext = strtolower($ext);
        $tipos_permitidos = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($ext, $tipos_permitidos)) {
            // Mover la imagen cargada al directorio deseado
            if (move_uploaded_file($tmp_foto, $ruta_foto_final)) {
                // Insertar datos en la base de datos
                $sql = "INSERT INTO producto (nombre_producto, precio_unitario, descripcion_producto, foto_producto, stock_producto, cantidad_vendida, top_venta, activo)
                        VALUES ('$nombre', $precio, '$descripcion', '$ruta_foto_final', 0, 0, 0, 1)";
                
                if ($conn->query($sql) === TRUE) {
                    $_SESSION['mensaje'] = "Producto creado exitosamente";
                } else {
                    $_SESSION['mensaje'] = "Error al crear producto: " . $conn->error;
                }
            } else {
                $_SESSION['mensaje'] = "Error al cargar la imagen.";
            }
        } else {
            $_SESSION['mensaje'] = "Tipo de archivo no permitido. Solo se permiten imágenes JPG, JPEG, PNG, GIF.";
        }
    } else {
        $_SESSION['mensaje'] = "Debe seleccionar una imagen para el producto.";
    }

    header('Location: mostrar_producto.php');
    exit();
}
?>
