<?php
include '../conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM metodo_pago WHERE id_metodo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Método de Pago</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../menu/styles.css">
</head>
<body>
    <div class="content-area flex-grow-1 p-5">
        <div class="container p-4">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center">Editar Método de Pago</h1>

                    <form action="actualizar_metodo_pago.php" method="post">
                        <input type="hidden" name="id_metodo" value="<?php echo htmlspecialchars($row['id_metodo']); ?>">

                        Nombre del Método:
                        <input class="form-control" type="text" name="nombre_metodo" 
                               value="<?php echo htmlspecialchars($row['nombre_metodo']); ?>" required><br><br>

                        <input class="form-control btn btn-primary d-block" type="submit" value="Actualizar Método de Pago">
                        <a href="mostrar_metodo_pago.php" class="btn btn-primary mt-3 d-block">Volver</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
