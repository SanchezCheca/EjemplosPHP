<?php

/**
 * Perro
 *
 * @author daniel
 */

include_once 'Animal.php';

class Perro extends Animal{
    
    //----------------------------------CONSTRUCTOR
    function __construct($nombre, $raza, $peso, $color) {
        parent::__construct($nombre, $raza, $peso, $color);
    }
    
    //----------------------------------MÉTODOS PÚBLICOS
    public function sacarPaseo() {
        echo 'El perro ' . $this->nombre . ' sale de paseo.' . '<br>';
    }

    //----------------------------------MÉTODOS OBLIGATORIOS
    /**
     * El perro hace caso el 90% de las veces
     */
    public function hacerCaso() {
        $alea = rand(1,100);
        if ($alea <= 90) {
            echo 'El perro ' . $this->nombre . ' te está haciendo caso.' . '<br>';
        } else {
            echo 'El perro ' . $this->nombre . ' está pasando de ti.' . '<br>';
        }
    }

    public function hacerRuido() {
        echo 'El perro ' . $this->nombre . ' ladra.' . '<br>';
    }

    //----------------------------------MÉTODOS OBLIGATORIOS
    public function __toString() {
        return '[PERRO] Nombre: ' . $this->nombre . ' - Raza: ' . $this->raza . ' - Peso: ' . $this->peso . ' - Color: ' . $this->color;
    }
    
}
