<?php
session_start();

if (isset($_POST['id_categoria'])) {
    if ($_POST['id_categoria'] === '') {
        // Eliminar la categoría seleccionada
        unset($_SESSION['id_categoria']);
    } else {
        // Guardar la categoría seleccionada en la sesión
        $_SESSION['id_categoria'] = intval($_POST['id_categoria']);
    }
    echo "Categoría actualizada en la sesión.";
} else {
    echo "No se recibió id_categoria.";
}

?>
