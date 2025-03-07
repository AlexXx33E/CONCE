<?php
session_start();
include 'db.php';

$sql = "SELECT * FROM coches";
$consulta = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Coches</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">

</head>
<body>
    <h1>Listado de Coches</h1>

    <?php if (mysqli_num_rows($consulta) > 0) { ?>
        <table border='1'>
    <tr>
        <th>Imagen</th>
        <th>Modelo</th>
        <th>Marca</th>
        <th>Color</th>
        <th>Precio</th>
        <th>Estado</th>
        <?php if (isset($_SESSION['id_usuario'])) { ?>
            <th>Acción</th>
        <?php } ?>
    </tr>
    <?php while ($fila = mysqli_fetch_assoc($consulta)) { ?>
        <tr>
            <td>
                <img src="<?php echo $fila['foto']; ?>" alt="Coche" width="100">
            </td>
            <td><?php echo $fila['modelo']; ?></td>
            <td><?php echo $fila['marca']; ?></td>
            <td><?php echo $fila['color']; ?></td>
            <td><?php echo number_format($fila['precio'], 2); ?> €</td>
            <td>
                <?php echo ($fila['alquilado'] == 1) ? "🔴 Alquilado" : "🟢 Disponible"; ?>
            </td>
            <?php if (isset($_SESSION['id_usuario'])) { ?>
                <td>
                    <?php if ($fila['alquilado'] == 0) { ?>
                        <form action="alquilar_coche.php" method="post">
                            <input type="hidden" name="id_coche" value="<?php echo $fila['id_coche']; ?>">
                            <input type="submit" value="Alquilar">
                        </form>
                    <?php } else { ?>
                        <p style="color: red;">No disponible</p>
                    <?php } ?>
                </td>
            <?php } ?>
        </tr>
    <?php } ?>
</table>

    <?php } else { ?>
        <p>No hay coches disponibles en este momento.</p>
    <?php } ?>

    <form action="coches.php" method="post">
        <input type="submit" value="Volver">
    </form>
</body>
</html>
