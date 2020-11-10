<?php

/**
 * Description of Usuario
 *
 * @author daniel
 */
class Usuario {
    //--------------------PROPIEDADES
    private $nombre;
    private $correo;
    private $rol;
    
    //--------------------CONSTRUCTOR
    function __construct($nombre, $correo, $rol) {
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->rol = $rol;
    }
    
    //--------------------GET & SET
    function getRol() {
        return $this->rol;
    }
    
    function setRol($rol) {
        $this->rol = $rol;
    }
    
    function getNombre() {
        return $this->nombre;
    }

    function getCorreo() {
        return $this->correo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    //--------------------TO STRING
    public function __toString() {
        return '[USUARIO] Nombre: ' . $this->nombre . ' - Correo: ' . $this->correo;
    }

}
