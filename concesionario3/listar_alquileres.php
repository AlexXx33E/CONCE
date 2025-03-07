<?php
session_start();
include 'db.php'; // Conectar con la base de datos

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$consulta = mysqli_query($conexion, "SELECT * FROM alquileres") or die("Error en la consulta");

echo "<h1>Lista de Alquileres</h1>";
echo "<table border='1'>
        <tr>
            <th>ID Alquiler</th>
            <th>ID Usuario</th>
            <th>ID Coche</th>
            <th>Prestado</th>
            <th>Devuelto</th>
        </tr>";

while ($fila = mysqli_fetch_assoc($consulta)) {
    echo "<tr>
            <td>{$fila['id_alquiler']}</td>
            <td>{$fila['id_usuario']}</td>
            <td>{$fila['id_coche']}</td>
            <td>{$fila['prestado']}</td>
            <td>" . ($fila['devuelto'] ? $fila['devuelto'] : 'No devuelto') . "</td>
          </tr>";
}

echo "</table>";
mysqli_close($conexion);
?>

<form action="alquileres.php" method="post">
    <input type="submit" value="Volver">
</form>
