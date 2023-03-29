<?php

/*

    Aplicación No 9 (Arrays asociativos)
    Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
    contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
    lapiceras.

*/

function mostrarLapicera($lapicera)
{
    foreach ($lapicera as $clave => $valor)
    {
        echo $clave, " - ", $valor, "<br>";
    }
    echo "<br>";
}

$lapicera = array('color' => 'negra', 'marca' => 'Bic', 'trazo' => 'grueso', 'precio' => 100);

mostrarLapicera($lapicera);

$lapicera = array('color' => 'azul', 'marca' => 'Faber Castell', 'trazo' => 'fino', 'precio' => 120);

mostrarLapicera($lapicera);

$lapicera = array('color' => 'roja', 'marca' => 'Parker', 'trazo' => 'medio', 'precio' => 135);

mostrarLapicera($lapicera);

?>