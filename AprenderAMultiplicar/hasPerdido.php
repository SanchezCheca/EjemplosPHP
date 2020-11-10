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
        <p>¡Te has quedado sin intentos!</p><br>
        <?php
        session_start();
        $numero = $_SESSION['numero'];

        for ($i = 0; $i <= 10; $i++) {
            echo $numero . ' X ' . $i . ' = ';
            ?>
            <input type="number" style="background-color: lightblue" value="<?php echo $i * $numero ?>" disabled><br>                    
            <?php
        }
        ?>
        <br>
        <a href="index.php">Volver</a>
    </body>
</html>
