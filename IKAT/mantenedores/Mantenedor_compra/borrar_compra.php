<?php
include '../../config/conexion.php'; // Incluye el archivo de conexión a la base de datos
session_start();

// Verifica si se recibió un ID por el método GET
if (isset($_GET['id'])) {
    $id_compra = intval($_GET['id']); // Asegúrate de que el ID sea un número entero

    // Prepara la consulta SQL para borrar
    $sql = "DELETE FROM compra WHERE id_compra = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('i', $id_compra); // Vincula el ID como un parámetro entero
        if ($stmt->execute()) {
            $_SESSION['mensaje'] = "La compra se ha eliminado correctamente.";
        } else {
            $_SESSION['mensaje'] = "Error al eliminar la compra con ID $id_compra: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $_SESSION['mensaje'] = "Error al preparar la consulta SQL.";
    }
} else {
    $_SESSION['mensaje'] = "No se proporcionó un ID válido para eliminar.";
}

// Redirige de vuelta a la página de compras
header('Location: mostrar_compra.php');
exit();
?>
