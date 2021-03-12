<?php

//Inicia una serpiente de tamaño 1 con color aleatorio [R][V][A]
function iniciarSerpiente() {
    $alea = rand(1, 3);
    $serpiente = ['E'];
    switch ($alea) {
        case 1:
            $serpiente = ['red'];
            break;
        case 2:
            $serpiente = ['green'];
            break;
        case 3:
            $serpiente = ['blue'];
            break;
    }
    return $serpiente;
}

//Devuelve un Array con la serpiente formateada
function pintarSerpiente($serpiente) {
    $cadena;
    foreach ($serpiente as $valor) {
        $cadena = $cadena . '<div class="anillo" style="background-color: ' . $valor . '"></div>';
    }

    $cadena = $cadena . '<br>';
    return $cadena;
}

//La serpiente crece en 1
function crecer($serpiente) {
    $alea = rand(1, 3);
    switch ($alea) {
        case 1:
            $serpiente[] = 'red';
            break;
        case 2:
            $serpiente[] = 'green';
            break;
        case 3;
            $serpiente[] = 'blue';
            break;
    }
    return $serpiente;
}

//La serpiente decrece en 1
function decrecer($serpiente) {
    array_pop($serpiente);
    return $serpiente;
}

//La serpiente muda de color
function mudar($serpiente) {
    foreach ($serpiente as $i => $valor) {
        $alea = rand(1, 3);
        switch ($alea) {
            case 1:
                $serpiente[$i] = 'red';
                break;
            case 2:
                $serpiente[$i] = 'green';
                break;
            case 3;
                $serpiente[$i] = 'blue';
                break;
        }
    }
    return $serpiente;
}

//Devuelve true si tiene cuerpo
function estaViva($serpiente) {
    return count($serpiente) >= 1;
}

?>