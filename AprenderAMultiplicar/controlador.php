<?php

session_start();

//Viene de index
if (isset($_REQUEST['aceptar'])) {
    $numero = $_REQUEST['numero'];
    $_SESSION['numero'] = $numero;
    $_SESSION['intentos'] = 5;

    unset($_SESSION['resultado']);
    unset($_SESSION['respuestas']);

    header("Location: aprender.php");
}

//Viene de hacer un intento
if (isset($_REQUEST['intentar'])) {
    $numero = $_SESSION['numero'];
    $respuestas = $_REQUEST['respuesta'];
    $intentos = $_SESSION['intentos'];
    $resultado;

    $haGanado = true;
    foreach ($respuestas as $i => $valor) {
        if (($numero * $i) == $valor) {
            $resultado[] = true;
        } else {
            $resultado[] = false;
            $haGanado = false;
        }
    }

    //Se ha quedado sin intentos
    if (!$haGanado && $intentos == 1) {
        header("Location: hasPerdido.php");
    } else {
        $intentos--;
        $_SESSION['intentos'] = $intentos;
        $_SESSION['respuestas'] = $respuestas;
        $_SESSION['resultado'] = $resultado;
        header("Location: aprender.php");
    }
}

//Viene de "rendirse"
if (isset($_REQUEST['rendirse'])) {
    header("Location: meRindo.php");
}