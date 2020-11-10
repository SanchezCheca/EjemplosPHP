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
        if (isset($_REQUEST['enviar'])) {
            $num = $_REQUEST['numero'];
            
            for ($i = 0; $i <= 10; $i++) {
                echo $num . ' * ' . $i . ' = ' . ($num * $i);
                echo '<br>';
            }
        } else {
            echo 'No has introducido ningún número<br>';
        }
        ?>
        <a href="index.php">Volver</a>
    </body>
</html>
