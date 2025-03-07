<?php
session_start();
include 'db.php';

// Verificar si el usuario es Administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] != 'Administrador') {
    die("Acceso denegado.");
}

// Verificar si se recibió el ID del coche
if (!isset($_GET['id'])) {
    die("ID de coche no proporcionado.");
}

$id_coche = $_GET['id'];

// Eliminar coche de la base de datos
$sql = "DELETE FROM coches WHERE id_coche = ?";
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_coche);

$mensaje = "";
if (mysqli_stmt_execute($stmt)) {
    $mensaje = "Coche eliminado correctamente.";
} else {
    $mensaje = "Error al eliminar coche.";
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar Coche</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
<br>
    <form action="admin_coches.php" method="post">
    <h2><?= $mensaje ?></h2>
            <input type="submit" value="Volver">
        </form>
</body>
</html>
