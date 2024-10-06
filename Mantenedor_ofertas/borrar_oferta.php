<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_oferta'])) {
    $id_oferta = $_POST['id_oferta'];

    // Eliminar la oferta
    $query = "DELETE FROM oferta WHERE id_oferta = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_oferta);
    
    if ($stmt->execute()) {
        echo "Oferta eliminada con éxito.";
    } else {
        echo "Error al eliminar la oferta.";
    }
} else {
    echo "No se recibió un ID de oferta válido.";
}
?>

<br>
<a href='mostrar_ofertas.php'>Volver</a>
