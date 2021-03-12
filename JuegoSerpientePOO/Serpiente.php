<?php

/**
 * Serpiente que crece, muda, decrece y se muere
 *
 * @author daniel
 */
class Serpiente {

    //-----------------------VARIABLES
    private $nombre;
    private $vive;
    private $cuerpo;
    private $edad;

    //-----------------------CONSTRUCTOR
    function __construct($nombre) {
        $this->nombre = $nombre;
        $this->vive = true;
        $this->cuerpo = [$this->elegirColor()];
        $this->edad = 1;
    }

    //-----------------------FUNCIONES PRIVADAS
    private function elegirColor() {
        $alea = rand(1, 9);
        switch ($alea) {
            case 1:
                $color = 'red';
                break;
            case 2:
                $color = 'green';
                break;
            case 3:
                $color = 'blue';
                break;
            case 4:
                $color = 'aquamarine';
                break;
            case 5:
                $color = 'black';
                break;
            case 6:
                $color = 'brown';
                break;
            case 7:
                $color = 'darkolivegreen';
                break;
            case 8:
                $color = 'gold';
                break;
            case 9:
                $color = 'magenta';
                break;
        }
        return $color;
    }

    //-----------------------FUNCIONES PÚBLICAS
    public function envejecer() {
        $this->edad++;
    }

    /**
     * La serpiente crece en 1
     */
    public function crecer() {
        $this->cuerpo[] = $this->elegirColor();
    }

    /**
     * La serpiente decrece en 1 y se muere si se queda sin cuerpo
     */
    public function decrecer() {
        array_pop($this->cuerpo);
        if (sizeof($this->cuerpo) == 0) {
            $this->morir();
        }
    }
    
    /**
     * La serpiente se muere :(
     */
    public function morir() {
        $this->vive = false;
    }

    /**
     * La serpiente cambia todos los colores de su cuerpo
     */
    public function mudar() {
        foreach ($this->cuerpo as $i => $valor) {
            $this->cuerpo[$i] = $this->elegirColor();
        }
    }

    //-----------------------GET & SET
    function getNombre() {
        return $this->nombre;
    }

    function isVive() {
        return $this->vive;
    }

    function getCuerpo() {
        return $this->cuerpo;
    }

    function getEdad() {
        return $this->edad;
    }

    //-----------------------TO STRING
    public function __toString() {
        $cadena = '';
        foreach ($this->cuerpo as $valor) {
            $cadena = $cadena . '<div class="anillo" style="background-color: ' . $valor . '"></div>';
        }

        $cadena = $cadena . '<br>';
        return $cadena;
    }

}
