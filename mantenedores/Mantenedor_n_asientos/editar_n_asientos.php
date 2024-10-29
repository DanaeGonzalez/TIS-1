<?php
    include '../conexion.php';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM n_asientos WHERE id_n_asientos = $id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
?>