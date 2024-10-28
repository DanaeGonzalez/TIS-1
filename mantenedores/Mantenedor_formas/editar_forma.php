<?php
    include '../conexion.php';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM forma WHERE id_forma = $id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
?>