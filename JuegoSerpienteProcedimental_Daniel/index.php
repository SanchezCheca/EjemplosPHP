<!DOCTYPE html>
<!--
Juego Serpiente procedimental
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="estilos.css">
    </head>
    <body>
        <?php
        include 'recursos.php';

        if (ob_get_level() == 0)
            ob_start();    //Necesario para el flush

        $serpiente = iniciarSerpiente();
        $edad = 0;

        echo 'Comienzo de la simulación. La serpiente ha nacido<br>';
        echo pintarSerpiente($serpiente);
        echo '<br>';

        //INICIO DE LA SIMULACIÓN
        while (estaViva($serpiente)) {
            $alea = rand(1, 100);

            if ($alea <= 10) {
                //Mangosta
                $serpiente = [];
                echo 'Una mangosta se ha comido a la serpiente :(<br>';
            } else {
                //Vida normal
                $alea = rand(1, 100);
                if ($edad <= 10) {
                    if ($alea <= 70) {
                        $serpiente = crecer($serpiente);
                        echo 'La serpiente crece<br>';
                    } else {
                        $serpiente = mudar($serpiente);
                        echo 'La serpiente muda<br>';
                    }
                } else {
                    if ($alea <= 80) {
                        $serpiente = decrecer($serpiente);

                        //Comprueba si acaba de morir de vieja para mostrar el mensaje adecuado
                        if (!estaViva($serpiente)) {
                            echo 'La serpiente ha muerto de vieja :(<br>';
                        } else {
                            echo 'La serpiente decrece<br>';
                        }
                    } else {
                        $serpiente = mudar($serpiente);
                        echo 'La serpiente muda<br>';
                    }
                }
                echo 'Edad actual: ' . $edad . '<br>';
                echo pintarSerpiente($serpiente);
            }
            $edad++;
            echo '<br>';

            ob_flush();
            flush();
            sleep(1);
        }

        echo 'Fin de la simulación';
        ?>


    </body>
</html>
