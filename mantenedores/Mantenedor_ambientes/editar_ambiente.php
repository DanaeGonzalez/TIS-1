<?php
    include '../conexion.php';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM ambiente WHERE id_ambiente = $id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
?>