<?php
require_once '../Recursos/Conexion.php';
session_start();

//-------------------------------REGISTRAR NUEVO USUARIO
if (isset($_REQUEST['registro'])) {
    $nombre = $_REQUEST['nombre'];
    $correo = $_REQUEST['correo'];
    $pass = $_REQUEST['pass'];

    if (Conexion::existeUsuario($correo)) {
        $mensaje = 'ERROR: El correo ya está registrado.';
    } else {
        
        if (Conexion::insertarUsuario($correo, $nombre, $pass) == true) {
            $mensaje = 'Se ha registrado al usuario de nombre "' . $nombre . '" y correo "' . $correo . '".<br>';
        } else {
            $mensaje = 'Ha ocurrido algún error. Depura';
        }
        
    }

    $_SESSION['mensaje'] = $mensaje;
    header('Location: ../Vistas/CRUD.php');
}

//-------------------------------ACTUALIZAR USUARIO
if (isset($_REQUEST['actualizar'])) {
    $nombre = $_REQUEST['nombre'];
    $correo = $_REQUEST['correo'];
    $rol = $_REQUEST['rol'];
    $id = $_REQUEST['id'];
    
    Conexion::actualizarUsuario($id, $nombre, $correo, $rol);
    
    $mensaje = 'Se ha actualizado el usuario de nombre "' . $nombre . '" y correo ' . $id . '".<br>';
    $_SESSION['mensaje'] = $mensaje;
    header('Location: ../Vistas/CRUD.php');    
}

//-------------------------------ACTUALIZAR USUARIO
if (isset($_REQUEST['eliminar'])) {
    $nombre = $_REQUEST['nombre'];
    $id = $_REQUEST['id'];
    
    Conexion::eliminarUsuario($id);
    
    $mensaje = 'Se ha eliminado el usuario de nombre "' . $nombre . '" y correo ' . $id . '".<br>';
    $_SESSION['mensaje'] = $mensaje;
    header('Location: ../Vistas/CRUD.php');    
}