<?php
require 'conexion.php';

// Validamos que el formulario y que el boton login haya sido presionado
if(isset($_POST['login'])) {

// Obtener los valores enviados por el formulario
session_start();
$usuario1 = $_POST['nombre_user'];
$contrasena = $_POST['contrasena_user'];
$_SESSION['usuario1'] = $usuario1;

// consulta a la base de datos utilizando la función mysqli_query

$sql = "SELECT USUARIO,CLAVE FROM usuario WHERE USUARIO = '$usuario1' and CLAVE = '$contrasena'";
$resultado = mysqli_query($conexion,$sql);
$numero_registros = mysqli_num_rows($resultado);
	if($numero_registros != 0) {
		echo "Inicio de sesión exitoso. Bienvenido, " . $usuario1 . "!";
		header('location:lista.php');
	} else {
		echo "Credenciales inválidas. Por favor, verifica tu nombre de usuario y/o contraseña."."<br>";
	}
}
?>
