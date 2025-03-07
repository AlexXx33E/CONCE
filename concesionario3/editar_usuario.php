<?php
session_start();
include 'db.php';

// Verificar si el usuario es Administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] != 'Administrador') {
    die("Acceso denegado.");
}

// Verificar si se recibió el ID del usuario
if (!isset($_GET['id'])) {
    die("ID de usuario no proporcionado.");
}

$id_usuario = $_GET['id'];

// Obtener los datos actuales del usuario
$sql = "SELECT nombre, email, tipo_usuario FROM usuarios WHERE id_usuario = ?";
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_usuario);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $nombre = $row['nombre'];
    $email = $row['email'];
    $tipo_usuario = $row['tipo_usuario'];
} else {
    die("Usuario no encontrado.");
}

// Si el formulario es enviado, actualizar los datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_nuevo = htmlspecialchars(trim($_POST['nombre']));
    $email_nuevo = htmlspecialchars(trim($_POST['email']));
    $tipo_usuario_nuevo = $_POST['tipo_usuario'];

    $sql = "UPDATE usuarios SET nombre = ?, email = ?, tipo_usuario = ? WHERE id_usuario = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $nombre_nuevo, $email_nuevo, $tipo_usuario_nuevo, $id_usuario);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Usuario actualizado correctamente. <a href='admin_usuarios.php'>Volver</a>";
    } else {
        echo "Error al actualizar usuario.";
    }
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

    <h2>Editar Usuario</h2>
    <form method="POST">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($nombre) ?>" required>
        
        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
        
        <label>Tipo de Usuario:</label>
        <select name="tipo_usuario" required>
            <option value="Comprador" <?= ($tipo_usuario == "Comprador") ? "selected" : "" ?>>Comprador</option>
            <option value="Vendedor" <?= ($tipo_usuario == "Vendedor") ? "selected" : "" ?>>Vendedor</option>
            <option value="Administrador" <?= ($tipo_usuario == "Administrador") ? "selected" : "" ?>>Administrador</option>
        </select>

        <button type="submit">Guardar Cambios</button>
    </form><br><br>
    <form action="admin_usuarios.php" method="post">
            <input type="submit" value="Volver">
        </form>
</body>
</html>
