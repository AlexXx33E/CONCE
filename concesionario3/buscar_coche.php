<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $busqueda = $_POST['busqueda'];
    $sql = "SELECT * FROM coches WHERE modelo LIKE '%$busqueda%' OR marca LIKE '%$busqueda%'";
    $consulta = mysqli_query($conexion, $sql);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Coche</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">

</head>
<body>
    <h1>Buscar Coche</h1>
    <form action="buscar_coche.php" method="post">
        <input type="text" name="busqueda" placeholder="Introduce modelo o marca" required>
        <input type="submit" value="Buscar">
    </form>

    <?php if (isset($consulta) && mysqli_num_rows($consulta) > 0) { ?>
        <h2>Resultados:</h2>
        <table border='1'>
            <tr>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Color</th>
                <th>Precio</th>
                <?php if (isset($_SESSION['id_usuario'])) { ?>
                    <th>Acción</th>
                <?php } ?>
            </tr>
            <?php while ($fila = mysqli_fetch_assoc($consulta)) { ?>
                <tr>
                    <td><?php echo $fila['modelo']; ?></td>
                    <td><?php echo $fila['marca']; ?></td>
                    <td><?php echo $fila['color']; ?></td>
                    <td><?php echo $fila['precio']; ?> €</td>
                    <?php if (isset($_SESSION['id_usuario'])) { ?>
                        <td>
                            <form action="alquilar_coche.php" method="post">
                                <input type="hidden" name="id_coche" value="<?php echo $fila['id_coche']; ?>">
                                <input type="submit" value="Alquilar">
                            </form>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
    <?php } elseif ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
        <p>No se encontraron resultados.</p>
    <?php } ?>

    <form action="coches.php" method="post">
        <input type="submit" value="Volver">
    </form>
</body>
</html>
