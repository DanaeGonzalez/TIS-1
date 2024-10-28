<?php
    include '../conexion.php';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM firmeza WHERE id_firmeza = $id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
?>