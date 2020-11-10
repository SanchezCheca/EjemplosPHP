<?php

/**
 * Inicia un tablero con el tamaño y nº de moscas que entran
 * @param type $tamano
 * @param type $nMoscas
 */
function iniciarTablero($tamano, $nMoscas) {
    $tablero = [];

    //Inicia el vector con el tamaño adecuado y todo a 0
    for ($i = 0; $i < $tamano; $i++) {
        $tablero[] = false;
    }

    //Coloca el nº de moscas en el vector
    for ($i = 0; $i < $nMoscas; $i++) {
        $colocado = false;

        while (!$colocado) {
            $alea = rand(0, ($tamano - 1));
            if (!$tablero[$alea]) {
                $tablero[$alea] = true;
                $colocado = true;
            }
        }
    }
    return $tablero;
}

/**
 * Devuelve true si le has cascado a una mosca.
 * Si la ha matado, la elimina del tablero
 * @param type $tablero
 * @param type $posicion
 */
function meLaHeCargado(&$tablero, $posicion) {
    $leHaCascado = false;
    if ($tablero[$posicion]) {
        $leHaCascado = true;
        $tablero[$posicion] = false;
    }
    return $leHaCascado;
}

/**
 * Devuelve true si la posición es alguna casilla adyacente a cualquier mosca
 * NOTA: Debe comprobarse antes que no se le haya dado a una mosca para evitar errores
 * @param type $tablero
 * @param type $posicion
 */
function casiLeDoy($tablero, $posicion) {
    $casiCasi = false;

    if ($posicion == 0) {
        //Comprueba la primera posición
        if ($tablero[1]) {
            $casiCasi = true;
        }
    } else if ($posicion == (count($tablero) - 1)) {
        //Comprueba la última posición
        if ($tablero[count($tablero) - 2]) {
            $casiCasi = true;
        }
    } else if ($tablero[$posicion - 1] || $tablero[$posicion + 1]) {
        //Comprueba cualquier otra posición sabiendo que no es la primera ni la última
        $casiCasi = true;
    }

    return $casiCasi;
}

/**
 * Reparte el nº de moscas indicado en el tablero haciendo uso de la función iniciarTablero
 * @param type $tablero
 * @param type $nMoscas
 */
function repartirMoscas(&$tablero, $nMoscas) {
    $tablero = iniciarTablero(count($tablero), $nMoscas);
}

/**
 * Devuelve un String para imprimir el tablero en pantalla
 * @param type $tablero
 */
function pintarTablero($tablero) {
    $mensaje = '<form name="tablero" action"juego.php" method="POST">';
    foreach ($tablero as $i => $valor) {
        $mensaje = $mensaje . '<input type="submit" name="casilla" value="' . $i . '">';
    }
    $mensaje = $mensaje . '</form>';
    return $mensaje;
}

/**
 * Devuelve falso si:
 *  Algún nº es igual o menor que 0
 *  El nº de moscas es mayor que el tamaño del tablero
 *  El tablero es mayor que 100
 *  El nº de intentos es menor que 1
 * @param type $tablero
 * @param type $nMoscas
 */
function validarConfiguracion($tamano, $nMoscas, $intentos){
    return !($tamano > 100 || $tamano < 1 || $nMoscas < 1 || $nMoscas > $tamano || $intentos < 1);
}

?>