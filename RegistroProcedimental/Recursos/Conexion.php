<?php

/**
 * Description of Conexion
 *
 * @author daniel
 */
require_once 'Usuario.php';

class Conexion {

    private static $conexion;

    /**
     * Crea una nueva conexión a BD
     */
    public static function nueva() {
        // Utilizando la forma procedimental.
        self::$conexion = mysqli_connect('localhost', 'daniel', 'Chubaca2020', 'registroPHP');
        //print "Conexión realizada de forma procedimental: " . mysqli_get_server_info(self::$conexion) . "<br/>";

        if (mysqli_connect_errno($conexion)) {
            print "Fallo al conectar a MySQL: " . mysqli_connect_error();
        }
    }

    /**
     * Inserta un nuevo usuario en la BD
     * @param type $correo
     * @param type $nombre
     * @param type $pass
     * @return string
     */
    public static function insertarUsuario($correo, $nombre, $pass) {
        $resultado = true;

        self::nueva();
        $query = "INSERT INTO usuarios VALUES('" . $nombre . "', '" . $correo . "', '" . $pass . "', 0);";
        if (!mysqli_query(self::$conexion, $query)) {
            $resultado = "Error al insertar: " . mysqli_error(self::$conexion) . '<br/>';
        }
        self::cerrarBD();

        return $resultado;
    }

    /**
     * Devuelve true si y sólo si existe el usuario cuyo correo recibe por parametro.
     * @param type $correo
     * @return boolean
     */
    public static function existeUsuario($correo) {
        $existe = false;
        
        self::nueva();
        $consulta = "SELECT * FROM usuarios WHERE correo='" . $correo . "';";
        
        $resultado = mysqli_query(self::$conexion, $consulta);
        if ($fila = mysqli_fetch_array($resultado)) {
            $existe = true;
        }
        self::cerrarBD();
        
        return $existe;
    }

    /**
     * Devuelve un objeto usuario si el correo y la contraseña coinciden.
     * Devuelve null en cualquier otro caso.
     * @param type $correo
     * @return boolean
     */
    public static function recuperarUsuario($correo, $pass) {
        $usuario = null;

        self::nueva();
        $consulta = "SELECT * FROM usuarios WHERE correo='" . $correo . "' AND pass='" . $pass . "';";
        $resultado = mysqli_query(self::$conexion, $consulta);
        if ($fila = mysqli_fetch_array($resultado)) {
            $correo = $fila['correo'];
            $nombre = $fila['nombre'];
            $rol = $fila['rol'];

            $usuario = new Usuario($nombre, $correo, $rol);
        }
        mysqli_free_result($resultado);
        self::cerrarBD();
        
        return $usuario;
    }

    /**
     * Devuelve todos los usuarios
     */
    public static function recuperarTodosLosUsuarios() {
        $consulta = "SELECT * FROM usuarios";
        $usuarios = null;

        self::nueva();
        if ($resultado = mysqli_query(self::$conexion, $consulta)) {
            while ($fila = mysqli_fetch_array($resultado)) {
                $nombre = $fila['nombre'];
                $correo = $fila['correo'];
                $rol = $fila['rol'];
                $usuarios[] = new Usuario($nombre, $correo, $rol);
            }

            mysqli_free_result($resultado);
        }
        self::cerrarBD();
        
        return $usuarios;
    }
    
    /**
     * Actualiza los datos del usuario cuyo correo (PK) es $id
     * @param type $id
     * @param type $nombre
     * @param type $correo
     * @param type $rol
     */
    public static function actualizarUsuario($id, $nombre, $correo, $rol) {
        $sentencia = "UPDATE usuarios SET correo='" . $correo . "', nombre='" . $nombre . "', rol=" . $rol . " WHERE correo='" . $id . "';";
        
        self::nueva();
        mysqli_query(self::$conexion, $sentencia);
        self::cerrarBD();
    }
    
    public static function eliminarUsuario($correo) {
        $sentencia = 'DELETE FROM usuarios WHERE correo="' . $correo . '";';
        
        self::nueva();
        mysqli_query(self::$conexion, $sentencia);
        self::cerrarBD();
    }

    public static function cerrarBD() {
        mysqli_close(self::$conexion);
    }

}
