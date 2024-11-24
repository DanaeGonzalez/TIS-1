<?php
include_once '../../config/conexion.php';
include '../../views/menu_registro/auth.php';


if (isset($_POST['id_producto']) && isset($_SESSION['id_usuario'])) {
    // Recupera el ID del producto
    $id_producto = $_POST['id_producto'];

    // Obtén el id de la lista de deseos del usuario actual desde la base de datos
    $id_usuario = $_SESSION['id_usuario'];
    
    // Consulta para obtener el id de la lista de deseos del usuario
    $sql_lista = "SELECT id_lista_deseos FROM lista_de_deseos WHERE id_usuario = ?";
    $stmt_lista = $conn->prepare($sql_lista);
    $stmt_lista->bind_param('i', $id_usuario);
    $stmt_lista->execute();
    $stmt_lista->bind_result($id_lista_deseos);
    $stmt_lista->fetch();
    $stmt_lista->close();

    // Verifica si se obtuvo un id de lista de deseos válido
    if (isset($id_lista_deseos)) {
        // Prepara la consulta para eliminar el producto de la lista de deseos
        $sql = "DELETE FROM lista_deseos_producto WHERE id_producto = ? AND id_lista_deseos = ?";
        $stmt = $conn->prepare($sql);   

        // Vincula los parámetros
        $stmt->bind_param('ii', $id_producto, $id_lista_deseos);
        
        if ($stmt->execute()) {
            echo "Producto eliminado exitosamente.";
        } else {
            echo "Error al eliminar el producto: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "No se encontró la lista de deseos del usuario.";
    }
} else {
    echo "ID de producto o usuario no especificado.";
}

$conn->close();

header('Location: ../../views/deseados.php');
exit();
?>
