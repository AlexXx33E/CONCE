<?php
include 'db.php';
if ($conexion) {
    echo "Conexión exitosa a la base de datos.";
} else {
    echo "Error en la conexión.";
}
?>
