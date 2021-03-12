<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once 'Tablero.php';
        session_start();
        

        //Carga el tablero de la sesión
        if (isset($_SESSION['tablero'])) {
            $tablero = $_SESSION['tablero'];
        } else {
            //Ha ocurrido algún error, vuelve a inicio
            $mensaje = 'Ha ocurrido algún error. Hemos perdido el tablero<br>';
            $_SESSION['mensaje'] = $mensaje;
            header('Location: index.php');
        }


        //Viene de dar un golpe
        $partidaTerminada = false;
        if (isset($_REQUEST['casilla'])) {
            $posicion = $_REQUEST['casilla'];
            if ($tablero->meLaHeCargado($posicion)) {
                if ($tablero->getNMoscas() == 0) {
                    echo '¡HAS GANADO! Ya no quedan moscas con vida<br>';
                    $partidaTerminada = true;
                } else {
                    echo '¡Has matado una mosca! El resto se han asustado<br>';
                    $tablero->repartirMoscas();
                }
                $_SESSION['tablero'] = $tablero;
            } else if ($tablero->getIntentos() == 0) {
                echo '¡Has perdido! Te has quedado sin intentos. Quedaba(n) ' . $tablero->getNMoscas() . ' mosca(s)';
                $partidaTerminada = true;
            } else {
                if ($tablero->casiLeDoy($posicion)) {
                    echo '¡Casi! Las moscas han cambiado de posición<br>';
                    $tablero->repartirMoscas();
                    $_SESSION['tablero'] = $tablero;
                } else {
                    echo '¡Has fallado! Sigue intentando<br>';
                }
            }
        }

        if (!$partidaTerminada) {
            echo 'Te queda(n) ' . $tablero->getIntentos() . ' intento(s)<br>';
            echo 'Queda(n) ' . $tablero->getNMoscas() . ' mosca(s)<br>';
            echo $tablero;
        }
        ?>
        <br>
        <a href="index.php">Volver</a>
    </body>
</html>
