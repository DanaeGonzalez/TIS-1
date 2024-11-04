<?php
    include '../../config/conexion.php';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM categoria WHERE id_categoria = $id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
?>