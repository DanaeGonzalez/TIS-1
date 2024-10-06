<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM usuario WHERE id_usuario = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<form action="actualizar_usuario.php" method="post">
    <input type="hidden" name="id_usuario" value="<?php echo $row['id_usuario']; ?>">
    Nombre: <input type="text" name="nombre_usuario" value="<?php echo $row['nombre_usuario']; ?>"><br>
    Apellido: <input type="text" name="apellido_usuario" value="<?php echo $row['apellido_usuario']; ?>"><br>
    RUN: <input type="text" name="run_usuario" value="<?php echo $row['run_usuario']; ?>"><br>
    Correo: <input type="email" name="correo_usuario" value="<?php echo $row['correo_usuario']; ?>"><br>
    Teléfono: <input type="text" name="numero_usuario" value="<?php echo $row['numero_usuario']; ?>"><br>
    Dirección: <input type="text" name="direccion_usuario" value="<?php echo $row['direccion_usuario']; ?>"><br>
    Tipo de Usuario:
    <select name="tipo_usuario">
        <option value="Administrador" <?php if ($row['tipo_usuario'] == 'Administrador') echo 'selected'; ?>>Administrador</option>
        <option value="Registrado" <?php if ($row['tipo_usuario'] == 'Registrado') echo 'selected'; ?>>Registrado</option>
    </select><br>
    <input type="submit" value="Actualizar Usuario">
</form>
