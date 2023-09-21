<?php
require 'conexion.php';

if(isset($_POST['registro'])) {

// Obtener los valores enviados por el formulario
$usuario = $_POST['nombre_user'];
$contrasena = $_POST['contrasena_user'];
$correo = $_POST['correo_user'];

$sql = "INSERT INTO usuario VALUES ('$usuario', '$contrasena', '$correo')";
$resultado = mysqli_query($conexion,$sql);
	if($resultado) {
		echo "¡Se insertaron los datos correctamente!";
	} else {
		echo "¡No se puede insertar la informacion!"."<br>";
		echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
	}
}
?>
