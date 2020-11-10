<?php
/**
 * Gato
 *
 * @author daniel
 */

require_once 'Animal.php';

class Gato extends Animal {
    
    //----------------------------------CONSTRUCTOR
    function __construct($nombre, $raza, $peso, $color) {
        parent::__construct($nombre, $raza, $peso, $color);
    }
    
    //----------------------------------MÉTODOS PÚBLICOS
    public function toserBolaDePelo() {
        echo 'El gato ' . $this->nombre . ' tose una bola de pelo.' . '<br>';
    }

    //----------------------------------MÉTODOS OBLIGATORIOS
    /**
     * El gato hace caso el 5% de las veces
     */
    public function hacerCaso() {
        $alea = rand(1,100);
        if ($alea <= 5) {
            echo 'El gato ' . $this->nombre . ' te está haciendo caso.' . '<br>';
        } else {
            echo 'El gato ' . $this->nombre . ' está pasando de ti.' . '<br>';
        }
    }

    public function hacerRuido() {
        echo 'El gato ' . $this->nombre . ' maulla.' . '<br>';
    }

    //----------------------------------MÉTODOS OBLIGATORIOS
    public function __toString() {
        return '[GATO] Nombre: ' . $this->nombre . ' - Raza: ' . $this->raza . ' - Peso: ' . $this->peso . ' - Color: ' . $this->color;
    }
    
}
