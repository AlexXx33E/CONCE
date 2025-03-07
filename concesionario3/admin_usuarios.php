<?php
session_start();
include 'db.php';

// Verificar si el usuario es Administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] != 'Administrador') {
    die("Acceso denegado.");
}

// Verificar si la conexión a la base de datos está funcionando
if (!$conexion) {
    die("Error de conexión a la base de datos: " . mysqli_connect_error());
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Usuarios</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">

</head>
<body>

    <h2>Lista de Usuarios</h2>

    <?php
    // Consulta SQL para obtener los usuarios
    $sql = "SELECT id_usuario, nombre, email, tipo_usuario FROM usuarios";
    $result = mysqli_query($conexion, $sql); // Usando $conexion en lugar de $conn

    // Verificar si la consulta fue exitosa
    if (!$result) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }

    // Mostrar usuarios si hay registros
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Tipo</th>
                    <th>Acción</th>
                </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id_usuario']}</td>
                    <td>{$row['nombre']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['tipo_usuario']}</td>
                    <td>
                        <a href='editar_usuario.php?id={$row['id_usuario']}'>Modificar</a> | 
                        <a href='borrar_usuario.php?id={$row['id_usuario']}'>Dar de baja</a>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No hay usuarios registrados.</p>";
    }

    mysqli_close($conexion);
    ?>
<br><br>
    <!-- Botón de Volver al Menú con el mismo estilo CSS -->
    <form action="index.php" method="post">
            <input type="submit" value="Volver">
        </form>
</body>
</html>
