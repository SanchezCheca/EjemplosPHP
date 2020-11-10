<!DOCTYPE html>
<!--
Sánchez Checa
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Serpiente POO</title>
        <link rel="stylesheet" href="estilos.css">
    </head>
    <body>
        <?php
        include_once 'Serpiente.php';

        if (ob_get_level() == 0) ob_start();    //Necesario para el flush

        $serpiente = new Serpiente('Pepa');

        echo 'Comienzo de la simulación. La serpiente ' . $serpiente->getNombre() . ' ha nacido<br>';
        echo $serpiente;
        
        //INICIO DE LA SIMULACIÓN
        while ($serpiente->isVive()) {
            $alea = rand(1, 100);

            if ($alea <= 10) {
                //Mangosta
                $serpiente->morir();
                echo 'Una mangosta se ha comido a la serpiente :(<br>';
            } else {
                //Vida normal
                $alea = rand(1, 100);
                if ($serpiente->getEdad() <= 10) {
                    if ($alea <= 70) {
                        $serpiente->crecer();
                        echo 'La serpiente crece<br>';
                    } else {
                        $serpiente->mudar();
                        echo 'La serpiente muda<br>';
                    }
                } else {
                    if ($alea <= 80) {
                        $serpiente->decrecer();

                        //Comprueba si acaba de morir de vieja para mostrar el mensaje adecuado
                        if (!$serpiente->isVive()) {
                            echo 'La serpiente ha muerto de vieja :(<br>';
                        } else {
                            echo 'La serpiente decrece<br>';
                        }
                    } else {
                        $serpiente->mudar();
                        echo 'La serpiente muda<br>';
                    }
                }
                echo 'Edad actual: ' . $serpiente->getEdad() . '<br>';
                echo $serpiente;
            }
            $serpiente->envejecer();
            echo '<br>';

            ob_flush();
            flush();
            sleep(1);
        }

        echo 'Fin de la simulación';
        ?>
    </body>
</html>
