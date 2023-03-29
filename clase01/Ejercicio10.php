<?php

/*

    Aplicación No 10 (Arrays de Arrays)
    Realizar las líneas de código necesarias para generar un Array asociativo y otro indexado que
    contengan como elementos tres Arrays del punto anterior cada uno. Crear, cargar y mostrar los
    Arrays de Arrays.

*/

function mostrarLapicera($lapicera)
{
    foreach ($lapicera as $clave => $valor)
    {
        echo $clave, " - ", $valor, "<br>";
    }
    echo "<br>";
}

$lapiceras = array(
    array('color' => 'negra', 'marca' => 'Bic', 'trazo' => 'grueso', 'precio' => 100),
    array('color' => 'azul', 'marca' => 'Faber Castell', 'trazo' => 'fino', 'precio' => 120),
    array('color' => 'roja', 'marca' => 'Parker', 'trazo' => 'medio', 'precio' => 135)
);

foreach ($lapiceras as $lapicera)
{
    mostrarLapicera($lapicera);
}

?>