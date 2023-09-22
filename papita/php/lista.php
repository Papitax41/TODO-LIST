<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>MANTENIMIENTO PRODUCTO</title>
</head>
<center>

    <body>
        <header>
            <h3>LISTADO DE CLIENTES</h3>
        </header>
        <section>
            <?php
            require('conexion.php');
            session_start(); // Iniciar la sesión
            if (isset($_SESSION['usuario1'])) {
                $usuario1 = $_SESSION['usuario1'];
                $sql = "SELECT * FROM listas L INNER JOIN usuario U ON L.USUARIO = U.USUARIO
                WHERE U.USUARIO = '$usuario1'";
                $resultado = mysqli_query($conexion, $sql);

                if ($resultado) {
                    $numero_registros = mysqli_num_rows($resultado);

                    echo $usuario1;
                } else {
                    // Manejar el caso en el que la consulta SQL no se ejecute correctamente
                    echo "Error en la consulta: " . mysqli_error($conexion);
                }
            } else {
                // Manejar el caso en el que la variable de sesión no esté definida
            }
            ?>
            <table>
                <tr>
                    <td align="left">
                        <input type="text" name="Tarea" placeholder="Tarea">
                        <input type="submit" name="btnTarea" value="Agregar" class="btn btn-primary">

                    </td>
                </tr>
            </table>
            <table border="0" cellpading="5" cellspacing="0" width="550" class="table table-hover">
                <table border="0" width="550">
                    <tr>
                        <td>nro</td>
                        <td>Tarea</td>
                        <td>Accion</td>
                    </tr>
                    <?php foreach ($resultado as $r) : ?>
                        <tr>
                            <td><?php echo $r['id']; ?></td>
                            <td><?php echo $r['task']; ?></td>
                            <td>
                                <input type="submit" name="btnEditar" value="Editar" class="btn btn-primary">
                                <input type="submit" name="btnEliminar" value="Eliminar" class="btn btn-danger">
                            </td>
                            <td><?php $r['USUARIO']; ?></td>

                        </tr>
                    <?php endforeach; ?>
                </table>
        </section>
        <footer>
            <h6>Todos los derechos reservados @2023</h6>
        </footer>
    </body>
</center>

</html>