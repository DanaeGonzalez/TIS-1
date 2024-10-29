<?php
    include '../conexion.php';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM color WHERE id_color = $id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
?>