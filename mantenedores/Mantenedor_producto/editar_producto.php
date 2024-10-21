<?php
    include '../conexion.php';
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $sql = "SELECT * FROM producto WHERE id_producto = $id";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
  }
?>