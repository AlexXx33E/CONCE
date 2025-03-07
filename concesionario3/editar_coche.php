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

// Obtener los datos actuales del coche
$sql = "SELECT marca, modelo, color, precio FROM coches WHERE id_coche = ?";
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_coche);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $marca = $row['marca'];
    $modelo = $row['modelo'];
    $color = $row['color'];
    $precio = $row['precio'];
} else {
    die("Coche no encontrado.");
}

// Si el formulario es enviado, actualizar los datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marca_nueva = htmlspecialchars(trim($_POST['marca']));
    $modelo_nuevo = htmlspecialchars(trim($_POST['modelo']));
    $color_nuevo = htmlspecialchars(trim($_POST['color']));
    $precio_nuevo = $_POST['precio'];

    $sql = "UPDATE coches SET marca = ?, modelo = ?, color = ?, precio = ? WHERE id_coche = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "sssdi", $marca_nueva, $modelo_nuevo, $color_nuevo, $precio_nuevo, $id_coche);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Coche actualizado correctamente.";
    } else {
        echo "Error al actualizar coche.";
    }
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Coche</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

    <h2>Editar Coche</h2>
    <form method="POST">
        <label>Marca:</label>
        <input type="text" name="marca" value="<?= htmlspecialchars($marca) ?>" required>
        
        <label>Modelo:</label>
        <input type="text" name="modelo" value="<?= htmlspecialchars($modelo) ?>" required>
        
        <label>Color:</label>
        <input type="text" name="color" value="<?= htmlspecialchars($color) ?>" required>
        
        <label>Precio:</label>
        <input type="number" name="precio" value="<?= htmlspecialchars($precio) ?>" required>

        <button type="submit">Guardar Cambios</button>
    </form><br><br>

    <form action="admin_coches.php" method="post">
            <input type="submit" value="Volver">
        </form>

</body>
</html>
