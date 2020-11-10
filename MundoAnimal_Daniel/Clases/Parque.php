<?php

/**
 * Parque con animales en un vector que representa los distintos sectores
 *
 * @author daniel
 */
require_once 'Clases/Animal.php';
require_once 'Clases/Gato.php';
require_once 'Clases/Perro.php';
require_once 'Clases/Elefante.php';

class Parque {

    //----------------------------------VARIABLE
    private $sectores = [];

    //----------------------------------CONSTRUCTOR
    function __construct($tamano) {
        $this->sectores = $this->generarSectores($tamano);
    }

    //----------------------------------MÉTODOS PRIVADOS
    private function generarSectores($tamano) {
        $tablero = [];
        for ($i = 0; $i < $tamano; $i++) {
            $tablero[] = false;
        }
        return $tablero;
    }

    private function elegirNombre() {
        $nombres = ['Pepe', 'Coco', 'Chupi', 'Trello', 'Linux', 'Debian', 'Emule'];
        $alea = rand(0, count($nombres) - 1);
        return $nombres[$alea];
    }

    private function elegirRaza($tipoAnimal) {
        if ($tipoAnimal == 'perro') {
            $nombres = ['Bichón Maltés', 'Pastor alemán', 'Pitbull'];
            $alea = rand(0, count($nombres) - 1);
            $respuesta = $nombres[$alea];
        } else if ($tipoAnimal == 'gato') {
            $nombres = ['Persa', 'Egipcio', 'Ragdoll'];
            $alea = rand(0, count($nombres) - 1);
            $respuesta = $nombres[$alea];
        } else if ($tipoAnimal == 'elefante') {
            $nombres = ['Asiático', 'Africano'];
            $alea = rand(0, count($nombres) - 1);
            $respuesta = $nombres[$alea];
        }
        return $respuesta;
    }

    private function elegirColor() {
        $colores = ['rojo', 'azul', 'verde', 'negro', 'blanco'];
        $alea = rand(0, count($colores) - 1);
        return $colores[$alea];
    }

    //----------------------------------MÉTODOS PÚBLICOS

    /**
     * Los animales hacen cosas
     */
    public function hacerCosas() {
        for ($i = 0; $i < count($this->sectores); $i++) {
            if ($this->sectores[$i]) {
                $alea = rand(1,3);
                switch ($alea){
                    case 1:
                        $this->sectores[$i]->comer();
                        break;
                    case 2:
                        $this->sectores[$i]->dormir();
                        break;
                    case 3:
                        $this->sectores[$i]->hacerRuido();
                        break;
                }
            }
        }
    }

    /**
     * Un animal aleatorio abandona el parque
     */
    public function abandonar() {
        $elegido = false;
        while (!$elegido) {
            $alea = rand(0, count($this->sectores - 1));
            if (!$this->sectores[$alea]) {
                $elegido = true;
                echo 'El animal ' . $this->sectores[$alea]->getNombre() . ' abandona el parque.' . '<br>';
                $this->sectores[$alea] = false;
            }
        }
    }

    /**
     * Introduce un nuevo animal (aleatorio) en el parque
     */
    public function nuevoAnimal() {
        $alea = rand(1, 3);
        switch ($alea) {
            case 1:
                $animal = new Perro($this->elegirNombre(), $this->elegirRaza('perro'), rand(1, 30), $this->elegirColor());
                break;
            case 2:
                $animal = new Gato($this->elegirNombre(), $this->elegirRaza('gato'), rand(1, 30), $this->elegirColor());
                break;
            case 3:
                $animal = new Elefante($this->elegirNombre(), $this->elegirRaza('elefante'), rand(1, 30), $this->elegirColor());
                break;
        }
        echo 'Ha llegado el animal ' . $animal->getNombre() . '<br>';
        $encajado = false;
        $i = 0;
        while (!$encajado && $i < count($this->sectores)) {
            if ($this->sectores[$i] == false) {
                $encajado = true;
                $this->sectores[$i] = $animal;
            }
            $i++;
        }

        if ($encajado) {
            echo 'El animal ' . $animal . ' se ha quedado en el parque.' . '<br>';
        } else {
            echo 'El animal ' . $animal . ' no ha encontrado espacio. Se va.' . '<br>';
        }
    }

    /**
     * Coge un animal aleatorio y hace que se mueva de sitio
     */
    public function mover() {
        $elegido = false;
        while (!$elegido) {
            $alea = rand(0, (count($this->sectores) - 1));
            if ($this->sectores[$alea]) {
                $elegido = true;
                $noSeHaPodidoMover = false;
                //Hemos elegido un animal aleatorio
                if ($alea == 0) {
                    if (!$this->sectores[1]) {
                        //El animal en cuestión está en el primer sector y el segundo está libre
                        $this->sectores[1] = $this->sectores[0];
                        $this->sectores[0] = false;
                        echo 'El animal ' . $this->sectores[1]->getNombre() . ' se ha movido.' . '<br>';
                    } else {
                        $noSeHaPodidoMover = true;
                    }
                } else if ($alea == (count($this->sectores) - 1)) {
                    if (!$this->sectores[(count($this->sectores) - 2)]) {
                        //El animal en cuestión está en el último sector y el penúltimo está libre
                        $this->sectores[count($this->sectores) - 2] = $this->sectores[count($this->sectores) - 1];
                        $this->sectores[count($this->sectores) - 1] = false;
                        echo 'El animal ' . $this->sectores[count($this->sectores) - 2]->getNombre() . ' se ha movido.' . '<br>';
                    } else {
                        $noSeHaPodidoMover = true;
                    }
                } else {
                    //El animal en cuestión no está en el último ni el primer sector
                    if (!$this->sectores[$alea - 1]) {
                        //El sector a su izquierda está libre
                        $this->sectores[$alea - 1] = $this->sectores[$alea];
                        $this->sectores[$alea] = false;
                        echo 'El animal ' . $this->sectores[$alea - 1]->getNombre() . ' se ha movido.' . '<br>';
                    } else if (!$this->sectores[$alea + 1]) {
                        //El sector a la derecha está libre
                        $this->sectores[$alea + 1] = $this->sectores[$alea];
                        $this->sectores[$alea] = false;
                        echo 'El animal ' . $this->sectores[$alea + 1]->getNombre() . ' se ha movido.' . '<br>';
                    } else {
                        $noSeHaPodidoMover = true;
                    }
                }

                if ($noSeHaPodidoMover) {
                    echo 'El animal ' . $this->sectores[$alea]->getNombre() . ' no se ha podido mover.' . '<br>';
                }
            }
        }
    }

    //----------------------------------TO STRING
    public function __toString() {
        $mensaje = '<div class="contenedor">';
        for ($i = 0; $i < count($this->sectores); $i++) {
            $mensaje = $mensaje . '<div class="sector"><p>';
            if ($this->sectores[$i]) {
                $mensaje = $mensaje . $this->sectores[$i];
            }
            $mensaje = $mensaje . '</p></div>';
        }
        $mensaje = $mensaje . '</div><br>';
        return $mensaje;
    }

}
