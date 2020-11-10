<?php

require_once 'Usuario.php';

class Conexion {

    private static $conexion;

    /**
     * Crea una nueva conexión a BD
     */
    public static function nueva() {
        // Utilizando la forma procedimental.
        self::$conexion = new mysqli('localhost', 'daniel', 'Chubaca2020', 'registroPHP');
        
        if (self::$conexion->connect_errno) {
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
        
        if (!self::$conexion->query($query)) {
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
        
        $resultado = self::$conexion->query($consulta);
        if ($fila = $resultado->fetch_assoc()) {
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
        $consulta = "SELECT * FROM usuarios WHERE correo=? AND pass=?";
        $stmt = self::$conexion->prepare($consulta);
        $stmt->bind_param("ss", $val1, $val2);
        $val1 = $correo;
        $val2 = $pass;
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($fila = $result->fetch_assoc()) {
            $correo = $fila['correo'];
            $nombre = $fila['nombre'];
            $rol = $fila['rol'];

            $usuario = new Usuario($nombre, $correo, $rol);
        }
        $result->free();
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
        if ($resultado = self::$conexion->query($consulta)) {
            while ($fila = $resultado->fetch_assoc()) {
                $nombre = $fila['nombre'];
                $correo = $fila['correo'];
                $rol = $fila['rol'];
                $usuarios[] = new Usuario($nombre, $correo, $rol);
            }

            $resultado->free();
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
        self::$conexion->query($sentencia);
        self::cerrarBD();
    }
    
    public static function eliminarUsuario($correo) {
        $sentencia = 'DELETE FROM usuarios WHERE correo="' . $correo . '";';
        
        self::nueva();
        self::$conexion->query($sentencia);
        self::cerrarBD();
    }

    public static function cerrarBD() {
        mysqli_close(self::$conexion);
    }

    
}
