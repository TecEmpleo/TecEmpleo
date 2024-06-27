<?php
$host = 'localhost';
$usuario = 'root';
$contrasena = '';
$base_datos = 'tecempleo';

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}
?>
