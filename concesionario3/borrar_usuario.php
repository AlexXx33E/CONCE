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

// Evitar que el administrador se elimine a sí mismo
if ($id_usuario == $_SESSION['id_usuario']) {
    die("No puedes eliminar tu propia cuenta.");
}

// Eliminar usuario de la base de datos
$sql = "DELETE FROM usuarios WHERE id_usuario = ?";
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_usuario);

$mensaje = "";
if (mysqli_stmt_execute($stmt)) {
    $mensaje = "Usuario eliminado correctamente.";
} else {
    $mensaje = "Error al eliminar usuario.";
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar Usuario</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

    <div class="container">
        <h2><?= $mensaje ?></h2>
        <a href="admin_usuarios.php" class="boton-volver">Volver</a>
    </div>

</body>
</html>
