<?php
$password_nueva = "admin123"; // Cambia la contraseña si lo deseas
$hash_nuevo = password_hash($password_nueva, PASSWORD_BCRYPT);
echo "Nuevo Hash: " . $hash_nuevo;
?>
