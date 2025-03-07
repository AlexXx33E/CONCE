<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($conexion, $sql);
    $usuario = mysqli_fetch_assoc($resultado);

    if ($usuario && password_verify($password, $usuario['password'])) { // ✅ Verifica correctamente la contraseña encriptada
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
        $_SESSION['saldo'] = $usuario['saldo'];

        header("Location: index.php");
        exit();
    } else {
        echo "<p style='color:red;'>Usuario o contraseña incorrectos.</p>";
    }
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <form action="login.php" method="post">
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Contraseña:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Ingresar">
    </form>
    <form action="index.php" method="post">
        <input type="submit" value="Volver">
    </form>
</body>
</html>
