<?php
    include '../conexion.php';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM material WHERE id_material = $id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
?>