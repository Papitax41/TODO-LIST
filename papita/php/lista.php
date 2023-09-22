<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>TASK</title>
</head>
<center>
<body>
    <header>
        <h3>LISTADO DE TAREAS</h3>
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
            $filas = mysqli_num_rows($resultado);

            // Agregar tarea
            if (isset($_POST['btnTarea'])) {
                $tarea = $_POST['Tarea'];

                $sqlInsert = "INSERT INTO listas (USUARIO, task) VALUES ('$usuario1', '$tarea');";
                $resultadoInsert = mysqli_query($conexion, $sqlInsert);

                if ($resultadoInsert) {
                    header("Location: $_SERVER[PHP_SELF]"); 
                    exit();
                } else {
                    echo "Ocurrió un error " . mysqli_error($conexion);
                }
            }

            // Eliminar tarea
            if (isset($_POST['btnEliminar'])) {
                $tareaId = $_POST['tareaId']; 

                $sqlDelete = "DELETE FROM listas WHERE id = $tareaId AND USUARIO = '$usuario1';";
                $resultadoDelete = mysqli_query($conexion, $sqlDelete);

                if ($resultadoDelete) {
                    header("Location: $_SERVER[PHP_SELF]"); 
                    exit();
                } else {
                    echo "Ocurrió un error al eliminar la tarea: " . mysqli_error($conexion);
                }
            }

            // Editar tarea
            if (isset($_POST['btnEditar'])) {
                $tareaIdEditar = $_POST['tareaId'];
            }

            // Guardar tarea editada
            if (isset($_POST['btnGuardar'])) {
                $nuevaTarea = $_POST['nuevaTarea'];
                $tareaId = $_POST['tareaId'];

                $sqlUpdate = "UPDATE listas SET task = '$nuevaTarea' WHERE id = $tareaId AND USUARIO = '$usuario1';";
                $resultadoUpdate = mysqli_query($conexion, $sqlUpdate);

                if ($resultadoUpdate) {
                    header("Location: $_SERVER[PHP_SELF]"); 
                    exit();
                } else {
                    echo "Ocurrió un error al editar la tarea: " . mysqli_error($conexion);
                }
            }

            if ($resultado) {

            } else {
                echo "Error en la consulta: " . mysqli_error($conexion);
            }
        } else {
        }
        ?>
        <form method="POST">
            <table>
                <tr>
                    <td align="left">
                        <input type="text" name="Tarea" placeholder="Tarea">
                        <input type="submit" name="btnTarea" value="Agregar" class="btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <table border="0" cellpadding="5" cellspacing="0" width="550" class="table table-hover">
            <table border="0" width="550">
                <tr>
                    <td>Tarea</td>
                    <td>Accion</td>
                </tr>
                <?php foreach ($resultado as $r) : ?>
                    <tr>
                        <td>
                            <?php if (isset($tareaIdEditar) && $tareaIdEditar == $r['id']) : ?>
                                <form method="POST">
                                    <input type="text" name="nuevaTarea" value="<?php echo $r['task']; ?>">
                                    <input type="hidden" name="tareaId" value="<?php echo $r['id']; ?>">
                                    <input type="submit" name="btnGuardar" value="Guardar" class="btn btn-success">
                                </form>
                            <?php else : ?>
                                <?php echo $r['task']; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="tareaId" value="<?php echo $r['id']; ?>">
                                <?php if (!isset($tareaIdEditar) || $tareaIdEditar != $r['id']) : ?>
                                    <input type="submit" name="btnEditar" value="Editar" class="btn btn-primary">
                                <?php endif; ?>
                                <input type="submit" name="btnEliminar" value="Eliminar" class="btn btn-danger">
                            </form>
                        </td>
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