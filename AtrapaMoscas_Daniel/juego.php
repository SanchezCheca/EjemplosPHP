<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();
        require 'funciones.php';

        //Si viene del formulario de inicio, inicia el tablero. Si no, lo carga
        if (isset($_REQUEST['configTablero'])) {
            $tamano = $_REQUEST['tamano'];
            $nMoscas = $_REQUEST['nMoscas'];
            $intentos = $_REQUEST['nIntentos'];

            if (validarConfiguracion($tamano, $nMoscas, $intentos)) {
                $tablero = iniciarTablero($tamano, $nMoscas);

                $_SESSION['tablero'] = $tablero;
                $_SESSION['nMoscas'] = $nMoscas;
                $_SESSION['intentos'] = $intentos;

                echo 'Empieza el juego<br>';
            } else {
                $mensaje = 'La configuración del tablero no es correcta<br>';
                $_SESSION['mensaje'] = $mensaje;
                header('Location: index.php');
            }
        } else if (isset($_SESSION['tablero']) && isset($_SESSION['nMoscas'])) {
            $tablero = $_SESSION['tablero'];
            $nMoscas = $_SESSION['nMoscas'];
            $intentos = $_SESSION['intentos'];
        } else {
            //Ha ocurrido algún error, vuelve a inicio
            header('Location: index.php');
        }

        
        //Viene de dar un golpe
        $partidaTerminada = false;
        if (isset($_REQUEST['casilla'])) {
            $posicion = $_REQUEST['casilla'];
            if (meLaHeCargado($tablero, $posicion)) {
                if ($nMoscas == 1) {
                    echo '¡HAS GANADO! Ya no quedan moscas con vida<br>';
                    $partidaTerminada = true;
                } else {
                    echo '¡Has matado una mosca! El resto se han asustado<br>';
                    repartirMoscas($tablero, $nMoscas-1);
                }
                $nMoscas--;
                $_SESSION['nMoscas'] = $nMoscas;
                $_SESSION['tablero'] = $tablero;
            } else if ($intentos == 1) {
                echo '¡Has perdido! Te has quedado sin intentos. Quedaba(n) ' . $nMoscas . ' mosca(s)';
                $partidaTerminada = true;
            } else {
                if (casiLeDoy($tablero, $posicion)) {
                    echo '¡Casi! Las moscas han cambiado de posición<br>';
                    repartirMoscas($tablero, $nMoscas);
                    $_SESSION['tablero'] = $tablero;
                } else {
                    echo '¡Has fallado! Sigue intentando<br>';
                }
                $intentos--;
                $_SESSION['intentos'] = $intentos;
            }
        }

        //DESCOMENTAR LAS SIGUIENTES LÍNEAS PARA TENER UNA CHULETA DEL TABLERO
//        foreach ($tablero as $i => $valor) {
//            if ($valor) {
//                echo $i . ': M | ';
//            } else {
//                echo $i . ': 0 | ';
//            }
//        }
//        echo '<br>';

        if (!$partidaTerminada) {
            echo 'Te queda(n) ' . $intentos . ' intento(s)<br>';
            echo 'Queda(n) ' . $nMoscas . ' mosca(s)<br>';
            echo pintarTablero($tablero);
        }
        ?>
        <br>
        <a href="index.php">Volver</a>
    </body>
</html>
