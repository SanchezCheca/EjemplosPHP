<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //Muestra un mensaje de error si lo hay en la sesión
        session_start();
        if (isset($_SESSION['mensaje'])) {
            $mensaje = $_SESSION['mensaje'];
            echo $mensaje . '<br>';
            unset($_SESSION['mensaje']);
        }
        ?>

        <form name="inicioSesion" action="Controladores/controladorPrincipal.php" method="POST">
            <input type="email" name="correo" placeholder="Correo electrónico" required><br>
            <input type="password" name="pass" placeholder="Contraseña" required><br>
            <input type="submit" name="inicioSesion" value="Iniciar sesión">
        </form>
        <a href="Vistas/registro.php">Registrarse</a>
    </body>
</html>
