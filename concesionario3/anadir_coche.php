<?php
session_start();
include 'db.php';

if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] != 'Vendedor') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $color = $_POST['color'];
    $precio = $_POST['precio'];

    $sql = "INSERT INTO coches (modelo, marca, color, precio) VALUES ('$modelo', '$marca', '$color', '$precio')";

    if (mysqli_query($conexion, $sql)) {
        echo "<p>Coche añadido con éxito.</p>";
    } else {
        echo "<p>Error al añadir: " . mysqli_error($conexion) . "</p>";
    }

    mysqli_close($conexion);
}
?>

<h1>Añadir un Coche</h1>
<form action="anadir_coche.php" method="post">
    <label for="modelo">Modelo:</label>
    <input type="text" name="modelo" required><br>
    <label for="marca">Marca:</label>
    <input type="text" name="marca" required><br>
    <label for="color">Color:</label>
    <input type="text" name="color" required><br>
    <label for="precio">Precio:</label>
    <input type="number" name="precio" required><br>
    <input type="submit" value="Añadir">
</form>

<form action="coches.php" method="post">
    <input type="submit" value="Volver">
</form>
