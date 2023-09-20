<?php

$servidor = "localhost";
$usuario = "root";
$contraseña = "123456";
$base_de_datos = "bd_usuario";

$conexion = mysqli_connect($servidor, $usuario, $contraseña, $base_de_datos);

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

//mysqli_close($conexion);
?>
