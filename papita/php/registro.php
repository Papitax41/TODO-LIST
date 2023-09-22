<?php
require 'conexion.php';

if (isset($_POST['registro'])) {

	$usuario = $_POST['nombre_user'];
	$contrasena = $_POST['contrasena_user'];
	$correo = $_POST['correo_user'];

	$consulta = "SELECT * FROM usuario WHERE USUARIO = '$usuario'";
	$resultadoConsulta = mysqli_query($conexion, $consulta);

	if (mysqli_num_rows($resultadoConsulta) > 0) {
		echo "El usuario ya existe.";
	} else {
		// El usuario no existe, inserta los datos
		$sql = "INSERT INTO usuario VALUES ('$usuario', '$contrasena', '$correo')";
		$resultado = mysqli_query($conexion, $sql);

		if ($resultado) {
			echo "¡Se insertaron los datos correctamente!";
		} else {
			echo "No se puede insertar la información." . "<br>";
			echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
		}
	}
}
