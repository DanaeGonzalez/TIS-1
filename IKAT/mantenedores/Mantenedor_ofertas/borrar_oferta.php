<?php
    include '../../config/conexion.php';
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_oferta'])) {
        $id_oferta = $_POST['id_oferta'];
        
        // Eliminar la oferta
        $query = "DELETE FROM oferta WHERE id_oferta = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id_oferta);
        
        if ($stmt->execute()) {
            $_SESSION['mensaje'] = "Oferta eliminada con éxito.";
        } else {
            $_SESSION['mensaje'] = "Error al eliminar la oferta.";
        }
    } else {
        $_SESSION['mensaje'] = "No se recibió un ID de oferta válido.";
    }
    header('Location: mostrar_ofertas.php');
    exit();

?>
