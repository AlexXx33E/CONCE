<?php
session_start();
include 'db.php'; // Conectar con la base de datos

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Alquileres</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    <h1>Gestión de Alquileres</h1>

    <form action="listar_alquileres.php" method="post">
        <input type="submit" value="Ver Alquileres">
    </form>

    <?php if ($_SESSION['tipo_usuario'] == 'Comprador') { ?>
        <form action="alquilar_coche.php" method="post">
            <input type="submit" value="Alquilar un Coche">
        </form>
    <?php } ?>

    <?php if ($_SESSION['tipo_usuario'] == 'Administrador') { ?>
        <form action="borrar_alquiler.php" method="post">
            <input type="submit" value="Borrar un Alquiler">
        </form>
    <?php } ?>

    <form action="index.php" method="post">
        <input type="submit" value="Volver">
    </form>
</body>
</html>
