<?php
session_start();
include 'db.php';

// Verificar si el usuario es Administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] != 'Administrador') {
    die("Acceso denegado.");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Coches</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">

</head>
<body>

    <h2>Lista de Coches</h2>

    <!-- Formulario de búsqueda -->
    <form method="GET">
        <input type="text" name="buscar" placeholder="Buscar coche...">
        <button type="submit">Buscar</button>
    </form><br>

    <?php
    // Filtrar por búsqueda si hay un término ingresado
    $where = "";
    if (isset($_GET['buscar']) && !empty($_GET['buscar'])) {
        $busqueda = htmlspecialchars($_GET['buscar']);
        $where = "WHERE marca LIKE '%$busqueda%' OR modelo LIKE '%$busqueda%' OR color LIKE '%$busqueda%'";
    }

    // Consulta SQL para obtener los coches
    $sql = "SELECT id_coche, marca, modelo, color, precio FROM coches $where";
    $result = mysqli_query($conexion, $sql);

    // Verificar si la consulta fue exitosa
    if (!$result) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }

    // Mostrar coches si hay registros
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Color</th>
                    <th>Precio</th>
                    <th>Acción</th>
                </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id_coche']}</td>
                    <td>{$row['marca']}</td>
                    <td>{$row['modelo']}</td>
                    <td>{$row['color']}</td>
                    <td>\${$row['precio']}</td>
                   <td>
                        <a href='editar_coche.php?id={$row['id_coche']}' class='accion-boton accion-modificar'>Modificar</a>
                        <a href='borrar_coche.php?id={$row['id_coche']}' class='accion-boton accion-eliminar'>Eliminar</a>
                   </td>

                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No hay coches registrados.</p>";
    }
    ?>

    <h2>Agregar Coche</h2>
    <form method="POST">
        <input type="text" name="marca" placeholder="Marca" required>
        <input type="text" name="modelo" placeholder="Modelo" required>
        <input type="text" name="color" placeholder="Color" required>
        <input type="number" name="precio" placeholder="Precio" required>
        <button type="submit" name="agregar">Agregar Coche</button>
    </form>

    <?php
    // Procesar alta de coche
    if (isset($_POST['agregar'])) {
        $marca = htmlspecialchars($_POST['marca']);
        $modelo = htmlspecialchars($_POST['modelo']);
        $color = htmlspecialchars($_POST['color']);
        $precio = $_POST['precio'];

        $sql = "INSERT INTO coches (marca, modelo, color, precio) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, "sssd", $marca, $modelo, $color, $precio);
        if (mysqli_stmt_execute($stmt)) {
            echo "Coche agregado exitosamente.";
        } else {
            echo "Error al agregar coche.";
        }
        mysqli_stmt_close($stmt);
    }

    mysqli_close($conexion);
    ?><br><br>

    <!-- Botón de Volver al Menú -->
    <form action="index.php" method="post">
            <input type="submit" value="Volver">
        </form>

</body>
</html>
