<!DOCTYPE html>
<!--
Daniel Sánchez
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
            echo $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
        }
        ?>
        <h3>Configura tu tablero</h3>
        <form name="configTablero" action="juego.php" method="POST">
            <input type="number" name="tamano" placeholder="Tamaño del tablero"><br>
            <input type="number" name="nMoscas" placeholder="Nº de moscas"><br>
            <input type="number" name="nIntentos" placeholder="Nº de intentos"><br>
            <input type="submit" name="configTablero" value="Jugar">
        </form>
        <br>
        <p>
            Recuerda que el tablero debe cumplir las siguientes condiciones:<br>
            -El tamaño y el nº de moscas deben ser mayores que 0<br>
            -El nº de moscas debe ser igual o menor que el tamaño del tablero<br>
            -El tablero debe tener un tamaño igual o menor que 100<br>
            -El nº de intentos debe ser igual o mayor que 1
        </p>
    </body>
</html>
