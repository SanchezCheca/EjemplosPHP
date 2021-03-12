<?php

require_once 'Tablero.php';
session_start();

//Viene de configurar el tablero
if (isset($_REQUEST['configTablero'])) {
    $tamano = $_REQUEST['tamano'];
    $nMoscas = $_REQUEST['nMoscas'];
    $intentos = $_REQUEST['nIntentos'];

    //La configuración es correcta, inicia el tablero y lo guarda en la sesión
    if (validarConfiguracion($tamano, $nMoscas, $intentos)) {
        
        $tablero = new Tablero($tamano, $nMoscas, $intentos);
        $_SESSION['tablero'] = $tablero;
        

        header('Location: juego.php');
    } else {
        $mensaje = 'La configuración del tablero no es correcta<br>';
        $_SESSION['mensaje'] = $mensaje;
        header('Location: index.php');
    }
}

//----------------------FUNCIONES AUXILIARES
/**
 * Devuelve falso si:
 *  Algún nº es igual o menor que 0
 *  El nº de moscas es mayor que el tamaño del tablero
 *  El tablero es mayor que 100
 *  El nº de intentos es menor que 1
 * @param type $tablero
 * @param type $nMoscas
 */
function validarConfiguracion($tamano, $nMoscas, $intentos) {
    return !($tamano > 100 || $tamano < 1 || $nMoscas < 1 || $nMoscas > $tamano || $intentos < 1);
}
