<?php
session_start();
include 'db.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_coche = $_POST['id_coche'];
    $id_usuario = $_SESSION['id_usuario'];
    $fecha_prestamo = date("Y-m-d H:i:s");

    // Obtener el precio del coche
    $sql_precio = "SELECT precio FROM coches WHERE id_coche = '$id_coche'";
    $resultado_precio = mysqli_query($conexion, $sql_precio);
    $coche = mysqli_fetch_assoc($resultado_precio);
    $precio = $coche['precio'];

    // Obtener el saldo del usuario
    $sql_saldo = "SELECT saldo FROM usuarios WHERE id_usuario = '$id_usuario'";
    $resultado_saldo = mysqli_query($conexion, $sql_saldo);
    $usuario = mysqli_fetch_assoc($resultado_saldo);
    $saldo_actual = $usuario['saldo'];

    // Verificar si el usuario tiene suficiente saldo
    if ($saldo_actual >= $precio) {
        // Descontar el saldo
        $nuevo_saldo = $saldo_actual - $precio;
        $sql_actualizar_saldo = "UPDATE usuarios SET saldo = '$nuevo_saldo' WHERE id_usuario = '$id_usuario'";

        // Registrar el alquiler
        $sql_alquilar = "INSERT INTO alquileres (id_usuario, id_coche, prestado) VALUES ('$id_usuario', '$id_coche', '$fecha_prestamo')";

        // Marcar el coche como alquilado
        $sql_actualizar_coche = "UPDATE coches SET alquilado = 1 WHERE id_coche = '$id_coche'";

        if (mysqli_query($conexion, $sql_actualizar_saldo) && mysqli_query($conexion, $sql_alquilar) && mysqli_query($conexion, $sql_actualizar_coche)) {
            echo "<p>✅ Coche alquilado con éxito. Nuevo saldo: " . number_format($nuevo_saldo, 2) . " €</p>";
        } else {
            echo "<p>❌ Error al alquilar: " . mysqli_error($conexion) . "</p>";
        }
    } else {
        echo "<p style='color:red;'>❌ Saldo insuficiente para alquilar este coche.</p>";
    }

    mysqli_close($conexion);
}
?>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="estilo.css">

</head>
<h1>Alquilar Coche</h1>
<form action="listar_coches.php" method="post">
    <input type="submit" value="Volver a la Lista de Coches">
</form>

<form action="perfil.php" method="post">
    <input type="submit" value="Ir a Mi Perfil">
</form>
