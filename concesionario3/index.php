<?php
session_start();
include 'db.php'; // Conectar con la base de datos
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concesionario</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

    <h1>Concesionario</h1>

    <nav>
        <a href="index.php">Inicio</a>
        <a href="coches.php">Coches</a>
        <a href="login.php">Iniciar Sesión</a>
        <a href="registro.php">Registrarse</a>

        <?php if (isset($_SESSION['id_usuario'])) { ?>
            <a href="perfil.php">Perfil</a>
            <a href="logout.php">Cerrar Sesión</a>
        <?php } ?>

        <?php if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == 'Administrador') { ?>
            <a href="admin_usuarios.php">Gestionar Usuarios</a>
            <a href="admin_coches.php">Gestionar Coches</a>
        <?php } ?>
        <?php if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == 'Vendedor') { ?>
            <a href="vendedor_coches.php">Añadir Coche</a>
        <?php } ?>

    </nav>

</body>
</html>
