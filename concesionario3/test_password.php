<?php
$password_ingresada = "admin123"; // La contraseña que intentas usar
$hash_en_base_de_datos = "$2y$10$7uOf.Sd0UxLq9ZPzXMvDXO27N/hDqXox.Wz6syU64xRmOhsVx1waO"; // Reemplaza con la que aparece en test_login.php

if (password_verify($password_ingresada, $hash_en_base_de_datos)) {
    echo "✅ La contraseña es correcta.";
} else {
    echo "❌ La contraseña es incorrecta.";
}
?>
