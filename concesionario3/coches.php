<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Coches</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    <h1>Gestión de Coches</h1>

    <form action="listar_coches.php" method="post">
        <input type="submit" value="Listar Coches">
    </form>

    <form action="buscar_coche.php" method="post">
        <input type="submit" value="Buscar Coche">
    </form>

    <form action="index.php" method="post">
        <input type="submit" value="Volver al Inicio">
    </form>
</body>
</html>
