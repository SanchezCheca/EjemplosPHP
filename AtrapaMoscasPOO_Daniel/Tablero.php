<?php

/**
 * Tablero que tiene n moscas y al que le puedes pegar
 *
 * @author daniel
 */
class Tablero {

    //------------------------------VARIABLES
    private $cuerpo;
    private $nMoscas;
    private $intentos;

    //------------------------------CONSTRUCTOR
    function __construct($tamano, $nMoscas, $intentos) {
        $this->cuerpo = $this->generarTablero($tamano, $nMoscas);
        $this->nMoscas = $nMoscas;
        $this->intentos = $intentos;
    }

    //------------------------------FUNCIONES PÚBLICAS

    /**
     * Devuelve true si le has cascado a una mosca.
     * Si la ha matado, la elimina del tablero
     * Si no la ha matado, resta un intento
     * @param type $tablero
     * @param type $posicion
     * @return boolean
     */
    public function meLaHeCargado($posicion) {
        $leHaCascado = false;
        if ($this->cuerpo[$posicion]) {
            $leHaCascado = true;
            $this->cuerpo[$posicion] = false;
            $this->nMoscas--;
        } else {
            $this->intentos--;
        }

        return $leHaCascado;
    }

    /**
     * Devuelve true si la posición es alguna casilla adyacente a cualquier mosca
     * NOTA: Debe comprobarse antes que no se le haya dado a una mosca para evitar errores
     * @param type $tablero
     * @param type $posicion
     */
    public function casiLeDoy($posicion) {
        $casiCasi = false;

        if ($posicion == 0) {
            //Comprueba la primera posición
            if ($this->cuerpo[1]) {
                $casiCasi = true;
            }
        } else if ($posicion == (count($this->cuerpo) - 1)) {
            //Comprueba la última posición
            if ($this->cuerpo[count($this->cuerpo) - 2]) {
                $casiCasi = true;
            }
        } else if ($this->cuerpo[$posicion - 1] || $this->cuerpo[$posicion + 1]) {
            //Comprueba cualquier otra posición sabiendo que no es la primera ni la última
            $casiCasi = true;
        }

        return $casiCasi;
    }

    /**
     * Reparte las moscas que haya en el tablero
     * @param type $tablero
     * @param type $nMoscas
     */
    function repartirMoscas() {
        $this->cuerpo = $this->generarTablero(count($this->cuerpo), $this->nMoscas);
    }

    //------------------------------FUNCIONES PRIVADAS

    /**
     * Devuelve un tablero con el tamaño y nº de moscas que entran
     * @param type $tamano
     * @param type $nMoscas
     */
    private function generarTablero($tamano, $nMoscas) {
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

    //------------------------------GET & SET
    function getNMoscas() {
        return $this->nMoscas;
    }

    function getIntentos() {
        return $this->intentos;
    }

    //------------------------------TO STRING
    public function __toString() {
        $mensaje = '<form name="tablero" action="juego.php" method="POST">';
        foreach ($this->cuerpo as $i => $valor) {
            $mensaje = $mensaje . '<input type="submit" name="casilla" value="' . $i . '">';
        }
        $mensaje = $mensaje . '</form>';
        return $mensaje;
    }

}
