<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form name="aprender" action="controlador.php" method="POST">
            <?php
            session_start();
            //El nº está en la sesión. Se ejecuta el juego
            if (isset($_SESSION['numero'])) {
                $partidaTerminada = $_SESSION['terminada'];
                $numero = $_SESSION['numero'];
                $intentos = $_SESSION['intentos'];

                echo 'Te queda(n) ' . $intentos . ' intentos.<br>';
                
                //Si existe el vector "resultado" es que viene de hacer un intento. Lo pinta adecuadamente
                if (isset($_SESSION['resultado'])) {
                    $resultado = $_SESSION['resultado'];    //Vector de booleanos con el resultado de las respuestas
                    $respuestas = $_SESSION['respuestas'];  //Vector con las respuestas dadas

                    //Pinta el tablero y comprueba si ha ganado para mostrar el mensaje adecuado
                    $haGanado = true;
                    for ($i = 0; $i <= 10; $i++) {
                        echo $numero . ' X ' . $i . ' = ';
                        ?>
                        <input type="number" name="respuesta[]" <?php
                        if ($resultado[$i]) {
                            echo 'style="background-color: lightgreen"';
                        } else {
                            echo 'style="background-color: red"';
                            $haGanado = false;
                        }
                        ?> value="<?php echo $respuestas[$i] ?>"><br>                    
                               <?php
                           }
                           if ($haGanado) {
                               echo '¡HAS GANADO!<br><a href="index.php">Volver</a>';
                           } else {
                               ?>
                        <input type="submit" name="intentar" value="Aceptar">
                        <input type="submit" name="rendirse" value="Rendirse"><br>
                        <a href="index.php">Volver</a>
                        <?php
                    }
                } else {
                    //Pinta la tabla sin estilos al ser el primer intento
                    for ($i = 0; $i <= 10; $i++) {
                        echo $numero . ' X ' . $i . ' = ';
                        ?>
                        <input type="number" name="respuesta[]"><br>                    
                        <?php
                    }
                    ?>
                    <input type="submit" name="intentar" value="Aceptar">
                    <input type="submit" name="rendirse" value="Rendirse">
                    <a href="index.php">Volver</a>
                    <?php
                }
            } else {
                //No está el nº en la sesión. Hay algún error
                echo 'Ha ocurrido algún error. Por favor, vuelve a Inicio.<br><a href="index.php">Volver</a>';
            }
            ?>
        </form>
        
    </body>
</html>
