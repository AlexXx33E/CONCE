<?php
session_start();
include 'db.php';

// Verificar si el usuario es Administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] != 'Administrador') {
    die("Acceso denegado.");
}

// Verificar si se recibió el ID del alquiler
if (!isset($_GET['id'])) {
    die("ID de alquiler no proporcionado.");
}

$id_alquiler = $_GET['id'];

// Eliminar alquiler de la base de datos
$sql = "DELETE FROM alquileres WHERE id_alquiler = ?";
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_alquiler);

$mensaje = "";
if (mysqli_stmt_execute($stmt)) {
    $mensaje = "Alquiler eliminado correctamente.";
} else {
    $mensaje = "Error al eliminar alquiler.";
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar Alquiler</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

    <div class="container">
        <h2><?= $mensaje ?></h2>
        <a href="admin_alquileres.php" class="boton-volver">Volver</a>
    </div>

</body>
</html>
