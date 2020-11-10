<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //Comprueba si hay usuario iniciado y es administrador. Si no, devuelve a inicio
        require_once '../Recursos/Usuario.php';
        require_once '../Recursos/Conexion.php';
        session_start();

        if (isset($_SESSION['usuarioIniciado'])) {
            $usuario = $_SESSION['usuarioIniciado'];
            if ($usuario->getRol() == 1) {
                //ES un usuario administrador, se pinta el CRUD
                //SE PINTA UN MENSAJE DE INFORMACIÓN SI LO HAY
                if (isset($_SESSION['mensaje'])) {
                    echo $_SESSION['mensaje'];
                    echo '<hr>';
                    unset($_SESSION['mensaje']);
                }

                //SE PINTA UN FORMULARIO PARA REGISTRAR NUEVOS USUARIOS
                ?>
                <h3>Insertar un nuevo usuario</h3>
                <form name="registro" action="../Controladores/controladorCRUD.php" method="POST">
                    <input type="text" name="nombre" placeholder="Nombre" required><br>
                    <input type="email" name="correo" placeholder="Correo electrónico" required><br>
                    <input type="password" name="pass" placeholder="Contraseña" required><br>
                    <input type="submit" name="registro" value="Registrar usuario">            
                </form>
                <hr>

                <?php
                //SE PINTA EL CRUD EN SI MISMO
                echo '<h3>Modificar usuarios existentes</h3>';
                $usuarios = Conexion::recuperarTodosLosUsuarios();
                for ($i = 1; $i < count($usuarios); $i++) {
                    ?>
                    <form name="CRUD" action="../Controladores/controladorCRUD.php" method="POST">
                        <!-- NOTA: El campo oculto id lleva el correo que está en la BD.
                        De este modo se puede modificar el correo sin tener problemas de acceso a BD.
                        -->
                        <input type="hidden" name="id" value="<?php echo $usuarios[$i]->getCorreo() ?>">
                        <input type="text" name="nombre" value="<?php echo $usuarios[$i]->getNombre() ?>">
                        <input type="text" name="correo" value="<?php echo $usuarios[$i]->getCorreo() ?>">
                        <input type="text" name="rol" value="<?php echo $usuarios[$i]->getRol() ?>">
                        <input type="submit" name="actualizar" value="Actualizar">
                        <input type="reset" value="Restablecer">
                        <input type="submit" name="eliminar" value="ELIMINAR">
                    </form>
                    <br>
                    <?php
                }
            } else {
                $mensaje = 'No tienes permiso para ver esa página, no eres un administrador.<br>';
                $_SESSION['mensaje'] = $mensaje;
                header('Location: ../index.php');
            }
        } else {
            $mensaje = 'No has iniciado sesión. Por favor, inicia sesión.<br>';
            $_SESSION['mensaje'] = $mensaje;
            header('Location: ../index.php');
        }
        ?>
        <br>
        <a href="../index.php">Volver</a>
    </body>
</html>
