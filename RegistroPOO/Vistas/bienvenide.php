<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once '../Recursos/Usuario.php';
        session_start();

        if (isset($_SESSION['usuarioIniciado'])) {
            $usuario = $_SESSION['usuarioIniciado'];
            echo '¡Hola, ' . $usuario->getNombre() . '!<br>';
            echo 'echo de tu usuario: ' . $usuario . '<br>';
            
            //Si es admin, muestra link al CRUD
            if ($usuario->getRol() == 1) {
                echo '<a href="CRUD.php">Ir al CRUD</a><br>';
            }
            
        } else {
            $mensaje = 'No puedes entrar si no has iniciado sesión.';
            $_SESSION['mensaje'] = $mensaje;
            header("Location: ../index.php");
        }
        ?>
        <a href="../index.php">Volver</a>
    </body>
</html>
