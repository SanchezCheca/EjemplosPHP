<?php

require_once '../Recursos/Conexion.php';
require_once '../Recursos/Usuario.php';
session_start();

//----------------------------FORMULARIO DE REGISTRO
if (isset($_REQUEST['registro'])) {
    $nombre = $_REQUEST['nombre'];
    $correo = $_REQUEST['correo'];
    $pass = $_REQUEST['pass'];
    
    if (Conexion::existeUsuario($correo)) {
        $mensaje = 'ERROR: El correo ya está registrado.';
        $_SESSION['mensaje'] = $mensaje;
    } else {
        Conexion::insertarUsuario($correo, $nombre, $pass);
    }

    header('Location: ../index.php');
}

//----------------------------INICIO DE SESIÓN
if (isset($_REQUEST['inicioSesion'])) {
    $correo = $_REQUEST['correo'];
    $pass = $_REQUEST['pass'];
    
    $usuario = Conexion::recuperarUsuario($correo, $pass);
    
    if ($usuario != null) {
        //Inicio válido, guarda el usuario en la sesión y lleva a pantalla de bienvenida
        $_SESSION['usuarioIniciado'] = $usuario;
        header("Location: ../Vistas/bienvenide.php");
    } else {
        //Inicio inválido, prepara mensaje y devuelve a inicio
        $mensaje = 'Inicio de sesión inválido.';
        $_SESSION['mensaje'] = $mensaje;
        header("Location: ../index.php");
    }
}