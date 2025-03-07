<?php
include 'db.php';

$email = 'gabriel@gmail.com'; // Usa el email del usuario que intentas ingresar
$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$resultado = mysqli_query($conexion, $sql);

if ($usuario = mysqli_fetch_assoc($resultado)) {
    echo "Usuario encontrado:<br>";
    echo "ID: " . $usuario['id_usuario'] . "<br>";
    echo "Email: " . $usuario['email'] . "<br>";
    echo "Contraseña en base de datos: " . $usuario['password'] . "<br>";
} else {
    echo "❌ No se encontró el usuario.";
}
?>
