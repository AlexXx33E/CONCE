<?php
session_start();
include 'db.php';

// Verificar si el usuario es Vendedor
if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] != 'Vendedor') {
    die("Acceso denegado.");
}

$id_vendedor = $_SESSION['id_usuario'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Coche</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

    <h2>Añadir Coche</h2>

    <form method="POST">
        <input type="text" name="marca" placeholder="Marca" required>
        <input type="text" name="modelo" placeholder="Modelo" required>
        <input type="text" name="color" placeholder="Color" required>
        <input type="number" name="precio" placeholder="Precio" required>
        <button type="submit" name="agregar">Añadir Coche</button>
    </form>

    <?php
    // Procesar alta de coche
    if (isset($_POST['agregar'])) {
        $marca = htmlspecialchars($_POST['marca']);
        $modelo = htmlspecialchars($_POST['modelo']);
        $color = htmlspecialchars($_POST['color']);
        $precio = $_POST['precio'];

        $sql = "INSERT INTO coches (marca, modelo, color, precio, id_vendedor) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, "sssdi", $marca, $modelo, $color, $precio, $id_vendedor);

        if (mysqli_stmt_execute($stmt)) {
            echo "<p>Coche añadido exitosamente.</p>";
        } else {
            echo "<p>Error al añadir coche.</p>";
        }
        mysqli_stmt_close($stmt);
    }

    mysqli_close($conexion);
    ?>

    <!-- Botón de Volver -->
    <div style="text-align: center; margin-top: 20px;">
        <a href="index.php" class="boton-volver">Volver al Menú</a>
    </div>

</body>
</html>
