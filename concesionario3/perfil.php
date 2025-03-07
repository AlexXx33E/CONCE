<?php
session_start();
include 'db.php'; // Conectar con la base de datos

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    echo "<p>Error: No hay un usuario logueado.</p>";
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

// Obtener los datos del usuario desde la base de datos
$sql_usuario = "SELECT * FROM usuarios WHERE id_usuario = '$id_usuario'";
$resultado_usuario = mysqli_query($conexion, $sql_usuario);
$usuario = mysqli_fetch_assoc($resultado_usuario);

// Verificar si el usuario existe
if (!$usuario) {
    echo "<p>Error: No se encontraron datos del usuario en la base de datos.</p>";
    exit();
}

// Obtener los coches alquilados por el usuario
$sql_alquileres = "SELECT alquileres.id_alquiler, coches.id_coche, coches.modelo, coches.marca, coches.color 
                   FROM alquileres 
                   JOIN coches ON alquileres.id_coche = coches.id_coche 
                   WHERE alquileres.id_usuario = '$id_usuario' AND alquileres.devuelto IS NULL";

$alquileres = mysqli_query($conexion, $sql_alquileres);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

    <h1>Mi Perfil</h1>

    <!-- Contenedor del perfil -->
    <div class="perfil-container">
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($usuario['nombre']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>
        <p><strong>Saldo:</strong> €<?php echo number_format($usuario['saldo'], 2); ?></p>
        <p><strong>Tipo de Usuario:</strong> <?php echo ucfirst(htmlspecialchars($usuario['tipo_usuario'])); ?></p>

        <!-- Mostrar coches alquilados -->
        <h2>Coches Alquilados</h2>
        <?php if (mysqli_num_rows($alquileres) > 0) { ?>
            <table>
                <tr>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Color</th>
                    <th>Acción</th>
                </tr>
                <?php while ($coche = mysqli_fetch_assoc($alquileres)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($coche['modelo']); ?></td>
                        <td><?php echo htmlspecialchars($coche['marca']); ?></td>
                        <td><?php echo htmlspecialchars($coche['color']); ?></td>
                        <td>
                            <form action="devolver_coche.php" method="post">
                                <input type="hidden" name="id_alquiler" value="<?php echo $coche['id_alquiler']; ?>">
                                <input type="hidden" name="id_coche" value="<?php echo $coche['id_coche']; ?>">
                                <input type="submit" value="Devolver">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php } else { ?>
            <p>No tienes coches alquilados.</p>
        <?php } ?>

        <!-- Botón de Cerrar Sesión -->
        <form action="logout.php" method="post">
            <input type="submit" value="Cerrar Sesión" class="logout-btn">
        </form><br>

        <!-- Botón de Volver -->
        <form action="index.php" method="post">
            <input type="submit" value="Volver">
        </form>
    </div>

</body>
</html>
