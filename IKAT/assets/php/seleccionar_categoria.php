<?php
session_start();

// Verificar que se haya recibido un id_categoria válido
if (!empty($_POST['id_categoria'])) {
    $_SESSION['id_categoria'] = intval($_POST['id_categoria']);
    echo "Categoría seleccionada: " . $_SESSION['id_categoria'];
} else {
    echo "Error: Categoría no válida.";
}
?>
