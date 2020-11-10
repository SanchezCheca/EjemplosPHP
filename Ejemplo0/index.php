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
        <?php
            echo 'Hola<br>';
            
            $a = 1.1;
            $b = 1.4;
            $c = $a + $b;
            
            echo 'La variable c vale ' . $c . '<br>';
        ?>
        
        <form name="hola" action="validar.php" method="POST">
            <input type="text" name="nombre" placeholder="nombre">
            <br>
            <input type="submit" name="enviar" value="Enviar">
        </form>
    </body>
</html>
