<?php
/**
 * Description of Elefante
 *
 * @author daniel
 */

include_once 'Animal.php';

class Elefante extends Animal {
    
    //----------------------------------CONSTRUCTOR
    function __construct($nombre, $raza, $peso, $color) {
        parent::__construct($nombre, $raza, $peso, $color);
    }

    //----------------------------------MÉTODOS OBLIGATORIOS
    /**
     * El elefante hace caso el 0.5% de las veces
     */
    public function hacerCaso() {
        $alea = rand(1,1000);
        if ($alea <= 5) {
            echo 'El elefante ' . $this->nombre . ' te está haciendo caso.' . '<br>';
        } else {
            echo 'El elefante ' . $this->nombre . ' está pasando de ti.' . '<br>';
        }
    }

    public function hacerRuido() {
        echo 'El elefante ' . $this->nombre . ' barrita.' . '<br>';
    }

    //----------------------------------MÉTODOS OBLIGATORIOS
    public function __toString() {
        return '[ELEFANTE] ' . $this->nombre . ', ' . $this->raza . ', ' . $this->peso . 'Kg, ' . $this->color;
    }
    
}
