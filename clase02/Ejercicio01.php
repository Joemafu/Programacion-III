<?php

/*
    Aplicación No 1 (Invertir palabra)
    Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
    de las letras del Array.
    Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.
*/

function invertirArray($array)
{
    $ret = array();
    if (is_array($array))
    {
        foreach ($array as $letra)
        {
            array_unshift($ret, $letra);
        }
    }    

    return $ret;
}

function imprimirArray($array)
{
    if (is_array($array) && !empty($array))
    {
        foreach ($array as $letra)
        {
            echo $letra;
        }
    }
}

$arrayTest = array("H","O","L","A");

imprimirArray($arrayTest);

echo "<br>";

imprimirArray(invertirArray($arrayTest));

?>