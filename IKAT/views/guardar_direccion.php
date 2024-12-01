<?php
require("../config/conexion.php");
session_start();

// Verificar si se recibió la dirección por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['direccion_pedido'])) {
    $direccion = trim($_POST['direccion_pedido']);
    // Validar que no esté vacía
    if (!empty($direccion)) {
        // Guardar la dirección en la sesión
        $_SESSION['direccion_pedido'] = htmlspecialchars($direccion);
        echo "Dirección guardada en la sesión: " . $_SESSION['direccion_pedido'];
    } else {
        echo "Por favor, ingresa una dirección válida.";
    }
} else {
    echo "Solicitud no válida.";
}
?>
