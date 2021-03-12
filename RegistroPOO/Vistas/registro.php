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
        <form name="registro" action="../Controladores/controladorPrincipal.php" method="POST">
            <input type="text" name="nombre" placeholder="Nombre" required><br>
            <input type="email" name="correo" placeholder="Correo electrónico" required><br>
            <input type="password" name="pass" placeholder="Contraseña" required><br>
            <input type="submit" name="registro" value="Registrarme">            
        </form>
        <a href="../index.php">Volver</a>
    </body>
</html>
