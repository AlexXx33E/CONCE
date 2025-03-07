<?php
session_start();
include 'db.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_alquiler = $_POST['id_alquiler'];
    $id_coche = $_POST['id_coche'];
    $id_usuario = $_SESSION['id_usuario'];
    $fecha_devolucion = date("Y-m-d H:i:s");

    // Obtener el precio del coche
    $sql_precio = "SELECT precio FROM coches WHERE id_coche = '$id_coche'";
    $resultado_precio = mysqli_query($conexion, $sql_precio);
    $coche = mysqli_fetch_assoc($resultado_precio);
    $precio = $coche['precio'];

    // Obtener el saldo actual del usuario
    $sql_saldo = "SELECT saldo FROM usuarios WHERE id_usuario = '$id_usuario'";
    $resultado_saldo = mysqli_query($conexion, $sql_saldo);
    $usuario = mysqli_fetch_assoc($resultado_saldo);
    $saldo_actual = $usuario['saldo'];

    // Reembolsar el saldo
    $nuevo_saldo = $saldo_actual + $precio;
    $sql_actualizar_saldo = "UPDATE usuarios SET saldo = '$nuevo_saldo' WHERE id_usuario = '$id_usuario'";

    // Marcar el coche como disponible
    $sql_actualizar_coche = "UPDATE coches SET alquilado = 0 WHERE id_coche = '$id_coche'";

    // Registrar la devolución en la tabla de alquileres
    $sql_devolucion = "UPDATE alquileres SET devuelto = '$fecha_devolucion' WHERE id_alquiler = '$id_alquiler'";

    if (mysqli_query($conexion, $sql_actualizar_saldo) && mysqli_query($conexion, $sql_actualizar_coche) && mysqli_query($conexion, $sql_devolucion)) {
        echo "<p>✅ Coche devuelto con éxito. Saldo reembolsado: " . number_format($precio, 2) . " €. Nuevo saldo: " . number_format($nuevo_saldo, 2) . " €</p>";
    } else {
        echo "<p>❌ Error al devolver el coche: " . mysqli_error($conexion) . "</p>";
    }

    mysqli_close($conexion);
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<h1>Devolución de Coche</h1>
<form action="perfil.php" method="post">
    <input type="submit" value="Volver a Mi Perfil">
</form>
