<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encripta la contraseña
    $tipo_usuario = $_POST['tipo_usuario'];
    $saldo = $_POST['saldo']; // Recoge el saldo del formulario

    $sql = "INSERT INTO usuarios (nombre, email, password, tipo_usuario, saldo) 
            VALUES ('$nombre', '$email', '$password', '$tipo_usuario', '$saldo')";

    if (mysqli_query($conexion, $sql)) {
        header("Location: login.php");
        exit();
    } else {
        echo "<p>Error en el registro: " . mysqli_error($conexion) . "</p>";
    }

    mysqli_close($conexion);
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    <h1>Registro de Usuario</h1>
    <form action="registro.php" method="post">
    <label>Nombre:</label>
    <input type="text" name="nombre" required><br><br>

    <label>Email:</label>
    <input type="email" name="email" required><br><br>

    <label>Contraseña:</label>
    <input type="password" name="password" required><br><br>

    <label>Saldo Inicial (€):</label>
    <input type="number" name="saldo" min="0" step="0.01" required><br><br>

    <label>Tipo de Usuario:</label>
    <select name="tipo_usuario">
        <option value="Comprador">Comprador</option>
        <option value="Vendedor">Vendedor</option>
    </select><br><br>

    <input type="submit" value="Registrar">
</form><br>

    <form action="index.php" method="post">
        <input type="submit" value="Volver">
    </form>
</body>
</html>
