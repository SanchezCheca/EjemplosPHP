<?php

/**
 * Clase abstracta Animal. Ideal para crear otros animales.
 *
 * @author daniel
 */
abstract class Animal {

    //----------------------------------VARIABLES
    protected $nombre;
    protected $raza;
    protected $peso;
    protected $color;

    //----------------------------------CONSTRUCTOR
    function __construct($nombre, $raza, $peso, $color) {
        $this->nombre = $nombre;
        $this->raza = $raza;
        $this->peso = $peso;
        $this->color = $color;
    }

    //----------------------------------MÉTODOS PÚBLICOS
    public function vacunar() {
        echo $this->nombre . ' ha sido vacunado.' . '<br>';
    }
    
    public function comer() {
        echo $this->nombre . ' está comiendo.' . '<br>';
    }
    
    public function dormir() {
        echo $this->nombre . ' se va a dormir.' . '<br>';
    } 
    
    //----------------------------------MÉTODOS ABSTRACTOS
    public abstract function hacerRuido();
    
    public abstract function hacerCaso();

    //----------------------------------GET & SET
    function getNombre() {
        return $this->nombre;
    }

    function getRaza() {
        return $this->raza;
    }

    function getPeso() {
        return $this->peso;
    }

    function getColor() {
        return $this->color;
    }
    
}
