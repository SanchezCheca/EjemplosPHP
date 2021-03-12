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
        <link rel="stylesheet" href="Estilos/estilos.css">
    </head>
    <body>
        <?php
        require_once 'Clases/Animal.php';
        require_once 'Clases/Gato.php';
        require_once 'Clases/Perro.php';
        require_once 'Clases/Elefante.php';
        require_once 'Clases/Parque.php';
        session_start();

        if (ob_get_level() == 0) ob_start();    //Necesario para el flush

        if (isset($_SESSION['tiempo'])) {
            $tiempo = $_SESSION['tiempo'];
            $parque = $_SESSION['parque'];
        } else {
            $tiempo = 2;
            $parque = new Parque(6);
            $parque->nuevoAnimal();

            $_SESSION['tiempo'] = $tiempo;
            $_SESSION['parque'] = $parque;
        }

        echo $tiempo . '<br>';
        
        if ($tiempo % 20 == 0) {
            $parque->abandonar();
        } else if ($tiempo % 15 == 0) {
            $parque->mover();
        } else if ($tiempo % 10 == 0) {
            $parque->nuevoAnimal();
        } else if ($tiempo % 2 == 0) {
            $parque->hacerCosas();
        }
        
        echo $parque;

        $tiempo++;
        $_SESSION['tiempo'] = $tiempo;
        $_SESSION['parque'] = $parque;


        ob_flush();
        flush();
        sleep(2);
        header('Refresh:0');
        ?>
    </body>
</html>
